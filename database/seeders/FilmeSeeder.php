<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Filme;

class FilmeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Criar usuário de teste se não existir
        $user = User::firstOrCreate([
            'email' => 'teste@filme.com'
        ], [
            'name' => 'Usuário Teste',
            'password' => bcrypt('12345678')
        ]);

        // Criar 3 filmes de exemplo
        $filmes = [
            [
                'titulo' => 'Matrix',
                'descricao' => 'Um hacker descobre que a realidade é uma simulação controlada por máquinas.',
                'genero' => 'Ficção Científica',
                'ano_lancamento' => 1999,
                'arquivo' => 'matrix.jpg',
                'user_id' => $user->id
            ],
            [
                'titulo' => 'Vingadores: Ultimato',
                'descricao' => 'Os heróis restantes se unem para reverter as ações de Thanos.',
                'genero' => 'Ação',
                'ano_lancamento' => 2019,
                'arquivo' => 'vingadores.jpg',
                'user_id' => $user->id
            ],
            [
                'titulo' => 'Coringa',
                'descricao' => 'A origem do icônico vilão do Batman em Gotham City.',
                'genero' => 'Drama',
                'ano_lancamento' => 2019,
                'arquivo' => 'coringa.jpg',
                'user_id' => $user->id
            ]
        ];

        foreach ($filmes as $filme) {
            Filme::create($filme);
        }
    }
}
