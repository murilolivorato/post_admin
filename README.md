# POST ADMIN 

## Front End
### Instalação

#### Instale via NPM
```bash
npm install
```

#### Instale o Quasar
```bash
npm install -g @quasar/cli
```
#### Processe a Aplicação
```bash
quasar dev
```

## Back End
### Na pasta backend, instale o servidor via Docker
```bash
docker-compose up -d --build
```
### Instale o Laravel
```bash
docker-compose run --rm composer install
```
### Instale o Laravel
```bash
docker-compose run --rm composer install
```
### gere a chave
```bash
docker-compose run  --rm  artisan key:generate
```
### migrate 
```bash
docker-compose run  --rm artisan migrate
```
### db seed
```bash
docker-compose run  --rm artisan db:seed
```
### acesse o site em 
```bash
localhost:8080
```
### acesse o PhpMyAdmin em 
```bash
localhost:8890
```