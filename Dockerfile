FROM php:7.4-alpine

WORKDIR /myapp

COPY . .

EXPOSE 8082