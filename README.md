# Sistema CRUD de Filmes - Laravel

Sistema web para gerenciamento de filmes desenvolvido com Laravel, que permite o cadastro, visualização, edição e exclusão de filmes com upload de imagens e vídeos.

## 🚀 Como executar o projeto

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina:
- [Git](https://git-scm.com)
- [PHP](https://www.php.net/) (>= 8.1)
- [Composer](https://getcomposer.org)
- [Node.js](https://nodejs.org/en/) (>= 14.x)
- [MySQL](https://www.mysql.com/) ou via [XAMPP](https://www.apachefriends.org/pt_br/index.html)

### 🎲 Rodando o projeto (passo a passo)

```bash
# Clone este repositório
$ git clone https://github.com/NicoFritzen/sistema-filmes

# Acesse a pasta do projeto no terminal
$ cd sistema-filmes

# Instale as dependências PHP
$ composer install

# Copie o arquivo de configuração
$ cp .env.example .env

# Gere a chave da aplicação
$ php artisan key:generate

# Configure o banco de dados no arquivo .env
# Substitua as informações conforme sua configuração local
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_filmes
DB_USERNAME=root
DB_PASSWORD=

# Crie o banco de dados 'sistema_filmes' (via phpMyAdmin ou linha de comando)

# Execute as migrations e seeds
$ php artisan migrate --seed

# Instale as dependências Node.js
$ npm install

# Compile os assets
$ npm run dev

# Crie o link simbólico para a pasta de storage
$ php artisan storage:link

# Crie a pasta de uploads se não existir
$ mkdir -p public/uploads
```

### 🖥️ Executando o projeto via Artisan Serve

```bash
# Inicie o servidor de desenvolvimento
$ php artisan serve

# O servidor iniciará na porta 8000 - acesse http://localhost:8000
```

### 🌐 Executando via XAMPP (localhost)

1. Certifique-se que o XAMPP está instalado e funcionando
2. Coloque o projeto na pasta `htdocs` do XAMPP (ex: `C:\xampp\htdocs\sistema-filmes` ou `/opt/lampp/htdocs/sistema-filmes`)
3. Inicie os serviços Apache e MySQL no painel de controle do XAMPP
4. Acesse o projeto em `http://localhost/sistema-filmes/public`

### 👤 Credenciais de teste

```
Email: teste@filme.com
Senha: 12345678
```

## 📁 Estrutura do Projeto

```
sistema-filmes/
├── app/
│   ├── Http/Controllers/
│   │   └── FilmeController.php          # Controller principal
│   └── Models/
│       └── Filme.php                    # Model com relacionamentos e validação
├── database/
│   ├── migrations/
│   │   └── 2025_09_21_190804_create_filmes_table.php  # Estrutura da tabela
│   └── seeders/
│       ├── DatabaseSeeder.php           # Orquestrador de seeders
│       └── FilmeSeeder.php             # Dados iniciais
├── resources/views/
│   ├── layouts/
│   │   └── app-filmes.blade.php        # Layout base reutilizável
│   ├── filmes/
│   │   ├── index.blade.php             # Listagem com paginação
│   │   ├── create.blade.php            # Formulário de criação
│   │   ├── show.blade.php              # Visualização detalhada
│   │   └── edit.blade.php              # Formulário de edição
│   └── dashboard.blade.php             # Página inicial
├── routes/
│   └── web.php                         # Definição de rotas
└── public/uploads/                     # Pasta para arquivos de mídia
```

## ✅ Requisitos Implementados

| Requisito                      | Status   | Implementação                          |
| ------------------------------ | -------- | -------------------------------------- |
| ✅ Framework Laravel            | Cumprido | Versão mais recente                    |
| ✅ CSS para estilização         | Cumprido | CSS customizado incorporado            |
| ✅ Sistema CRUD                 | Cumprido | Create, Read, Update, Delete completos |
| ✅ Manipulação de imagem/vídeo  | Cumprido | Upload e renderização de ambos         |
| ✅ Tema diferente (não Produto) | Cumprido | Sistema de Filmes                      |
| ✅ Tabela com 5+ campos         | Cumprido | 9 campos total, 6 principais           |
| ✅ Campo "arquivo" obrigatório  | Cumprido | Armazena nome do arquivo               |
| ✅ Validação na Model           | Cumprido | Método rules() estático                |
| ✅ Migration para criar tabela  | Cumprido | Com relacionamento e constraints       |
| ✅ Seeds com 3 entradas         | Cumprido | Usuário teste + 3 filmes               |
| ✅ Middleware auth              | Cumprido | Proteção total das operações           |
| ✅ Controle de propriedade      | Cumprido | Só dono edita/exclui                   |
| ✅ Paginação na listagem        | Cumprido | 5 registros por página                 |
| ✅ Layout padrão reutilizável   | Cumprido | Template blade com navegação           |
| ✅ Sistema de navegação         | Cumprido | Menu, links, botões de ação            |

## 📝 Documentação Adicional

Para mais informações sobre os diagramas e fluxos da aplicação, consulte o arquivo [diagramas.md](diagramas.md).

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
