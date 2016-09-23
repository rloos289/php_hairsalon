<?php
    class Client
    {
        private $id;
        private $name;
        private $stylist_id;

        function __construct($name, $id = null, $stylist_id = null)
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

    }
?>
