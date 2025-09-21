<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filmes = Filme::with('user')->paginate(5); // eager loading - carrega os dados do usuário junto com filme
        // paginate para definir 5 filmes por páginas
        return view('filmes.index', compact('filmes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filmes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Filme::rules()); // validação usando as regras definidas no modelo

        $arquivo = $request->file('arquivo'); // pega o arquivo enviado via post
        $nomeArquivo = time() . '.' . $arquivo->getClientOriginalExtension(); // nome único para imagem, baseado no timestamp (ao salvar, evita sobrescrever arquivos com mesmo nome)
        $arquivo->move(public_path('uploads'), $nomeArquivo); // move o arquivo para a pasta public/uploads

        Filme::create([ // mass assignment dos dados do filme
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'genero' => $request->genero,
            'ano_lancamento' => $request->ano_lancamento,
            'arquivo' => $nomeArquivo,
            'user_id' => auth()->id() // puxa o id do usuário logado
        ]);

        return redirect()->route('filmes.index')->with('success', 'Filme cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filme $filme) // busca filme pelo ID da URL, se não encontrar gera 404
    {
        return view('filmes.show', compact('filme'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filme $filme)
    {
        if ($filme->user_id !== auth()->id()) { // verifica se o usuário logado é o dono do filme
            abort(403); // se não for, gera erro 403 (proibido)
        }
        return view('filmes.edit', compact('filme')); // se for, libera a edição
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filme $filme)
    {
        if ($filme->user_id !== auth()->id()) {
            abort(403);
        }

        $rules = Filme::rules(); // pega as regras
        $rules['arquivo'] = 'nullable|mimes:jpg,jpeg,png,mp4,avi,mov|max:20480'; // modifica a regra do arquivo para ser opcional
        $request->validate($rules);

        $dados = $request->only(['titulo', 'descricao', 'genero', 'ano_lancamento']); // pega apenas os dados que podem ser atualizados

        if ($request->hasFile('arquivo')) {
            if (file_exists(public_path('uploads/' . $filme->arquivo))) { // se já existir um arquivo
                unlink(public_path('uploads/' . $filme->arquivo)); // deleta o arquivo do servidor para sobrescrever
            }

            // upload do novo arquivo, mesmo processo do store
            $arquivo = $request->file('arquivo');
            $nomeArquivo = time() . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('uploads'), $nomeArquivo);
            $dados['arquivo'] = $nomeArquivo; // adiciona o novo nome do arquivo aos dados a serem atualizados
        }

        $filme->update($dados); // atualiza o filme com os dados validados

        return redirect()->route('filmes.index')->with('success', 'Filme atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filme $filme)
    {
        if ($filme->user_id !== auth()->id()) {
            abort(403);
        }

        if (file_exists(public_path('uploads/' . $filme->arquivo))) {
            unlink(public_path('uploads/' . $filme->arquivo));
        }

        $filme->delete();

        return redirect()->route('filmes.index')->with('success', 'Filme excluído com sucesso!');
    }
}
