<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    //Epicodus
    // $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    // $username = 'root';
    // $password = 'root';
    // $DB = new PDO($server, $username, $password);

    //home mac
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase

    //run test in terminal: ./vendor/bin/phpunit tests

    //on Mac: run: export PATH=$PATH:./vendor/bin
    //then run phpunit tests

    {
        protected function teardown()
        {
            Stylist::deleteAll();
        }

        function test_save()
        {
            $stylist = "Suzan";
            $test_stylist = new Stylist($stylist);
            $test_stylist->save();

            $result = Stylist::getAll();

            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_get_all()
        {
            $stylist1 = "Suzan";
            $stylist2 = "Jacob";
            $test_stylist1 = new Stylist($stylist1);
            $test_stylist1->save();
            $test_stylist2 = new Stylist($stylist2);
            $test_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist1, $test_stylist2], $result);
        }

        function test_delete_all()
        {
            $stylist1 = "Suzan";
            $stylist2 = "Jacob";
            $test_stylist1 = new Stylist($stylist1);
            $test_stylist1->save();
            $test_stylist2 = new Stylist($stylist2);
            $test_stylist2->save();

            Stylist::deleteAll();
            $result = Stylist::deleteAll();

            $this->assertEquals(null, $result);
        }

        function test_find_stylist()
        {
            $stylist1 = "Suzan";
            $stylist2 = "Jacob";
            $test_stylist1 = new Stylist($stylist1);
            $test_stylist1->save();
            $test_stylist2 = new Stylist($stylist2);
            $test_stylist2->save();

            $result = Stylist::find($test_stylist1->getId());

            $this->assertEquals($test_stylist1, $result);
        }

   }

 ?>
