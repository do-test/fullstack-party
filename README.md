**About**

I have to use ZF at work, but I love Symfony. It's just awesome :)

I'm not really sure if it's all done the pure Symfony way, but it should be close to it. Anyway, frameworks are here to help, not force us into something.

**How to run the project**

To avoid any accidental issues, I suggest clearing caches manually before execution: 

`rm -rf var/cache/*`

`rm -rf var/log/*`

I'm sure you already have recent versions of _docker_ and _docker-compose_. Execute this single command: 

`docker-compose up -d`

And go to http://127.0.0.1:8000

**For local development**

Fix .env config:

`cp .env.dist .env`

Run locally with php installed:

`php -S 127.0.0.1:8000 -t public`

Wanna debug?

`php -dxdebug.remote_enable=1 -dxdebug.remote_autostart=1 -S 127.0.0.1:8000 -t public`

**Tests**

`docker-compose run phpfpm ./bin/phpunit`
