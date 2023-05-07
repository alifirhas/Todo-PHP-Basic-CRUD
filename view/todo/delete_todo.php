<?php

// Tampilkan error manual
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Require config
require_once __DIR__ . "/../../config.php";

require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/app/controllers/TodoController.php";

$todo_controller = new TodoController();
$todo_id = $_GET['id'];

// Template head HTML
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/view/templates/head.php";

// Delete todo
// ! Delete file bikin sendiri
$todo_delete = $todo_controller->delete($todo_id);
if ($todo_delete['success'] != true){
    echo "
    <div class='p-4'>    
        <div class='alert alert-error shadow-lg mt-4'>
            <div>
                <svg xmlns='http://www.w3.org/2000/svg' class='stroke-current flex-shrink-0 h-6 w-6' fill='none' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>
                <span>Error! {$todo_delete['messages']}</span>
            </div>
        </div>
        <a href='./index.php' class='btn btn-info mt-4 w-full'>Kembali Ke Home</a>
    </div>
    ";
    
    return false;
}

echo '
<script>
    window.location.href = "./index.php";
</script>
';

// Template foot HTML
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/view/templates/foot.php";
