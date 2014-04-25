<?php

Namespace Solr
{
    USE \SolrInputDocument AS Document;

    Class Client
    {
        public $document = NULL;

        private $records = [],
                $chain   = [];

        public function __construct(Document $document = NULL)
        {
            $this->document = New Document();
        }

        public function assemble()
        {
            $this->chain($this->records); die;
        }

        public function setRecords(array $records)
        {
            $this->records = $records;

                return $this; // chain
        }

        public function setArrayRecursive($records)
        {
            $it = New \RecursiveIteratorIterator(New \RecursiveArrayIterator($records), \RecursiveIteratorIterator::SELF_FIRST);

            foreach ($it AS $key => $value)
            {
                if ($it->hasChildren()) {
                    echo "\n :::$key: "; // At end: show key, value and path
if (! is_array($value))
foreach($value AS $f => $r)
{
    echo "\n $f : $r";
}
                } else {

                    echo "\n-> $key : $value";


                }
            }
        }

        private function chain(array $records)
        {
            $this->chain = $this->add();
            foreach ($records AS $key => $value)
            {
               $this->setArrayRecursive($value);
            }
        }

        private function add()
        {
            return New Document();
        }
    }
}
