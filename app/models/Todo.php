<?php

// Require config
require_once __DIR__ . "/../../config.php";

require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/app/utils/Connection.php";

class Todo
{
    // Koneksi ke database
    private $database;
    private $db;

    // Properti di tabel
    public $id;
    public $judul_tugas;
    public $detail;
    public $foto_path;
    public $deadline;
    public $is_done;

    // Nama table
    public $table_name = "todo";

    // Metode constructor, menjalankan perintah ketika class/object dipanggil
    public function __construct()
    {
        $this->database = new Connection();
        $this->db = $this->database->conn;
    }

    // Metode create data
    public function create(Todo $todo)
    {
        $result = [
            "success" => true,
            "messages" => "Berhasil menambah todo",
        ];

        try {
            $query = "INSERT INTO `todo`(`judul_tugas`, `detail`, `foto_path`, `deadline`, `is_done`)
                VALUES ('{$todo->judul_tugas}','{$todo->detail}','{$todo->foto_path}','{$todo->deadline}','{$todo->is_done}')";
            $execute = mysqli_query($this->db, $query);

            return $result;

        } catch (Exception $e) {
            $result['success'] = false;
            $result['messages'] = $e;
            return $result;
        }
    }

    // Metode ambil satu data berdasarkan ID
    public function getObject($id){
        $result = [
            "success" => true,
            "messages" => "Berhasil mengambil todo",
        ];

        try {
            $query = "SELECT * FROM todo WHERE id={$id} LIMIT 1";
            $execute = mysqli_query($this->db, $query);

            $result['data'] = $execute;

            return $result;
        } catch (Exception $e){
            $result['success'] = false;
            $result['messages'] = $e;
            return $result;
        }
    }

    // Metode read data
    public function read()
    {
        $result = [
            "success" => true,
            "messages" => "Berhasil mengambil todo",
        ];

        try {
            $query = "SELECT * FROM todo ORDER BY id DESC";
            $execute = mysqli_query($this->db, $query);

            $result['data'] = $execute;

            return $result;
        } catch (Exception $e){
            $result['success'] = false;
            $result['messages'] = $e;
            return $result;
        }
    }

    // Metode update data
    public function update(Todo $todo)
    {
        $result = [
            "success" => true,
            "messages" => "Berhasil update todo",
        ];

        try {
            $query = "UPDATE `todo` SET 
                `judul_tugas`='{$todo->judul_tugas}',
                `detail`='{$todo->detail}',
                `foto_path`='{$todo->foto_path}',
                `deadline`='{$todo->deadline}',
                `is_done`='{$todo->is_done}' 
                WHERE id='{$todo->id}'";
            $execute = mysqli_query($this->db, $query);

            return $result;
        } catch (Exception $e){
            $result['success'] = false;
            $result['messages'] = $e;
            return $result;
        }
    }

    // Metode delete data
    public function delete($id)
    {
        $result = [
            "success" => true,
            "messages" => "Berhasil hapus todo",
        ];

        try {
            $query = "DELETE FROM `todo` WHERE id='{$id}'";
            $execute = mysqli_query($this->db, $query);

            return $result;
        } catch (Exception $e){
            $result['success'] = false;
            $result['messages'] = $e;
            return $result;
        }
    }
}
