<?php
/*Configurar */
define('host','localhost');
define('user','americana');
define('pass','Educ4t%2019');
define('dbname','naf');

/*MySQL*/
# define('connstring','mysql:host='.host.';dbname='.dbname.';charset=utf8');
/*pgSQL*/
define('connstring','pgsql:host='.host.';port=5432;dbname='.dbname);
?>