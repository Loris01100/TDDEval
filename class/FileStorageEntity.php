<?php

class FileStorageEntity 
{
    private $filename;

    public function __construct($filename) 
    {
        $this->filename = $filename;
    }

    public function save($data) 
    {
        file_put_contents($this->filename, serialize($data));
    }

    public function load() 
    {
        if (!file_exists($this->filename)) {
            return null;
        }
        $data = file_get_contents($this->filename);
        return unserialize($data);
    }
}