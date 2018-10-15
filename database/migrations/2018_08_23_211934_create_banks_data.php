<?php

use CodeFin\Models\Bank;
use CodeFin\Repositories\Interfaces\BankRepository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

class CreateBanksData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** @var BankRepository $repository */
        $repository = app(BankRepository::class);

        foreach ($this->getData() as $bankArray) {
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
        /** @var BankRepository $repository */
        $repository = app(BankRepository::class);
        $repository->skipPresenter(true);

        $count = count($this->getData());

        foreach (range(1,$count) as $id) {
            $bank = $repository->find($id);
            $path = Bank::LOGOS_DIR . '/' . $bank->logo;

            Storage::disk('public')->delete($path);
            echo "** Imagem do '$bank->name' deletada: " . $bank->logo . "\n";

            $bank->delete();
        }
    }

    public function getData()
    {
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
                'name' => 'Dinheiro Criativo 2',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/dinheiro-criativo2.jpg'),
                    'dinheiro-criativo2.jpg'
                )
            ],
            [
                'name' => 'Moderno Dinheiro Verde',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/moderno-dinheiro-verde.jpg'),
                    'moderno-dinheiro-verde.jpg'
                )
            ],
        ];
    }
}
