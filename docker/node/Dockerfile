FROM node:16 as dev

WORKDIR /var/www/justcode

RUN userdel -r node
RUN useradd -G www-data -m devel
USER devel


#FROM dev as build
#
#COPY package*.json ./
#
#COPY --from=registry.britenet.com.pl/php/bs-eol/php-apache:latest /var/www/justcode/vendor ./vendor
#RUN ls -la
#RUN id
#RUN npm i
#RUN yarn encore production
#
#
#FROM dev as prod
#
#COPY --from=build node_modules ./
#COPY --from=build public/build ./
