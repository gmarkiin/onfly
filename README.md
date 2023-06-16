
# Onfly - Test 

Após clonar o projeto execute o seguinte comando no terminal :

    ./init.sh
   Preparei esse script shell básico para facilitar a inicialização do projeto,após executar o script, o projeto já está totalmente apto a ser testado da maneira que desejar.
   
Se preferir não utilizar o script ./init para iniciar, basta executar os seguintes comandos em ordem:

    cp .env.example .env  
    cp docker-compose.yml.example docker-compose.yml
    docker-compose up -d
    docker-compose exec onfly-nginx bash -c "su -c \"composer install\" application"
    docker-compose exec onfly-nginx bash -c "su -c 'php artisan key:generate' application"
    docker-compose exec onfly-nginx php artisan migrate
#
Para executar os testes unitários também preparei um script a fim de agilizar a execução do comando

    ./test.sh
Caso não queira utilizar o script, basta executar o seguinte comando:

    docker-compose exec onfly-nginx bash -c "php artisan test"
## Rotas

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|POST|`api/register` |
![image](https://github.com/gmarkiin/onfly/assets/69984666/0cde389d-feef-496f-98f2-5886f30a9f35)

    curl --request POST \
      --url http://localhost:8080/api/register \
      --header 'Content-Type: application/json' \
      --data '{
    	"name": "teste",
    	"email": "teste@gmail.com",
    	"password": "123456"
    }'
| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|POST|`api/login` |
![image](https://github.com/gmarkiin/onfly/assets/69984666/b4200e18-2326-4ffb-96b3-525625c4702d)

    curl --request POST \
      --url http://localhost:8080/api/login \
      --header 'Content-Type: application/json' \
      --data '{
    	"email": "teste@gmail.com",
    	"password": "123456"
    }'

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|GET|`api/expenses` |
![image](https://github.com/gmarkiin/onfly/assets/69984666/ae125779-1d6d-4741-8c88-d803f71d0b24)

    curl --request GET \
      --url http://localhost:8080/api/expenses \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer 4|H0mAuThOhfKXEFhr6CwPIbEGm2kBgRrXlgVTYGAW'

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|POST|`api/expenses` |
![image](https://github.com/gmarkiin/onfly/assets/69984666/d2fe2e8a-20c5-4436-a559-d3b70a147662)

    curl --request POST \
      --url http://localhost:8080/api/expenses \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer 14|f7UfR49jXHh0l1UqfjSUGiwRGbTyIA23j5A2F7Mg' \
      --header 'Content-Type: application/json' \
      --data '{
    	"description": "teste",
    	"value": 560.70,
    	"created_at": "2023-02-20"
    }'

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|GET|`api/expenses/<id>` |
![image](https://github.com/gmarkiin/onfly/assets/69984666/0c2f3244-fd67-4df1-8dcd-eded1fdaa28c)

    curl --request GET \
      --url http://localhost:8080/api/expenses/1 \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer 3|Z9tXBJeko9OYR4paK2p8Du2rfffL5jO8pnTy5qzd'

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|PATCH|`api/expenses/<id>` |
![image](https://github.com/gmarkiin/onfly/assets/69984666/6eecdae9-e576-4328-80e9-f2682b0a2112)

    curl --request PATCH \
      --url http://localhost:8080/api/expenses/1 \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer 3|Z9tXBJeko9OYR4paK2p8Du2rfffL5jO8pnTy5qzd' \
      --header 'Content-Type: application/json' \
      --data '{
    	"description": "adsadas@gmail.com",
    	"value": 31,
    	"created_at": "2023-02-15"
    }'

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|DELETE|`api/expenses/<id>` |
![image](https://github.com/gmarkiin/onfly/assets/69984666/94557ed5-0721-4624-88b2-8ba1a426e3ea)

    curl --request DELETE \
      --url http://localhost:8080/api/expenses/5 \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer 3|Z9tXBJeko9OYR4paK2p8Du2rfffL5jO8pnTy5qzd'

##  

