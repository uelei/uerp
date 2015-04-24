Uerp
========================
Projeto em fase : alpha  

![](https://raw.githubusercontent.com/uelei/uerp/master/screenshot.png)


Projeto Opensource de ERP em php usando o framework [Symfony2](http://symfony.com/).


Modo de teste sem desenvolvimento (windows)
----------------------------------------

  * baixar [boot2docker](http://boot2docker.io)
  * iniciar o boot2docker
  * fz o pull da imagem pelo comando
  > **docker run -t -i -p 80:80 uelei/uerp**


Modo de desenvolvimento
---------------------------------------------

para instalar é nescessario ja esteja instalado o lamp ( apache + php + mysql )

* primeiro clone esse git

  > **git clone https://github.com/uelei/uerp.git **

* baixe o composer para instalar as depencencias

  > **curl -sS https://getcomposer.org/installer | php**

* execute o composer

  > **php composer.phar update**


Outros commandos
---------------------------------------------

Comandos criar o banco de dados

  > **app/console doctrine:database:create**

criar as tableas

> **app/console doctrine:schema:update**

para criar um usuario

> **fos:user:cretate**

pronto tudo deve funcionar.

qualquer problema entre em contato [@uelei](https://twitter.com/uelei).
