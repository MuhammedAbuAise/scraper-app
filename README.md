# Installation guide for scraper-app team

Firstly, you need install on local machine these soft :

##### 1. git bash
* Win: https://git-scm.com/downloads
* Linux (terminal): `sudo apt-get install git`

##### 2. docker
* win: https://docs.docker.com/docker-for-windows/install/
* Linux: https://docs.docker.com/install/linux/docker-ce/ubuntu/

##### 3. docker-compose
* installation : https://docs.docker.com/compose/install/

## After installing all soft you can start.

**Clone files from giving repository.**

**Create new `.env` file from `.env.example` and set credentials**

**Then on CMD/Terminal run:**
```
composer install
```

**Open CMD/Terminal under root (on linux `sudo su`) user and run:**
```
docker-compose build
``` 
_Note : First time it will take more time, you should not run it everytime before starting work._

**Then run following command:**
```
docker-compose up
```
_Note: You have to run this command everytime before starting work_

**Run following commands (on CMD/Terminal under root) from new tab step by step:**
```
docker-compose exec scraper-app composer install

docker-compose exec nginx chmod -R 777 /var/www/html/bootstrap/cache

docker-compose exec nginx chmod -R 777 /var/www/html/storage

docker-compose exec scraper-app php artisan key:generate

docker-compose exec scraper-app php artisan migrate

docker-compose exec scraper-app php artisan storage:link

```

Now you can open the project from this link : http://localhost:8000/

### We have finished installation ) happy coding...

*PS : For php artisan commands use (under root) `docker-compose exec scraper-app php artisan <your-command>`*

