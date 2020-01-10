<?php

use Illuminate\Database\Seeder;

class TipoDocumentos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documento')->insert([
            'tipo_documento' => 'Cédula de ciudadanía'
        ]);
        DB::table('tipo_documento')->insert([
            'tipo_documento' => 'Cédula de extranjería'
        ]);
        DB::table('tipo_documento')->insert([
            'tipo_documento' => 'Tarjeta de Identidad'
        ]);
        DB::table('tipo_documento')->insert([
            'tipo_documento' => 'Registro Civil'
        ]);
        DB::table('tipo_documento')->insert([
            'tipo_documento' => 'Cerificado de Nacido Vivo'
        ]);
    }
}
