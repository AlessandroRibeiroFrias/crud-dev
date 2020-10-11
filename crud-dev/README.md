# Crud de cadastros de Developers com Slim.

## Instalar a aplicação.

Executar o seguinte comando do composer, para instalar as dependencias da aplicação.

```bash
composer install
```

Executar o comando para subir os container do Docker

```bash
docker-compose up
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
docker-compose up -d
```
Após subir os container do Docker, realizar a alteração no arquivo DBConfig.php para o ip do docker, variavel self::$HOST
```bash
	'crud-dev\src\Infrastructure\Connection\DBConfig.php'
```

Executar o script de banco de dados que está na raiz do projeto, para criar a base e inserir alguns registros.

```bash
sql_01
```
