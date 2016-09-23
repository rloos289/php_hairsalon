<?php
    class Stylist
    {
        private $id;
        private $name;

        function __construct($name, $id = null)
        {
            $this->id = $id;
            $this->name = $name;
        }

        function setName ()
        {
            $this->name = $name;
        }

        function getiD ()
        {
            return $this->id;
        }

        function getName ()
        {
            return $this->name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylist (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylist;");
            $stylist_array = array();
            foreach ($returned_stylists as $stylist) {
                $stylist_name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist ($stylist_name, $id);
                array_push($stylist_array, $new_stylist);
            }
            return $stylist_array;
        }

        static function deleteall()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylist;");
        }

        static function find()
        {
            
        }
    }
?>
