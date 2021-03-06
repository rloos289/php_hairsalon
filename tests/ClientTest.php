<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    //Epicodus
    // $server = 'mysql:host=localhost;dbname=hair_salon_test';
    // $username = 'root';
    // $password = 'root';
    // $DB = new PDO($server, $username, $password);

    //home mac
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase

    {
        protected function teardown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function test_save()
        {
            $client = "Lauren";
            $test_client = new Client($client, 1);
            $test_client->save();

            $result = Client::getAll();

            $this->assertEquals($test_client, $result[0]);
        }

        function test_get_all()
        {
            $client1 = "Lauren";
            $client2 = "Mitch";
            $test_client1 = new Client($client1, 1);
            $test_client1->save();
            $test_client2 = new Client($client2, 2);
            $test_client2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client1, $test_client2], $result);
        }

        function test_delete_all()
        {
            $client1 = "Lauren";
            $client2 = "Mitch";
            $test_client1 = new Client($client1, 1);
            $test_client1->save();
            $test_client2 = new Client($client2, 2);
            $test_client2->save();

            Client::deleteAll();
            $result = Client::getAll();

            $this->assertEquals([], $result);
        }

        function test_find_client()
        {
            $client1 = "Lauren";
            $client2 = "Mitch";
            $test_client1 = new Client($client1, 1);
            $test_client1->save();
            $test_client2 = new Client($client2, 2);
            $test_client2->save();

            $result = Client::find($test_client1->getId());

            $this->assertEquals($test_client1, $result);
        }

        function test_delete_client()
        {
            $client = "Lauren";
            $test_client = new Client($client);
            $test_client->save();
            $id = $test_client->getId();
            $test_client->delete();

            $result = Client::find($id);

            $this->assertEquals(null, $result);
        }

        function test_update()
        {
            $client = "Lauren";
            $test_client = new Client($client);
            $test_client->save();
            $test_client->update("Lory");

            $result = $test_client->getName();

            $this->assertEquals("Lory", $result);
        }

        function test_find_all_clients()
        {
            $stylist = "Suzanne";
            $test_stylist = new Stylist($stylist);
            $test_stylist->save();
            $client1 = "Lauren";
            $client2 = "Mitch";
            $test_client1 = new Client($client1, $test_stylist->getId());
            $test_client1->save();
            $test_client2 = new Client($client2, $test_stylist->getId());
            $test_client2->save();

            $result = $test_stylist->clientSearch();

            $this->assertEquals([$test_client1, $test_client2], $result);
        }
   }

 ?>
