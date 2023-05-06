<?php

class Todo
{
    // Koneksi ke database
    private $conn;

    // Properti di tabel
    public $id;
    public $judul;
    public $detail;
    public $foto_path;
    public $deadline;
    public $is_done;

    // Metode constructor, menjalankan perintah ketika class/object dipanggil
    public function __construct($db){
        $this->conn = $db;
    }

    // Metode create data
    public function create()
    {
        
    }

    // Metode read data
    public function read()
    {

    }

    // Metode update data
    public function update()
    {

    }

    // Metode delete data
    public function delete()
    {

    }
}
