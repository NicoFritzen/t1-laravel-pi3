# Diagramas da Aplicação - Sistema CRUD de Filmes

Este documento contém os diagramas que explicam a arquitetura, fluxos e comunicação entre os componentes da aplicação Laravel.

## 1. Comunicação entre Arquivos do Sistema

```mermaid
graph TD
    A[web.php] --> B[FilmeController.php]
    B --> C[Filme.php]
    C --> D[2025_09_21_190804_create_filmes_table.php]
    B --> E[app-filmes.blade.php]
    E --> F[index.blade.php]
    E --> G[create.blade.php]
    E --> H[show.blade.php]
    E --> I[edit.blade.php]
    E --> J[dashboard.blade.php]
    K[DatabaseSeeder.php] --> L[FilmeSeeder.php]
    L --> C
    
    style A fill:#e1f5fe
    style B fill:#f3e5f5
    style C fill:#e8f5e8
    style D fill:#fff3e0
    style E fill:#fce4ec
    style F fill:#f1f8e9
    style G fill:#f1f8e9
    style H fill:#f1f8e9
    style I fill:#f1f8e9
    style J fill:#f1f8e9
    style K fill:#fff8e1
    style L fill:#fff8e1
```

### Explicação da Comunicação:

- **web.php (Rotas)**: Define as rotas RESTful que direcionam para o FilmeController
- **FilmeController.php**: Processa as requisições, interage com o Model e retorna as Views
- **Filme.php (Model)**: Representa a entidade filme, define relacionamentos e regras de validação
- **Migration**: Define a estrutura da tabela filmes no banco de dados
- **Layout (app-filmes.blade.php)**: Template base que é estendido por todas as views
- **Views específicas**: Herdam do layout base e implementam funcionalidades específicas
- **Seeders**: Populam o banco com dados iniciais através do Model

---

## 2. Comunicação entre Rotas e Controllers

```mermaid
graph TD
    A["GET /filmes"] --> B["FilmeController@index"]
    C["GET /filmes/create"] --> D["FilmeController@create"]
    E["POST /filmes"] --> F["FilmeController@store"]
    G["GET /filmes/id"] --> H["FilmeController@show"]
    I["GET /filmes/id/edit"] --> J["FilmeController@edit"]
    K["PUT/PATCH /filmes/id"] --> L["FilmeController@update"]
    M["DELETE /filmes/id"] --> N["FilmeController@destroy"]
    O["GET /dashboard"] --> P["DashboardView"]
    
    B --> B1["index.blade.php"]
    D --> D1["create.blade.php"]
    F --> F1["Redirect to index"]
    H --> H1["show.blade.php"]
    J --> J1["edit.blade.php"]
    L --> L1["Redirect to index"]
    N --> N1["Redirect to index"]
    P --> P1["dashboard.blade.php"]
    
    style A fill:#e3f2fd
    style C fill:#e3f2fd
    style E fill:#e8f5e8
    style G fill:#e3f2fd
    style I fill:#e3f2fd
    style K fill:#fff3e0
    style M fill:#ffebee
    style O fill:#e3f2fd
```

### Explicação das Rotas:

- **GET /filmes**: Lista todos os filmes com paginação
- **GET /filmes/create**: Exibe formulário de criação
- **POST /filmes**: Processa dados do formulário e cria novo filme
- **GET /filmes/{filme}**: Mostra detalhes de um filme específico
- **GET /filmes/{filme}/edit**: Exibe formulário de edição
- **PUT/PATCH /filmes/{filme}**: Atualiza dados do filme
- **DELETE /filmes/{filme}**: Remove filme do sistema
- **Route Model Binding**: Laravel automaticamente injeta o objeto Filme nos métodos

---

## 3. Fluxo de Autenticação

```mermaid
sequenceDiagram
    participant User as Usuário
    participant Browser as Navegador
    participant Middleware as Auth Middleware
    participant Controller as FilmeController
    participant View as Blade View
    participant DB as Banco de Dados

    User->>Browser: Acessa /filmes
    Browser->>Middleware: Requisição HTTP
    
    alt Usuário não autenticado
        Middleware->>Browser: Redirect to /login
        Browser->>User: Tela de login
        User->>Browser: Credenciais
        Browser->>DB: Verifica credenciais
        DB->>Browser: Usuário autenticado
    end
    
    Middleware->>Controller: Passa requisição
    Controller->>DB: Busca filmes do usuário
    DB->>Controller: Retorna dados
    Controller->>View: Passa dados
    View->>Browser: HTML renderizado
    Browser->>User: Página exibida
```

### Explicação da Autenticação:

1. **Middleware Auth**: Intercepta todas as requisições para rotas protegidas
2. **Verificação de Sessão**: Checa se usuário está logado
3. **Redirecionamento**: Se não autenticado, redireciona para login
4. **Laravel Breeze**: Sistema completo de autenticação (login/registro/logout)
5. **Controle de Propriedade**: Verificação adicional se usuário é dono do recurso

---

## 4. Arquitetura MVC e Camadas

```mermaid
graph TD
    subgraph "View Layer"
        V1[index.blade.php]
        V2[create.blade.php]
        V3[show.blade.php]
        V4[edit.blade.php]
        V5[app-filmes.blade.php]
    end
    
    subgraph "Controller Layer"
        C1[FilmeController]
        C2[ProfileController]
    end
    
    subgraph "Model Layer"
        M1[Filme Model]
        M2[User Model]
    end
    
    subgraph "Database Layer"
        D1[(MySQL Database)]
        D2[Migrations]
        D3[Seeders]
    end
    
    subgraph "Routes Layer"
        R1[web.php]
        R2[Middleware]
    end
    
    R1 --> C1
    R1 --> C2
    R2 --> C1
    C1 --> M1
    C1 --> V1
    C1 --> V2
    C1 --> V3
    C1 --> V4
    V1 --> V5
    V2 --> V5
    V3 --> V5
    V4 --> V5
    M1 --> D1
    M2 --> D1
    D2 --> D1
    D3 --> D1
    
    style C1 fill:#f3e5f5
    style M1 fill:#e8f5e8
    style V1 fill:#e3f2fd
    style D1 fill:#fff3e0
    style R1 fill:#fce4ec
```

### Explicação das Camadas MVC:

- **Model (Filme.php)**: 
  - Representa dados e lógica de negócio
  - Define relacionamentos (belongsTo User)
  - Contém regras de validação
  - Interage diretamente com o banco de dados

- **View (Blade Templates)**:
  - Apresenta dados ao usuário
  - Templates reutilizáveis com herança
  - Lógica de apresentação (loops, condicionais)
  - Formulários para entrada de dados

- **Controller (FilmeController)**:
  - Recebe requisições HTTP
  - Coordena Model e View
  - Aplica regras de negócio
  - Retorna respostas apropriadas

- **Routes (web.php)**:
  - Define endpoints da aplicação
  - Aplica middleware de segurança
  - Conecta URLs aos Controllers

---

## 5. Fluxo de Upload de Imagens/Vídeos

```mermaid
graph TD
    A[Usuário seleciona arquivo] --> B[Formulário HTML5 multipart/form-data]
    B --> C[Validação Client-side]
    C --> D{Arquivo válido?}
    D -->|Não| E[Erro no frontend]
    D -->|Sim| F[Submit para Controller]
    F --> G[Validação Server-side]
    G --> H{Validação passou?}
    H -->|Não| I[Retorna com erros]
    H -->|Sim| J[Gera nome único timestamp]
    J --> K[Move arquivo para public/uploads]
    K --> L{Upload sucesso?}
    L -->|Não| M[Erro de upload]
    L -->|Sim| N[Salva nome no banco]
    N --> O[Remove arquivo antigo se edição]
    O --> P[Redirect com sucesso]
    
    style A fill:#e3f2fd
    style F fill:#f3e5f5
    style G fill:#fff3e0
    style J fill:#e8f5e8
    style K fill:#e8f5e8
    style N fill:#e8f5e8
    style P fill:#e8f5e8
```

### Explicação do Upload:

1. **Seleção**: Usuário escolhe arquivo via input file HTML5
2. **Validação Client**: JavaScript/HTML5 validation (accept attribute)
3. **Validação Server**: Laravel valida tipo, tamanho e extensão
4. **Nome Único**: `time() . extensão` evita conflitos
5. **Armazenamento**: Arquivo movido para `public/uploads/`
6. **Banco de Dados**: Apenas o nome do arquivo é armazenado
7. **Cleanup**: Remove arquivo anterior em edições
8. **Renderização**: Sistema detecta tipo (imagem/vídeo) e renderiza adequadamente

---

## 6. Estados da Aplicação

```mermaid
stateDiagram-v2
    [*] --> Visitante
    
    state Visitante {
        [*] --> PaginaInicial
        PaginaInicial --> TelaLogin
        PaginaInicial --> TelaRegistro
    }
    
    Visitante --> Autenticado : Login/Registro
    
    state Autenticado {
        [*] --> Dashboard
        Dashboard --> ListaFilmes
        ListaFilmes --> VisualizarFilme
        ListaFilmes --> CriarFilme
        VisualizarFilme --> EditarFilme : Se for dono
        VisualizarFilme --> ExcluirFilme : Se for dono
        CriarFilme --> ProcessandoUpload
        EditarFilme --> ProcessandoUpload
        ProcessandoUpload --> ListaFilmes : Sucesso
        ProcessandoUpload --> EditarFilme : Erro
        ProcessandoUpload --> CriarFilme : Erro
        ExcluirFilme --> ListaFilmes
    }
    
    Autenticado --> Visitante : Logout
    
    state ProcessandoUpload {
        [*] --> ValidandoFormulario
        ValidandoFormulario --> ValidandoArquivo
        ValidandoArquivo --> SalvandoArquivo
        SalvandoArquivo --> SalvandoBanco
        SalvandoBanco --> [*]
    }
```

### Explicação dos Estados:

- **Visitante**: Estado inicial, acesso limitado apenas a páginas públicas
- **Autenticado**: Usuário logado com acesso completo ao sistema
- **Dashboard**: Página inicial com resumo e navegação
- **Lista Filmes**: Visualização paginada de todos os filmes
- **Criar/Editar**: Formulários para manipulação de dados
- **Visualizar**: Detalhes completos de um filme específico
- **Processando Upload**: Estado transitório durante operações de arquivo
- **Controle de Propriedade**: Apenas o dono pode editar/excluir seus filmes

### Transições de Estado:

1. **Login/Registro**: Transição de Visitante para Autenticado
2. **Navegação**: Movimentação entre diferentes seções da aplicação
3. **CRUD Operations**: Criação, leitura, atualização e exclusão de filmes
4. **Logout**: Retorno ao estado de Visitante
5. **Validação**: Estados de erro retornam ao formulário com feedback

---

## Considerações Técnicas

### Segurança:
- Middleware `auth` protege todas as operações
- CSRF tokens em todos os formulários
- Validação de propriedade antes de editar/excluir
- Upload restrito a tipos específicos de arquivo

### Performance:
- Eager loading (`with('user')`) evita queries N+1
- Paginação limita registros por página
- Arquivos armazenados no sistema de arquivos local

### Manutenibilidade:
- Arquitetura MVC bem definida
- Separação de responsabilidades
- Templates reutilizáveis
- Validação centralizada no Model
- Rotas RESTful padronizadas