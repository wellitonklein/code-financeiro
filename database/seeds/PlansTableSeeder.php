<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \CodeFin\Models\Plan::create([
            'name' => 'Plano Empresarial',
            'description' => 'Plano Empresarial para Fácil Financeiro',
            'value' => 25.00,
            'code' => 'plan_business'
        ]);
    }
}
