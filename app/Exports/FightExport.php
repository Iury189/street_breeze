<?php

namespace App\Exports;

use App\Models\FightModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FightExport implements FromCollection, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return collect([FightModel::find($this->id)]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Lutador Nº 1',
            'Lutador Nº 2',
            'Vencedor',
        ];
    }
}
