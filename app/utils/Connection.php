<?php

class Connection
{
    // Properti untuk membuat koneksi
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database_name = "test";

    // Properti koneksi yang diakses oleh class lain
    public $conn;

    // Constructor untuk membuat koneksi ketika class Connection dipanggil
    public function __construct(){
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database_name);
        if ($this->conn->connect_error){
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    // Metode untuk tutup koneksi
    public function close(){
        $this->conn->close();
    }

}
