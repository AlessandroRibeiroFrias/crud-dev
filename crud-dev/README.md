# Crud de cadastros de Developers com Slim.

## Instalar a aplicação.

Executar o seguinte comando do composer, para instalar as dependências da aplicação.

```bash
composer install
```

Executar o comando para subir os containers do Docker

```bash
docker-compose up
```

Após subir os container do Docker, realizar a alteração no arquivo DBConfig.php para o ip do docker, variável self::$HOST
```bash
	'crud-dev\src\Infrastructure\Connection\DBConfig.php'
```

Executar o script de banco de dados que está na raiz do projeto, para criar a base e inserir alguns registros.

```bash
sql_01
```