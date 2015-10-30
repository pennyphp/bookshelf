# Bookshelf

[![Build Status](https://travis-ci.org/pennyphp/bookshelf.svg)](https://travis-ci.org/pennyphp/bookshelf)

This demo is based on the [penny-classic-app](https://github.com/pennyphp/penny-classic-app)

This penny demo application is using the following components:

- doctrine/orm
- symfony/form
- symfony/http-foundation
- twig/twig


### Edit your configurations
There are a couple of things you may want to configure like doctrine cache, twig cache and so on.
You can find them under the `config/` folder.

## Production

Write down this section

## Development

### Dependencies

**Frontend**

```
npm install
grunt dev
```

**Composer**
```
composer install
```

### Docker environment setup

For more information please refer to: https://github.com/pennyphp/penny-classic-app#docker-nginxphp-fpm

```
cp docker/development/docker-compose.yml.development docker-compose.yml
docker-compose build
docker-compose up -d
```

### Prepare database

```
docker exec -ti bookshelf_mysql_1 mysql -pmysupersecretrootpassword -e 'create database demoapp'
docker exec -ti  bookshelf_fpm_1 bash -c 'cd bookshelf; vendor/bin/doctrine orm:schema-tool:create'
```

### Screenshot

![bookshelf](http://i.imgur.com/Up5tHCd.png)
![bookshelf](http://i.imgur.com/Df4X2uC.png)
