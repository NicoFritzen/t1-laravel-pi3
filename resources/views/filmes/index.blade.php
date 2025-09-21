@extends('layouts.app-filmes')

@section('title', 'Lista de Filmes')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>📽️ Meus Filmes</h1>
        <a href="{{ route('filmes.create') }}" class="btn btn-primary">➕ Adicionar Filme</a>
    </div>

    @if($filmes->count() > 0)
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Imagem/Vídeo</th>
                        <th>Título</th>
                        <th>Gênero</th>
                        <th>Ano</th>
                        <th>Cadastrado por</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($filmes as $filme)
                        <tr>
                            <td>
                                @php
                                    $extensao = pathinfo($filme->arquivo, PATHINFO_EXTENSION);
                                    $isVideo = in_array(strtolower($extensao), ['mp4', 'avi', 'mov']);
                                @endphp
                                
                                @if($isVideo)
                                    <video class="media" controls>
                                        <source src="{{ asset('uploads/' . $filme->arquivo) }}" type="video/{{ $extensao }}">
                                    </video>
                                @else
                                    <img src="{{ asset('uploads/' . $filme->arquivo) }}" alt="{{ $filme->titulo }}" class="media">
                                @endif
                            </td>
                            <td>{{ $filme->titulo }}</td>
                            <td>{{ $filme->genero }}</td>
                            <td>{{ $filme->ano_lancamento }}</td>
                            <td>{{ $filme->user->name }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('filmes.show', $filme) }}" class="btn btn-primary">👁️ Ver</a>
                                    @if($filme->user_id == auth()->id())
                                        <a href="{{ route('filmes.edit', $filme) }}" class="btn btn-warning">✏️ Editar</a>
                                        <form method="POST" action="{{ route('filmes.destroy', $filme) }}" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este filme?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">🗑️ Excluir</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $filmes->links() }}
        </div>
    @else
        <div class="text-center">
            <p>Nenhum filme cadastrado ainda.</p>
            <a href="{{ route('filmes.create') }}" class="btn btn-primary mt-3">➕ Cadastrar Primeiro Filme</a>
        </div>
    @endif
</div>
@endsection