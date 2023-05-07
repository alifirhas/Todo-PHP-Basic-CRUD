<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Require config
require_once __DIR__ . "/../../config.php";

require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/app/models/Todo.php";

class TodoController
{
    private $todo_model;

    public function __construct(){
        $this->todo_model = new Todo();
    }


    // Metode create data
    public function create(Todo $todo)
    {
        $result = [
            "success" => true,
            "messages" => "Berhasil menambahkan todo",
        ];

        try {
            $create_todo = $this->todo_model->create($todo);

            if ($create_todo['success'] != true){
                $result['success'] = false;
                $result['messages'] = $create_todo['messages'];
            }

            return $result;

        } catch (Exception $e){
            $result['success'] = false;
            $result['messages'] = $e;
            return $result;
        }

    }

    // Metode ambil satu data berdasarkan ID
    public function getObject($id)
    {
        $result = [
            "success" => true,
            "messages" => "Berhasil mengambil todo",
        ];
        
        try {
            $get_todo = $this->todo_model->getObject($id);

            if ($get_todo['success'] != true){
                $result['success'] = false;
                $result['messages'] = $get_todo['messages'];
            }

            $result['data'] = $get_todo['data'];

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
            $get_todo = $this->todo_model->read();

            if ($get_todo['success'] != true){
                $result['success'] = false;
                $result['messages'] = $get_todo['messages'];
            }

            $result['data'] = $get_todo['data'];

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
            $update_todo = $this->todo_model->update($todo);

            if ($update_todo['success'] != true){
                $result['success'] = false;
                $result['messages'] = $update_todo['messages'];
            }

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
            $delete_todo = $this->todo_model->delete($id);

            if ($delete_todo['success'] != true){
                $result['success'] = false;
                $result['messages'] = $delete_todo['messages'];
            }

            return $result;

        } catch (Exception $e){
            $result['success'] = false;
            $result['messages'] = $e;
            return $result;
        }
    }

}
