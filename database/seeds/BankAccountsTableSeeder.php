<?php

use Illuminate\Database\Seeder;
use CodeFin\Repositories\BankRepository;

class BankAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repository = app(\CodeFin\Repositories\BankRepository::class);
//        $banks = $repository->all();
        $banks = $this->getBanks();

        $max = 15;
        $bankAccountId = rand(1,$max);

        factory(\CodeFin\Models\BankAccount::class,$max)
            ->make()
            ->each(function ($bankAccount) use($banks,$bankAccountId){
                $bank = $banks->random();
                $bankAccount->bank_id = $bank->id;

                $bankAccount->save();

                if ($bankAccountId == $bankAccount->id){
                    $bankAccount->default = 1;
                    $bankAccount->save();
                }
            });
    }

    private function getBanks(){
        $repository = app(BankRepository::class);
        $repository->skipPresenter(true);
        return $repository->all();
    }
}
