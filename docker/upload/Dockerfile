FROM nginx:1.17-alpine

ARG ENVIRONMENT
ENV ENVIRONMENT=${ENVIRONMENT}
ARG DUMB_INIT_VERSION=1.2.0
ENV DUMB_INIT_VERSION=${DUMB_INIT_VERSION}

ADD https://github.com/Yelp/dumb-init/releases/download/v${DUMB_INIT_VERSION}/dumb-init_${DUMB_INIT_VERSION}_amd64 /usr/local/bin/dumb-init
RUN chmod +x /usr/local/bin/dumb-init

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default_${ENVIRONMENT}.conf /etc/nginx/conf.d/default.conf

COPY ./app/public /var/www/public

WORKDIR /var/www
ENTRYPOINT ["dumb-init", "--rewrite", "15:3"]
CMD ["nginx", "-g", "daemon off;"]
