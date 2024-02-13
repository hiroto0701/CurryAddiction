FROM node:18-alpine

WORKDIR /app

COPY ./frontend-admin/package*.json ./

RUN apk update

CMD ["npm", "run", "dev"]