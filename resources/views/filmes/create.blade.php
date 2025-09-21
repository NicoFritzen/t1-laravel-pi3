@extends('layouts.app-filmes')

@section('title', 'Cadastrar Filme')

@section('content')
<div class="card">
    <h1>➕ Cadastrar Novo Filme</h1>
    
    <form method="POST" action="{{ route('filmes.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="titulo">Título do Filme</label>
            <input type="text" id="titulo" name="titulo" class="form-control" value="{{ old('titulo') }}">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="4">{{ old('descricao') }}</textarea>
        </div>

        <div class="form-group">
            <label for="genero">Gênero</label>
            <input type="text" id="genero" name="genero" class="form-control" value="{{ old('genero') }}" placeholder="Ex: Ação, Drama, Comédia">
        </div>

        <div class="form-group">
            <label for="ano_lancamento">Ano de Lançamento</label>
            <input type="number" id="ano_lancamento" name="ano_lancamento" class="form-control" value="{{ old('ano_lancamento') }}" min="1900" max="{{ date('Y') }}">
        </div>

        <div class="form-group">
            <label for="arquivo">Imagem ou Vídeo</label>
            <input type="file" id="arquivo" name="arquivo" class="form-control" accept=".jpg,.jpeg,.png,.mp4,.avi,.mov">
            <small style="color: #666;">Formatos aceitos: JPG, PNG, MP4, AVI, MOV (máximo 20MB)</small>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">💾 Salvar Filme</button>
            <a href="{{ route('filmes.index') }}" class="btn" style="background-color: #6c757d; color: white;">❌ Cancelar</a>
        </div>
    </form>
</div>
@endsection