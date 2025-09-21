@extends('layouts.app-filmes')

@section('title', $filme->titulo)

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>🎬 {{ $filme->titulo }}</h1>
        <div>
            @if($filme->user_id == auth()->id())
                <a href="{{ route('filmes.edit', $filme) }}" class="btn btn-warning">✏️ Editar</a>
            @endif
            <a href="{{ route('filmes.index') }}" class="btn" style="background-color: #6c757d; color: white;">⬅️ Voltar</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: start;">
        <div>
            @php
                $extensao = pathinfo($filme->arquivo, PATHINFO_EXTENSION);
                $isVideo = in_array(strtolower($extensao), ['mp4', 'avi', 'mov']);
            @endphp
            
            @if($isVideo)
                <video style="width: 100%; border-radius: 8px;" controls>
                    <source src="{{ asset('uploads/' . $filme->arquivo) }}" type="video/{{ $extensao }}">
                </video>
            @else
                <img src="{{ asset('uploads/' . $filme->arquivo) }}" alt="{{ $filme->titulo }}" style="width: 100%; border-radius: 8px;">
            @endif
        </div>

        <div>
            <div class="form-group">
                <label>📝 Descrição</label>
                <p style="background-color: #f8f9fa; padding: 1rem; border-radius: 4px; margin: 0;">
                    {{ $filme->descricao }}
                </p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>🎭 Gênero</label>
                    <p style="background-color: #f8f9fa; padding: 1rem; border-radius: 4px; margin: 0;">
                        {{ $filme->genero }}
                    </p>
                </div>

                <div class="form-group">
                    <label>📅 Ano de Lançamento</label>
                    <p style="background-color: #f8f9fa; padding: 1rem; border-radius: 4px; margin: 0;">
                        {{ $filme->ano_lancamento }}
                    </p>
                </div>
            </div>

            <div class="form-group">
                <label>👤 Cadastrado por</label>
                <p style="background-color: #f8f9fa; padding: 1rem; border-radius: 4px; margin: 0;">
                    {{ $filme->user->name }}
                </p>
            </div>

            <div class="form-group">
                <label>📊 Informações Técnicas</label>
                <div style="background-color: #f8f9fa; padding: 1rem; border-radius: 4px;">
                    <p><strong>Tipo de arquivo:</strong> {{ $isVideo ? 'Vídeo' : 'Imagem' }}</p>
                    <p><strong>Extensão:</strong> {{ strtoupper($extensao) }}</p>
                    <p><strong>Cadastrado em:</strong> {{ $filme->created_at->format('d/m/Y H:i') }}</p>
                    @if($filme->updated_at != $filme->created_at)
                        <p><strong>Última atualização:</strong> {{ $filme->updated_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection