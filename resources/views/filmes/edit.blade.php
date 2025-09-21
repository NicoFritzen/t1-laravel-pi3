@extends('layouts.app-filmes')

@section('title', 'Editar Filme')

@section('content')
<div class="card">
    <h1>✏️ Editar Filme: {{ $filme->titulo }}</h1>
    
    <form method="POST" action="{{ route('filmes.update', $filme) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="titulo">Título do Filme</label>
            <input type="text" id="titulo" name="titulo" class="form-control" value="{{ old('titulo', $filme->titulo) }}">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="4">{{ old('descricao', $filme->descricao) }}</textarea>
        </div>

        <div class="form-group">
            <label for="genero">Gênero</label>
            <input type="text" id="genero" name="genero" class="form-control" value="{{ old('genero', $filme->genero) }}">
        </div>

        <div class="form-group">
            <label for="ano_lancamento">Ano de Lançamento</label>
            <input type="number" id="ano_lancamento" name="ano_lancamento" class="form-control" value="{{ old('ano_lancamento', $filme->ano_lancamento) }}" min="1900" max="{{ date('Y') }}">
        </div>

        <div class="form-group">
            <label>Arquivo Atual</label>
            <div style="margin-bottom: 1rem;">
                @php
                    $extensao = pathinfo($filme->arquivo, PATHINFO_EXTENSION);
                    $isVideo = in_array(strtolower($extensao), ['mp4', 'avi', 'mov']);
                @endphp
                
                @if($isVideo)
                    <video style="max-width: 300px; border-radius: 4px;" controls>
                        <source src="{{ asset('uploads/' . $filme->arquivo) }}" type="video/{{ $extensao }}">
                    </video>
                @else
                    <img src="{{ asset('uploads/' . $filme->arquivo) }}" alt="{{ $filme->titulo }}" style="max-width: 300px; border-radius: 4px;">
                @endif
            </div>
            
            <label for="arquivo">Substituir por Nova Imagem ou Vídeo (opcional)</label>
            <input type="file" id="arquivo" name="arquivo" class="form-control" accept=".jpg,.jpeg,.png,.mp4,.avi,.mov">
            <small style="color: #666;">Deixe vazio para manter o arquivo atual. Formatos aceitos: JPG, PNG, MP4, AVI, MOV (máximo 20MB)</small>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">💾 Atualizar Filme</button>
            <a href="{{ route('filmes.show', $filme) }}" class="btn" style="background-color: #6c757d; color: white;">❌ Cancelar</a>
        </div>
    </form>
</div>
@endsection