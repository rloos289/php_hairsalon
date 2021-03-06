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
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylist_array = array();
            foreach ($returned_stylists as $stylist) {
                $stylist_name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist ($stylist_name, $id);
                array_push($stylist_array, $new_stylist);
            }
            return $stylist_array;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist) {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id) {
                  $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }

        function update($name)
        {
            $this->name = $name;
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$this->name}' WHERE id = {$this->getId()};");
        }

        function clientSearch()
        {
            $client_array = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            foreach ($returned_clients as $client) {
                $client_name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client ($client_name, $stylist_id, $id);
                array_push($client_array, $new_client);
            }
            return $client_array;
        }
    }
?>
