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

    public function getTableName() {
        echo $this->todo_model->table_name;
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
        }

    }

    // Metode read data
    public function read()
    {
        $result = [
            "success" => true,
            "messages" => "Berhasil menambahkan todo",
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
        }
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
