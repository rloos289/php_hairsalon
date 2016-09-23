<?php
    class Client
    {
        private $id;
        private $name;
        private $stylist_id;

        function __construct($name, $stylist_id = null, $id = null)
        {
            $this->id = $id;
            $this->name = $name;
            $this->stylist_id = $stylist_id;
        }

        function setName ()
        {
            $this->name = $name;
        }

        function getStylistId ()
        {
            return $this->stylist_id;
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
            $GLOBALS['DB']->exec("INSERT INTO client (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()})");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM client;");
            $client_array = array();
            foreach ($returned_clients as $client) {
                $client_name = $client['name'];
                $id = $client['id'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client ($client_name, $stylist_id, $id);
                array_push($client_array, $new_client);
            }
            return $client_array;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM client;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM client WHERE id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach($clients as $client) {
                $client_id = $client->getId();
                if ($client_id == $search_id) {
                  $found_client = $client;
                }
            }
            return $found_client;
        }

        function update($name)
        {
            $this->name = $name;
            $GLOBALS['DB']->exec("UPDATE client SET name = '{$this->name}' WHERE id = {$this->getId()};");
        }
    }
?>
