<div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead
                            class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                        Especificações
                        </thead>
                        <tbody>
                        @php
                            $record = $getRecord();
                            // Get all model attributes (excluding timestamps)
                            $attributes = array_diff_key($record->getAttributes(), array_flip(
                                ['created_at', 'updated_at']
                            ));

                            // Get desired attributes from Filament component (replace with actual method)
                            $attributesToDisplay = ['id', 'APRESENTACAO', 'TARJA', 'CLASSE_TERAPEUTICA'];
                        @endphp
                        @foreach($attributesToDisplay as $attribute)
                            <tr
                                class="border-b border-neutral-200 bg-gray-100 dark:border-white/10 {{ $loop->iteration % 2 === 0 ? '' : 'bg-white' }}">
                                <td class="px-6 py-4">{{$attribute}}</td>
                                <td class="px-6 py-4 text-blue-700">{{ $getRecord()->getAttribute($attribute) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
