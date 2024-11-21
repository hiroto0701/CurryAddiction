FROM nginx:1.27-alpine

ENV TZ=Asia/Tokyo

RUN apk add --no-cache tzdata \
   && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
   && echo "Asia/Tokyo" > /etc/timezone

# nginx config file
COPY ./docker/nginx/*.conf /etc/nginx/conf.d/

WORKDIR /var/www/html