https://www.udemy.com/course/symfony-course/
Symfony course by Fabian Heihoff






symfony new my_project_directory --version="6.1.*"
composer create-project symfony/skeleton:"6.1.*" my_project_directory
composer require webapp
symfony server:start
php bin/console about
php bin/console debug:router
composer req twig
composer req make
composer req doctrine
composer require symfony/flex
composer require logger
symfony console make:controller             php bin/console make:controller
composer req annotations
"laminas/laminas-code":"~4.5.0@dev", <= composer.json
composer install
symfony console doctrine:database:create
symfony console doctrine:schema:update --dump-sql
symfony console doctrine:schema:update --dump-sql
symfony console make:controller ArticleController