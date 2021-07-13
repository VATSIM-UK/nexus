FROM webdevops/php-apache-dev:7.4

ENV WEB_DOCUMENT_ROOT=/app/nexus/public

WORKDIR /app/nexus/

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

RUN npm install -g yarn