<?php

namespace Tests\Feature;

use App\Models\EmailList;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailListTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_ist()
    {
       
        $registro = EmailList::create([
            'nome' => 'teste',
            'email' => 'teste@teste.com',
            'telefone' => '(xx)3333333',
            'mensagem' => 'teste',
            'ip'    => '127.0.0.1',
        ]);

        $this->AssertEquals($registro->nome, 'teste');

    }
}
