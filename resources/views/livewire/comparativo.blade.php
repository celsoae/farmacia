<div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead
                            class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Substância</th>
                            <th>Preço Fabrica sem Imposto</th>
                            <th>Fracionamento</th>
                            <th>Novo fracionamento</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr class="text-right">
                                <td>{{$record['id']}}</td>
                                <td>{{$record['PRODUTO']}}</td>
                                <td>{{$record['SUBSTANCIA']}}</td>
                                <td>{{$record['PF_SEM_IMPOSTOS']}}</td>
                                <td>{{ is_array($records) ? (array_key_exists('VALOR_FRACIONADO', $record) ? $record['VALOR_FRACIONADO'] : '') : 0}} </td>
                                <td>
                                    <div class="relative mt-2 rounded-md">
                                        <input type="text" name="price" id="price" wire:model.blur="valor"
                                               class="block rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </td>
                                <td>
                                    <button class="btn" type="button" wire:click="addRow({{$record['id']}})">
                                        Refracionar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--        <div class="row-auto">--}}
        {{--            @foreach($sugestoes as $item)--}}
        {{--                <p>{{$item->getAttribute('id')}}</p>--}}
        {{--            @endforeach--}}
        {{--        </div>--}}
    </div>
</div>
