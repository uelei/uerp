Uerp
========================
Projeto em fase : alpha  

![](https://raw.githubusercontent.com/uelei/uerp/master/screenshot.png)


Projeto de erp em php usando o framework [Symfony2](http://symfony.com/)

para instalar é nescessario ja esteja instalado o lamp ( apache + php + mysql )

primeiro clone esse git

**git clone https://github.com/uelei/uerp.git **

depois baixe o composer para instalar as depencencias

**curl -sS https://getcomposer.org/installer | php**

execute o composer

**php composer.phar update**


comandos criar o banco de dados

app/console doctrine:database:create

criar as tableas

app/console doctrine:schema:update

para criar um usuario

fos:user:cretate

pronto tudo deve funcionar.

qualquer problema entre em contato [@uelei](https://twitter.com/uelei).
