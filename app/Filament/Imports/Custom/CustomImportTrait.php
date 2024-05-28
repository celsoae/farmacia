<?php

namespace App\Filament\Imports\Custom;

use Filament\Actions\Action;
use Filament\Actions\ImportAction;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification;
use Filament\Support\ChunkIterator;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Actions\ImportAction as ImportTableAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Bus\PendingBatch;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Filesystem\AwsS3V3Adapter;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader as CsvReader;
use League\Csv\Statement;
use League\Csv\Writer;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use function Filament\Support\format_number;

trait CustomImportTrait
{
    protected $parser = false;

    protected $customSchema;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn(ImportAction|ImportTableAction $action): string => __('filament-actions::import.label', ['label' => $action->getPluralModelLabel()]));

        $this->modalHeading(fn(ImportAction|ImportTableAction $action): string => __('filament-actions::import.modal.heading', ['label' => $action->getPluralModelLabel()]));

        $this->modalDescription(fn(ImportAction|ImportTableAction $action): Htmlable => $action->getModalAction('downloadExample'));

        $this->modalSubmitActionLabel(__('filament-actions::import.modal.actions.import.label'));

        $this->groupedIcon(FilamentIcon::resolve('actions::import-action.grouped') ?? 'heroicon-m-arrow-up-tray');

        $this->form(fn(ImportAction|ImportTableAction $action): array => array_merge([
            FileUpload::make('file')
                ->label(__('filament-actions::import.modal.form.file.label'))
                ->placeholder(__('filament-actions::import.modal.form.file.placeholder'))
                ->acceptedFileTypes(['text/csv', 'text/x-csv', 'application/csv', 'application/x-csv', 'text/comma-separated-values', 'text/x-comma-separated-values', 'text/plain', 'application/vnd.ms-excel', 'text/xml'])
                ->afterStateUpdated(function (Set $set, ?TemporaryUploadedFile $state) use ($action) {
                    if (!$state instanceof TemporaryUploadedFile) {
                        return;
                    }

                    $csvStream = $this->getUploadedFileStream($state);

                    if (!$csvStream) {
                        return;
                    }

                    $csvReader = CsvReader::createFromStream($csvStream);

                    if (filled($csvDelimiter = $this->getCsvDelimiter($csvReader))) {
                        $csvReader->setDelimiter($csvDelimiter);
                    }

                    $csvReader->setHeaderOffset(0);

                    $csvColumns = $csvReader->getHeader();

                    $lowercaseCsvColumnValues = array_map('strtolower', $csvColumns);
                    $lowercaseCsvColumnKeys = array_combine(
                        $lowercaseCsvColumnValues,
                        $csvColumns,
                    );

                    $set('columnMap', array_reduce($action->getImporter()::getColumns(), function (array $carry, ImportColumn $column) use ($lowercaseCsvColumnKeys, $lowercaseCsvColumnValues) {
                        $carry[$column->getName()] = $lowercaseCsvColumnKeys[Arr::first(
                            array_intersect(
                                $lowercaseCsvColumnValues,
                                $column->getGuesses(),
                            ),
                        )] ?? null;

                        return $carry;
                    }, []));
                })
                ->storeFiles(false)
                ->visibility('private')
                ->required()
                ->hiddenLabel(),
            Fieldset::make('Adicionais')
                ->schema($this->customSchema)
                ->columns(1)
                ->inlineLabel()
                ->visible(fn(Get $get): bool => Arr::first((array)($get('file') ?? [])) instanceof TemporaryUploadedFile),
            Fieldset::make(__('filament-actions::import.modal.form.columns.label'))
                ->columns(1)
                ->inlineLabel()
                ->schema(function (Get $get) use ($action): array {
                    $csvFile = Arr::first((array)($get('file') ?? []));

                    if (!$csvFile instanceof TemporaryUploadedFile) {
                        return [];
                    }

                    $csvStream = $this->getUploadedFileStream($csvFile);

                    if (!$csvStream) {
                        return [];
                    }

                    $csvReader = CsvReader::createFromStream($csvStream);

                    if (filled($csvDelimiter = $this->getCsvDelimiter($csvReader))) {
                        $csvReader->setDelimiter($csvDelimiter);
                    }

                    $csvReader->setHeaderOffset(0);

                    $csvColumns = $csvReader->getHeader();
                    $csvColumnOptions = array_combine($csvColumns, $csvColumns);

                    return array_map(
                        fn(ImportColumn $column): Select => $column->getSelect()->options($csvColumnOptions),
                        $action->getImporter()::getColumns(),
                    );
                })
                ->statePath('columnMap')
                ->visible(fn(Get $get): bool => Arr::first((array)($get('file') ?? [])) instanceof TemporaryUploadedFile),
        ], $action->getImporter()::getOptionsFormComponents()));

        $this->action(function (ImportAction|ImportTableAction $action, array $data) {
            /** @var TemporaryUploadedFile $csvFile */
            $csvFile = $data['file'];

            $csvStream = $this->getUploadedFileStream($csvFile);

            if (!$csvStream) {
                return;
            }

            $csvReader = CsvReader::createFromStream($csvStream);

            if (filled($csvDelimiter = $this->getCsvDelimiter($csvReader))) {
                $csvReader->setDelimiter($csvDelimiter);
            }

            $csvReader->setHeaderOffset(0);
            $csvResults = Statement::create()->process($csvReader);

            $totalRows = $csvResults->count();
            $maxRows = $action->getMaxRows() ?? $totalRows;

            if ($maxRows < $totalRows) {
                Notification::make()
                    ->title(__('filament-actions::import.notifications.max_rows.title'))
                    ->body(trans_choice('filament-actions::import.notifications.max_rows.body', $maxRows, [
                        'count' => format_number($maxRows),
                    ]))
                    ->success()
                    ->send();

                return;
            }

            $user = auth()->user();

            $import = app(Import::class);
            $import->user()->associate($user);
            $import->file_name = $csvFile->getClientOriginalName();
            $import->file_path = $csvFile->getRealPath();
            $import->importer = $action->getImporter();
            $import->total_rows = $totalRows;
            $import->save();

            $importChunkIterator = new ChunkIterator($csvResults->getRecords(), chunkSize: $action->getChunkSize());

            /** @var array<array<array<string, string>>> $importChunks */
            $importChunks = $importChunkIterator->get();

            $job = $action->getJob();

            $options = array_merge(
                $action->getOptions(),
                Arr::except($data, ['file', 'columnMap']),
            );

            $importJobs = collect($importChunks)
                ->map(fn(array $importChunk): object => new ($job)(
                    $import,
                    rows: $importChunk,
                    columnMap: $data['columnMap'],
                    options: $options,
                ));

            $importer = $import->getImporter(
                columnMap: $data['columnMap'],
                options: $options,
            );

            Bus::batch($importJobs->all())
                ->allowFailures()
                ->when(
                    filled($jobQueue = $importer->getJobQueue()),
                    fn(PendingBatch $batch) => $batch->onQueue($jobQueue),
                )
                ->when(
                    filled($jobConnection = $importer->getJobConnection()),
                    fn(PendingBatch $batch) => $batch->onConnection($jobConnection),
                )
                ->finally(function () use ($import) {
                    $import->touch('completed_at');

                    if (!$import->user instanceof Authenticatable) {
                        return;
                    }

                    $failedRowsCount = $import->getFailedRowsCount();

                    Notification::make()
                        ->title(__('filament-actions::import.notifications.completed.title'))
                        ->body($import->importer::getCompletedNotificationBody($import))
                        ->when(
                            !$failedRowsCount,
                            fn(Notification $notification) => $notification->success(),
                        )
                        ->when(
                            $failedRowsCount && ($failedRowsCount < $import->total_rows),
                            fn(Notification $notification) => $notification->warning(),
                        )
                        ->when(
                            $failedRowsCount === $import->total_rows,
                            fn(Notification $notification) => $notification->danger(),
                        )
                        ->when(
                            $failedRowsCount,
                            fn(Notification $notification) => $notification->actions([
                                NotificationAction::make('downloadFailedRowsCsv')
                                    ->label(trans_choice('filament-actions::import.notifications.completed.actions.download_failed_rows_csv.label', $failedRowsCount, [
                                        'count' => format_number($failedRowsCount),
                                    ]))
                                    ->color('danger')
                                    ->url(route('filament.imports.failed-rows.download', ['import' => $import])),
                            ]),
                        )
                        ->sendToDatabase($import->user);
                })
                ->dispatch();

            Notification::make()
                ->title($action->getSuccessNotificationTitle())
                ->body(trans_choice('filament-actions::import.notifications.started.body', $import->total_rows, [
                    'count' => format_number($import->total_rows),
                ]))
                ->success()
                ->send();
        });

        $this->registerModalActions([
            (match (true) {
                $this instanceof TableAction => TableAction::class,
                default => Action::class,
            })::make('downloadExample')
                ->label(__('filament-actions::import.modal.actions.download_example.label'))
                ->link()
                ->action(function (): StreamedResponse {
                    $columns = $this->getImporter()::getColumns();

                    $csv = Writer::createFromFileObject(new SplTempFileObject());

                    if (filled($csvDelimiter = $this->getCsvDelimiter())) {
                        $csv->setDelimiter($csvDelimiter);
                    }

                    $csv->insertOne(array_map(
                        fn(ImportColumn $column): string => $column->getName(),
                        $columns,
                    ));

                    $example = array_map(
                        fn(ImportColumn $column) => $column->getExample(),
                        $columns,
                    );

                    if (array_filter(
                        $example,
                        fn($value): bool => filled($value),
                    )) {
                        $csv->insertOne($example);
                    }

                    return response()->streamDownload(function () use ($csv) {
                        echo $csv->toString();
                    }, __('filament-actions::import.example_csv.file_name', ['importer' => (string)str($this->getImporter())->classBasename()->kebab()]), [
                        'Content-Type' => 'text/csv',
                    ]);
                }),
        ]);

        $this->color('gray');

        $this->modalWidth('xl');

        $this->successNotificationTitle(__('filament-actions::import.notifications.started.title'));

        $this->model(fn(ImportAction|ImportTableAction $action): string => $action->getImporter()::getModel());
    }

    public function getUploadedFileStream(TemporaryUploadedFile $file)
    {
        $filePath = $file->getRealPath();

        $fileExt = $file->getClientOriginalExtension();

        if (in_array($fileExt, ['xml', 'xmls'])) {
            if (!$this->parser)
                throw new \Error('Parser zuado.');

            $filePath = $this->parser->parseXmlFile($filePath);

        }

        if (config('filament.default_filesystem_disk') !== 's3') {
            return fopen($filePath, mode: 'r');
        }

        /** @var AwsS3V3Adapter $s3Adapter */
        $s3Adapter = Storage::disk('s3')->getAdapter();

        invade($s3Adapter)->client->registerStreamWrapper();
        /** @phpstan-ignore-line */
        $fileS3Path = 's3://' . config('filesystems.disks.s3.bucket') . '/' . $filePath;

        return fopen($fileS3Path, mode: 'r', context: stream_context_create([
            's3' => [
                'seekable' => true,
            ],
        ]));
    }

    public function loadParser(string $class)
    {
        if (class_exists($class)) {
            $this->parser = new ($class)();
        }

        return $this;
    }

    //Custom form pra novos dados
    public function setCustomForm($form)
    {
        $this->customSchema = $form;
        return $this;
    }
}
