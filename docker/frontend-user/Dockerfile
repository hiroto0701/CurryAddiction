FROM node:18-alpine

WORKDIR /app

COPY ./frontend-user ./

RUN apk update

CMD ["npm", "run", "dev"]