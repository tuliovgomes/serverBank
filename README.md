# API Boilerplate

Um jeito fácil e rápido de começar uma API REST em Laravel 7.

## Instalação

```bash
git clone git@github.com:somosyampi/api-boilerplate.git my-project
cd my-project
cp env-example .env
php artisan key:geneate
php artisan jwt:secret
```

2. Configure as credenciais do banco de dados e rode:

```bash
php artisan migrate
```

3. Usuário default

```bash
php artisan db:seed --class=UsersSeeder
```

## Autenticação

Existem duas formas de autenticação na API: por Bearer Token ou API Key.

### Bearer Token

Existe uma rota pré-definida que retorna o token de autenticação baseado no e-mail e senha do usuário.

```bash
curl -X POST https://your-host.com/api/auth/login -H 'content-type: application/json' -d '{
    "email": "user@yampi.com.br", 
    "password": "password"
}'
```

### API Key

Neste tipo de autenticação, basta passar o header  `Api-Key` nas requisições autenticadas.