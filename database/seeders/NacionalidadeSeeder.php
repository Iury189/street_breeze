<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NacionalidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nacionalidades = [
            ['descricao' => 'Alemanha'],
            ['descricao' => 'Argentina'],
            ['descricao' => 'Austrália'],
            ['descricao' => 'Brasil'],
            ['descricao' => 'Canadá'],
            ['descricao' => 'China'],
            ['descricao' => 'Coréia do Sul'],
            ['descricao' => 'Dinamarca'],
            ['descricao' => 'Escócia'],
            ['descricao' => 'Egito'],
            ['descricao' => 'Espanha'],
            ['descricao' => 'EUA'],
            ['descricao' => 'Finlândia'],
            ['descricao' => 'França'],
            ['descricao' => 'Grécia'],
            ['descricao' => 'Hungria'],
            ['descricao' => 'Índia'],
            ['descricao' => 'Inglaterra'],
            ['descricao' => 'Islândia'],
            ['descricao' => 'Itália'],
            ['descricao' => 'Jamaica'],
            ['descricao' => 'Japão'],
            ['descricao' => 'México'],
            ['descricao' => 'Quênia'],
            ['descricao' => 'Portugual'],
            ['descricao' => 'Rússia'],
            ['descricao' => 'Suíça'],
            ['descricao' => 'Suécia'],
            ['descricao' => 'Tailândia'],
            ['descricao' => 'Ucrânia'],
        ];

        DB::table('nacionalidades')->insert($nacionalidades);
    }
}
