<?php

namespace Database\Seeders;

use App\Models\Livro;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    public function run(): void
    {
        Livro::create([
            'titulo_livro' => 'Fundamentos de Inteligência Artificial',
            'autor_livro' => 'Stuart Russell',
            'capa_livro' => 'images/livros/adad.jpg',
            'descricao_livro' => 'Introdução aos principais conceitos e fundamentos da Inteligência Artificial.',
            'categoria_livro' => 'Tecnologia',
            'avaliacao_livro' => 4.8,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'O Iluminado',
            'autor_livro' => 'Stephen King',
            'capa_livro' => 'images/livros/o-iluminado.jpg',
            'descricao_livro' => 'Romance de terror psicológico ambientado em um hotel isolado.',
            'categoria_livro' => 'Terror',
            'avaliacao_livro' => 4.7,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'Duna',
            'autor_livro' => 'Frank Herbert',
            'capa_livro' => 'images/livros/duna.jpg',
            'descricao_livro' => 'Uma das obras mais importantes da ficção científica.',
            'categoria_livro' => 'Ficção Científica',
            'avaliacao_livro' => 4.7,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'Neuromancer',
            'autor_livro' => 'William Gibson',
            'capa_livro' => 'images/livros/neuromancer.jpg',
            'descricao_livro' => 'Clássico da ficção científica e um dos principais livros do gênero cyberpunk.',
            'categoria_livro' => 'Ficção Científica',
            'avaliacao_livro' => 4.5,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'Dom Casmurro',
            'autor_livro' => 'Machado de Assis',
            'capa_livro' => 'images/livros/dom-casmurro.jpg',
            'descricao_livro' => 'Um dos maiores clássicos da literatura brasileira.',
            'categoria_livro' => 'Literatura',
            'avaliacao_livro' => 4.5,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'It - A Coisa',
            'autor_livro' => 'Stephen King',
            'capa_livro' => 'images/livros/it-a-coisa.jpg',
            'descricao_livro' => 'História de terror sobre uma entidade que assume a forma de um palhaço.',
            'categoria_livro' => 'Terror',
            'avaliacao_livro' => 4.6,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'O Senhor dos Anéis',
            'autor_livro' => 'J.R.R. Tolkien',
            'capa_livro' => 'images/livros/senhor-dos-aneis.jpg',
            'descricao_livro' => 'Uma das maiores obras de fantasia da literatura mundial.',
            'categoria_livro' => 'Fantasia',
            'avaliacao_livro' => 4.9,
            'status_livro' => 'Emprestado',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'Sapiens – Uma Breve História da Humanidade',
            'autor_livro' => 'Yuval Noah Harari',
            'capa_livro' => 'images/livros/sapiens.jpg',
            'descricao_livro' => 'Uma análise da história e evolução da humanidade.',
            'categoria_livro' => 'História',
            'avaliacao_livro' => 4.7,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'Admirável Mundo Novo',
            'autor_livro' => 'Aldous Huxley',
            'capa_livro' => 'images/livros/admiravel-mundo-novo.jpg',
            'descricao_livro' => 'Romance distópico que apresenta uma sociedade futurista.',
            'categoria_livro' => 'Ficção Científica',
            'avaliacao_livro' => 4.4,
            'status_livro' => 'Reservado',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'A Culpa é das Estrelas',
            'autor_livro' => 'John Green',
            'capa_livro' => 'images/livros/a-culpa-e-das-estrelas.jpg',
            'descricao_livro' => 'Romance contemporâneo sobre amor, amizade e superação.',
            'categoria_livro' => 'Romance',
            'avaliacao_livro' => 4.3,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => '1984',
            'autor_livro' => 'George Orwell',
            'capa_livro' => 'images/livros/1984.jpg',
            'descricao_livro' => 'Clássico distópico sobre vigilância, poder e controle social.',
            'categoria_livro' => 'Literatura',
            'avaliacao_livro' => 4.8,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'O Hobbit',
            'autor_livro' => 'J.R.R. Tolkien',
            'capa_livro' => 'images/livros/o-hobbit.jpg',
            'descricao_livro' => 'A aventura de Bilbo Bolseiro pela Terra-média.',
            'categoria_livro' => 'Fantasia',
            'avaliacao_livro' => 4.8,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'Clean Code',
            'autor_livro' => 'Robert C. Martin',
            'capa_livro' => 'images/livros/clean-code.jpg',
            'descricao_livro' => 'Boas práticas para escrever código limpo, organizado e fácil de manter.',
            'categoria_livro' => 'Tecnologia',
            'avaliacao_livro' => 4.8,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'O Programador Pragmático',
            'autor_livro' => 'David Thomas e Andrew Hunt',
            'capa_livro' => 'images/livros/programador-pragmatico.jpg',
            'descricao_livro' => 'Princípios e práticas para desenvolvimento profissional de software.',
            'categoria_livro' => 'Tecnologia',
            'avaliacao_livro' => 4.7,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        Livro::create([
            'titulo_livro' => 'Harry Potter e a Pedra Filosofal',
            'autor_livro' => 'J.K. Rowling',
            'capa_livro' => 'images/livros/harry-potter.jpg',
            'descricao_livro' => 'O início da aventura de Harry Potter no mundo mágico.',
            'categoria_livro' => 'Fantasia',
            'avaliacao_livro' => 4.9,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);
    }
}