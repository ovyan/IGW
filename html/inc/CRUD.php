<?php

    include_once 'ICRUD.php';

    class CRUD implements ICRUD {
        /**
         * @param string $stm
         * @return false|PDOStatement
         */
        function prepare(string $stm) {
            $stm = $this->db->prepare($stm);

            return $stm;
        }

        /**
         * @param string $stm
         * @param array $params
         * @return PDOStatement | false
         */
        function prepareStatement(string $stm, array $params) {
            $stm = $this->db->prepare($stm);

            foreach ($params as $p => $v)
                $stm->bindParam($p, $v);

            return $stm;
        }

        /**
         * @var PDO
         */
        private $db;
        
        /**
         * @var string
         */
        private $host;

        /**
         * @var string
         */
        private $port;

        /**
         * @var string
         */
        private $user;

        /**
         * @var string
         */
        private $dbName;

        /**
         * CRUD constructor.
         * @param string $host
         * @param string $port
         * @param string $user
         * @param string $dbName
         */
        public function __construct(string $host = 'localhost', string $port = '5432', string $user = 'postgres', string $dbName = 'mike') {
            $this->host   = $host;
            $this->port   = $port;
            $this->user   = $user;
            $this->dbName = $dbName;

            $this->db = new PDO("pgsql:host=$host user=$user dbname=$dbName");
        }
    }
