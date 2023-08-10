# Busca de CEPs - Projeto Full Stack

Este projeto consiste em uma aplicação Full Stack desenvolvida com Laravel (backend) e Vue.js (frontend) para busca, cadastro, edição e exclusão de endereços por meio de CEPs.

## Requisitos

- PHP >^= 9
- Composer
- Node.js >^= 14
- npm
- Banco de dados MySQL ou outro suportado pelo Laravel

## Configuração

1. Clone este repositório para a sua máquina:

```bash
git clone https://github.com/mthiagoalves/search-cep-project
cd nome-do-projeto
```

2. Instale as dependências do backend:

```bash
composer install
```

3. Copie o arquivo .env.example para .env e configure as variáveis de ambiente, incluindo as informações do banco de dados.

4. Gere a chave de aplicação:

```bash
php artisan key:generate
```

5. Rode as migrações para criar as tabelas do banco de dados:

```bash
php artisan migrate
```

6. Instale as dependências do frontend:

```bash
npm install
```

## Executando a Aplicação

1. Inicie o servidor backend (Laravel):

```bash
php artisan serve

```

2. Inicie o servidor frontend (Vue.js):

```bash
npm start dev
```

🟩 Acesse a aplicação no navegador:
    http://localhost:8000

## Uso

- Acesse a página para listar os endereços cadastrados, cadastrar novos endereços, editar e excluir.

- Utilize a funcionalidade de busca para pesquisar endereços já cadastrados por CEP ou Logradouro.

