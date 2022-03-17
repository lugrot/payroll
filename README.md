## Simple Payroll Report Service

### Installation
1. Copy .env.dist file
```shell
$ cp .env.dist .env
```

2. Run containers
```shell
$ docker-compose up
```

3. Install dependencies
```shell
$ docker-compose exec php composer install
```

4. Prepare database
```shell
$ docker-compose exec php composer prepare-database
```

5. Access Service
```shell
$ open http://$(docker-compose port nginx 80)
```
