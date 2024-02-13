FROM node:18-alpine

WORKDIR /app

COPY ./frontend-user/package*.json ./

RUN apk update

CMD ["npm", "run", "dev"]