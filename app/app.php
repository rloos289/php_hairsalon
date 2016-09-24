<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
      return $app['twig']->render("home.html.twig", array('stylists' => Stylist::getAll()));
    });

    $app->post("/", function() use ($app) {
      $name = $_POST['stylist_input'];
      $new_stylist = New Stylist ($name);
      $new_stylist->save();
      var_dump($new_stylist); //new stylist saves successfully and prints to page, though each new stylist does not seem to get a new id. No incrementing up even if I send it to another page. But all my tests work.
      var_dump(Stylist::getAll()); //array is empty for some reason
      return $app['twig']->render("home.html.twig", array('stylists' => Stylist::getAll()));
    });
    //
    $app->get("/clear", function() use ($app) {
      Stylist::deleteAll();
      Client::deleteAll();
      return $app['twig']->render("home.html.twig", array('stylists' => Stylist::getAll(), 'clients' => Client::getAll()));
    });

    return $app;
?>
