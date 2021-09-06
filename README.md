

## Rodando o projeto
<p>
Foi feito a partir do sail com docker, depois
de subir os containers e esocial_laravel_test_1
</p>
<br/>
<br/>

- instalar as dependencias do composer: composer install <br/>
- instalar as dependencias do front end: npm install<br/>
- rodar o phpunit conferindo a insercao do dado no banco de dados: vendor/bin/phpunit<br/>
- rodar o build do vuejs: npm run watch<br/>
- ainda no container do backend: php artisan storage:link
- o acesso ao registro está disponivel em: http://localhost <br/>
- para verificar o template de envio de email acesse o mailHog por: http://localhost:8025/ 
