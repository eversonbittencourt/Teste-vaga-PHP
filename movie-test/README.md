# Requisitos

## Requisitos do Sistema
---------------------------------
#### Possuir istalado a versão 5.7 do MySQL ou posterior.

#### Pussuir instalado PHP versão 7.1.3 ou posterior.
---------------------------------

## Requisitos para a execução e alteração do projeto.
---------------------------------
#### Possuir o [Composer][1] instalado.

---------------------------------


# Instalaçao

## Passos para instalação
---------------------------------
### Instalação do reositório e Base de Dados.

#### 1º Faça o clone do projeto na sua máquina.

#### 2º Criar um novo banco.

#### 3º Criar uma cópia do arquivo .env.example e renomear para .env

#### 4º Alterar as informações de BD conforme as credenciais de seu ambiente.

	DB_DATABASE=nomodobanco
	DB_USERNAME=nomedousuario
	DB_PASSWORD=password

---------------------------------
### Os comandos abaixo devem ser executados sempre no diretório do projeto.

#### 1º Executar comando para instalação do Composer.
	composer install

#### 2º Executar comando para gerar chave de acesso.
##### OBS: Após executar o comando abaixo, o arquivo .env em seu ambiente será alterado, passando a constar na sua  variável APP_KEY  a sua chave de segurança, essa chave é importante pois será a responsável por criptografar as informações como Cookies e Sessions mantendo a segurança dos dados.
	php artisan key:generate

#### 3º Executar comando para geração de banco de dados.
	 php artisan migrate

#### 4º Executar comando para execução do ambiente.
	php artisan serve
---------------------------------


[1]: https://getcomposer.org/
[2]: https://nodejs.org/en/
