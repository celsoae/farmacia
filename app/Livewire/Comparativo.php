<?php

namespace App\Livewire;

use App\Models\Conformidade;
use Livewire\Component;

class Comparativo extends Component
{
    public $records;
    public $sugestoes;
    public $result;
    public $valor;

    public $valorFracionado;
    public $selectedRow;

    public function render()
    {
        return view('livewire.comparativo', [
            'result' => $this->result,
            'sugestoes' => $this->sugestoes,
        ]);
    }

    public function addRow($record)
    {
        // Obter dados da linha clicada
        $selectedRowData = Conformidade::find($record);

        // Criar novo array com dados copiados e preço editável
        $newRowData = [
            'id' => $selectedRowData['id'],
            'PRODUTO' => $selectedRowData['PRODUTO'],
            'SUBSTANCIA' => $selectedRowData['SUBSTANCIA'],
            'PF_SEM_IMPOSTOS' => $selectedRowData['PF_SEM_IMPOSTOS'],
            'VALOR_FRACIONADO' => $selectedRowData['PF_SEM_IMPOSTOS'] / $this->valor,
        ];

        // Converter a coleção Eloquent em array
        if (!is_array($this->records))
            $recordsArray = $this->records->toArray();
        else
            $recordsArray = $this->records;

        // Adicionar nova linha ao array
        array_push($recordsArray, $newRowData);

        $this->valor = 0;
        // Atualizar a propriedade 'records' com o array modificado
        $this->records = $recordsArray;
    }
}
