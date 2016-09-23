<?php
    class Client
    {
        private $id;
        private $name;
        private $client_id;

        function __construct($name, $id = null, $client_id = null)
        {
            $this->id = $id;
            $this->name = $name;
            $this->client_id = $client_id;
        }

        function setName ()
        {
            $this->name = $name;
        }

        function getClientId ()
        {
            return $this->client_id;
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
            $GLOBALS['DB']->exec("INSERT INTO client (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM client;");
            $client_array = array();
            foreach ($returned_clients as $client) {
                $client_name = $client['name'];
                $id = $client['id'];
                $new_client = new Client ($client_name, $id);
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
