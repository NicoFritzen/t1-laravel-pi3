@extends('layouts.app-filmes')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <h1>🎬 Bem-vindo ao Sistema de Filmes!</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem;">
        <div style="background-color: #3498db; color: white; padding: 2rem; border-radius: 8px; text-align: center;">
            <h2>📽️ Seus Filmes</h2>
            <p>Gerencie sua coleção de filmes</p>
            <a href="{{ route('filmes.index') }}" class="btn" style="background-color: white; color: #3498db; margin-top: 1rem;">Ver Filmes</a>
        </div>
        
        <div style="background-color: #2ecc71; color: white; padding: 2rem; border-radius: 8px; text-align: center;">
            <h2>➕ Novo Filme</h2>
            <p>Adicione um novo filme à sua coleção</p>
            <a href="{{ route('filmes.create') }}" class="btn" style="background-color: white; color: #2ecc71; margin-top: 1rem;">Cadastrar</a>
        </div>
    </div>

    <div style="margin-top: 2rem; padding: 1.5rem; background-color: #f8f9fa; border-radius: 8px;">
        <h3>📊 Informações do Sistema</h3>
        <p><strong>Usuário:</strong> {{ auth()->user()->name }}</p>
        <p><strong>E-mail:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Membro desde:</strong> {{ auth()->user()->created_at->format('d/m/Y') }}</p>
    </div>
</div>
@endsection