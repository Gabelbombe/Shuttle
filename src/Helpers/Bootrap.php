<?php

Namespace Helpers
{
    Class Bootstrap
    {
        private $utid    = FALSE,
                $payload = [];

        public function __construct(array $payload = [])
        {
            // convert CLI opts to GET params if you're playing from the command line
            if (! $payload['type']) parse_str(implode("&", array_slice($payload['args'], 1)), $_GET);

            print_r($_GET);
        }

        public function run()
        {
            header('Content-type: text/plain; charset=UTF-8');
            if (! isset($_SESSION['utid'])) $this->createNewSession();
        }

        private function createNewSession()
        {
            $this->utid = md5(time() + rand());
            $adapter = New Adapter();
            print_r($adapter);
        }
    }
}