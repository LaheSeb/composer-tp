<?php  
require_once '../vendor/autoload.php';

use App\Manager\UserManager;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
$logger = new Logger('main');

$logger->pushHandler(new StreamHandler(__DIR__. '/../log/app.log', Logger::INFO));

$logger->info('First message');
$logger->debug('2eme message');

print("1) OK <br/>");

//Definir le dossier ou se trouvent kes templates
$loader = new FilesystemLoader('..\templates');

print("2) OK<br/>");


// Initialiser l'enviorrement de twig et definir le dossier du cache

$twig = new Environment($loader , ['cache'=> '../cache']);

print("3) OK<br/>");

//afficher les variables du templates et appeler le rendu
$manager = new UserManager($db);
echo $twig->render('base.html.twig',
[
    'title' => 'Liste des utilisateur',
    'users'  => $manager->getList(),
]);


