
# Onfly - Test 

Após clonar o projeto acesse a pasta `backend` e execute o seguinte comando no terminal :

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
Após isso acesse a pasta frontend e execute o seguinte comando para realizar a build do front

    yarn install && yarn quasar dev --watch
#
Para executar os testes unitários também preparei um script a fim de agilizar a execução do comando

    ./test.sh
Caso não queira utilizar o script, basta executar o seguinte comando:

    docker-compose exec onfly-nginx bash -c "php artisan test"
## Rotas

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|POST|`api/register` | 

![image](https://github.com/gmarkiin/onfly/assets/69984666/428e89de-2dba-419b-81e2-ddd29d069129)


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

![image](https://github.com/gmarkiin/onfly/assets/69984666/271b0170-4525-4943-b1ca-f16797fa2cfc)


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

![image](https://github.com/gmarkiin/onfly/assets/69984666/537df106-dbdf-4b4f-b11d-fd62d2bd6b7a)


    curl --request GET \
      --url http://localhost:8080/api/expenses \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer token'

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|POST|`api/expenses` |

![image](https://github.com/gmarkiin/onfly/assets/69984666/a58184c9-fb87-4a57-b785-ac1ca275405e)


    curl --request POST \
      --url http://localhost:8080/api/expenses \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer token' \
      --header 'Content-Type: application/json' \
      --data '{
    	"description": "teste",
    	"value": 560.70,
    	"expense_date": "2023-02-20"
    }'

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|GET|`api/expenses/<id>` |

![image](https://github.com/gmarkiin/onfly/assets/69984666/4e8cbe8f-7993-4efb-aa1a-1a7b0d57741a)


    curl --request GET \
      --url http://localhost:8080/api/expenses/1 \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer token'

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|PATCH|`api/expenses/<id>` |

![image](https://github.com/gmarkiin/onfly/assets/69984666/3b475606-272c-4f4a-a011-862c6c85383d)


    curl --request PATCH \
      --url http://localhost:8080/api/expenses/1 \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer token' \
      --header 'Content-Type: application/json' \
      --data '{
    	"description": "adsadas@gmail.com",
    	"value": 31,
    	"expense_date": "2023-02-15"
    }'

| Verbo Http     |Endpoint                           |
|----------------|-------------------------------|
|DELETE|`api/expenses/<id>` |

![image](https://github.com/gmarkiin/onfly/assets/69984666/90504118-b27d-46d9-a7e0-8bbaf198c9a3)


    curl --request DELETE \
      --url http://localhost:8080/api/expenses/5 \
      --header 'Accept: application/json' \
      --header 'Authorization: Bearer token'

##  

