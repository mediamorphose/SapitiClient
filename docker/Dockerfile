FROM php:cli

# no apt cache cleaning, don't use this image in production please !
RUN apt-get update && apt-get install -y git zip unzip

WORKDIR /var/www