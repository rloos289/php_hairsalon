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
        return $app['twig']->render("home.html.twig", array('stylists' => Stylist::getAll()));
    });

    $app->get("/", function() use ($app) {
        return $app ['twig']->render('home.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/clear", function() use ($app) {
        Stylist::deleteAll();
        Client::deleteAll();
        return $app['twig']->render("home.html.twig", array('stylists' => Stylist::getAll(), 'clients' => Client::getAll()));
    });

    $app->delete('/stylist/{id}', function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app ['twig']->render('home.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/editclient/{id}", function ($id) use ($app) {
        $client = Client::find($id);
        $stylist = Stylist::find($client->getStylistId());
        return $app ['twig']->render("editclient.html.twig", array("clients" => Client::getAll(), 'client' => $client, 'stylist' => $stylist));
    });

    $app->delete('/editclient/{id}', function($id) use ($app) {
        $stylist = Stylist::find($id);
        $clients = $stylist->clientSearch();
        return $app ['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    // $app->delete('/client/{id}', function($id) use ($app) {
    //     $client = Client::find($id);
    //     $stylist = Stylist::find($client->getStylistId());
    //     $client->delete();
    //     $clients = $stylist->clientSearch();
    //     return $app ['twig']->render('home.html.twig', array('stylists' => Stylist::getAll()));
    // });

    $app->get("/stylist/{id}", function($id) use ($app) {
        $stylist_id = Stylist::find($id);
        $client_list = $stylist_id->clientSearch();
        return $app['twig']->render('stylist.html.twig', array('stylists' => Stylist::getAll(), 'clients' => Client::getAll(), 'stylist' => $stylist_id, 'clients' => $client_list));
    });

    $app->post("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $name = $_POST['add_client'];
        $stylist_id = $id;
        $new_client = New Client ($name, $stylist_id);
        $new_client->save();
        $clients = $stylist->clientSearch();
        return $app ['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    return $app;
?>
