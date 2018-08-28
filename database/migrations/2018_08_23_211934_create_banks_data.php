<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $repository = app(\CodeFin\Repositories\BankRepository::class);
        foreach ($this->getData() as $bankArray){
            $repository->create($bankArray);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $repository = app(\CodeFin\Repositories\BankRepository::class);
        $repository->skipPresenter(true);
        $count = count($this->getData());

        foreach (range(1,$count) as $value){
            $model = $repository->find($value);
            $path = \CodeFin\Models\Bank::logosDir().'/'.$model->logo;
            \Storage::disk('public')->delete($path);
            $model->delete();
        }
    }

    public function getData(){
        return [
            [
                'name' => 'Bitcoin Digital',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/bitcoin-digital.jpg'),
                    'bitcoin-digital.jpg'
                )
            ],
            [
                'name' => 'Conceito',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/conceito.jpg'),
                    'conceito.jpg'
                )
            ],
            [
                'name' => 'Dinheiro Criativo',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/dinheiro-criativo.jpg'),
                    'dinheiro-criativo.jpg'
                )
            ],
            [
                'name' => 'Dinheiro Criativo B',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/dinheiro-criativo2.jpg'),
                    'dinheiro-criativo2.jpg'
                )
            ],
            [
                'name' => 'Moderno Dinheiro',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/moderno-dinheiro-verde.jpg'),
                    'moderno-dinheiro-verde.jpg'
                )
            ],
        ];
    }
}
