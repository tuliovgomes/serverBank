# API Boilerplate

Um jeito fácil e rápido de começar uma API REST em Laravel 9.

## Packages

- [Dingo API](https://github.com/dingo/api)
- [Fireable](https://github.com/envant/fireable)
- [Laravel Auditing](http://www.laravel-auditing.com/)
- [L5 Repository](https://github.com/andersao/l5-repository)
- [Respect Validation](https://github.com/respect/validation)
- [Laravel Permission](https://docs.spatie.be/laravel-permission/v3/introduction/)
- [JWT Auth](https://jwt-auth.readthedocs.io/en/develop/)
- [Laravel Sanctum](https://laravel.com/docs/9.x/sanctum)

## Usando em um novo projeto

Para iniciar um novo projeto a partir desse repositório, copie a pasta e altere tudo relacionado a boilerplate para o nome do seu projeto, nos arquivos `.env.example` e `docker-compose.yml`.

Pode ser interessante também remover arquivos de frontend se o projeto for somente backend, como `vite.config.js`, a pasta `resources`, e algumas env vars do `.env.example`.

## Instalação

Rode na pasta do projeto:

```bash
yoda start

yoda composer install

cp .env.example .env
yoda artisan key:generate
yoda artisan jwt:secret
```

2. Configure as credenciais do banco de dados e rode:

```bash
yoda artisan migrate
```

3. Usuário default

```bash
yoda artisan db:seed
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
