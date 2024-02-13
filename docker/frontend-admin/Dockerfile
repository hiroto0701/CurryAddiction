FROM node:18-alpine

WORKDIR /app

COPY ./frontend-admin ./

RUN apk update

CMD ["npm", "run", "dev"]