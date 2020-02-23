up: docker-compose up -d

build-production:
    docker build --build-arg ENVIRONMENT=prod -f docker/nginx/Dockerfile -t judzhin/gc-nginx-example:v1 .
    docker build --build-arg ENVIRONMENT=prod -f docker/php-fpm/Dockerfile -t judzhin/gc-php-fpm-example:v1 .

push-production:
    docker push judzhin/gc-nginx-example:v1
    docker push judzhin/gc-php-fpm-example:v1