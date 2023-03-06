<?php


    namespace src;


    class Database
    {
        private $conn;

        public function __construct()
        {
            $this->conn = new \mysqli('localhost', 'devsite2_test','andrewandrewandrew', 'devsite2_test');
            if ($this->conn->connect_error) {
                die('Connection failed: ' . $this->conn->connect_error);
            }
        }

        /**
         * @return \mysqli
         */
        public function getConn(): \mysqli
        {
            return $this->conn;
        }

    }