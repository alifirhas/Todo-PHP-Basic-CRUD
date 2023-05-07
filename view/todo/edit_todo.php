<?php

// Tampilkan error manual
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Require config
require_once __DIR__ . "/../../config.php";

require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/app/models/Todo.php";
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/app/controllers/TodoController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/app/utils/FileUpload.php";

$todo = new Todo();
$todo_controller = new TodoController();
$file_upload = new FileUpload();

$todo_id = $_GET['id'];
$todo_get_item = $todo_controller->getObject($todo_id);
$todo_item = mysqli_fetch_array($todo_get_item['data']);

?>

<!-- Template head HTML -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/view/templates/head.php";
?>

<!-- Component navbar -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/view/components/navbar.php";
?>

<!-- Content -->
<!-- Form tambah todo -->
<div class="container mx-auto mt-4 p-4 bg-base-100 w-[70%]">
    <form action="" method="post" enctype="multipart/form-data">

        <div class="flex gap-4 w-full">
            <!-- Input judul tugas -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama tugas?</span>
                </label>
                <input type="text" name="judul_tugas" placeholder="Isi judul tugas" class="input input-bordered w-full" required value="<?= $todo_item['judul_tugas']; ?>" />
            </div>

            <!-- Input deadline -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Deadline?</span>
                </label>
                <input type="date" name="deadline" class="input input-bordered w-full" required value="<?= $todo_item['deadline']; ?>" />
            </div>
        </div>

        <div class="flex gap-4 mt-4">
            <img src="<?= $todo_item['foto_path'] ?>" alt="" class="w-48">
            <!-- Input gambar -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Gambar?</span>
                </label>
                <input type="file" name="foto" class="file-input file-input-bordered file-input-primary w-full" />
            </div>
        </div>

        <!-- Input detail tugas -->
        <div class="form-control">
            <label class="label">
                <span class="label-text">Detail tugas?</span>
            </label>
            <textarea name="detail" class="textarea textarea-bordered h-24" placeholder="Detail tugas"><?= $todo_item['detail'] ?></textarea>
        </div>

        <!-- Input selesai | checkbox selesai -->
        <div class="form-control max-w-xs mt-4">
            <label class="label cursor-pointer">
                <span class="label-text">Sudah selesai?</span> 
                <input type="checkbox" name="is_done" value="1" class="checkbox checkbox-primary" <?php if($todo_item['is_done']) {echo "checked";} ?>  />
            </label>
        </div>
        
        <!-- input id -->
        <input type="hidden" name="id" value="<?= $todo_item['id'] ?>">

        <!-- input foto path -->
        <input type="hidden" name="foto_path" value="<?= $todo_item['foto_path'] ?>">

        <input type="submit" value="Update Tugas" name="form_submit" class="btn btn-primary mt-4 w-full">
    </form>

    <?php

// Update todo di database
if (isset($_POST['form_submit'])){
    // Masukkan data ke model
    $todo->id = $_POST['id'];
    $todo->judul_tugas = $_POST['judul_tugas'];
    $todo->detail = $_POST['detail'];
    $todo->deadline = $_POST['deadline'];
    $todo->is_done = 0;
    $todo->foto_path = $_POST['foto_path'];

    if (array_key_exists('is_done', $_POST)){
        $todo->is_done = $_POST['is_done'];
    }

    if (!empty($_FILES['foto']['name'])){
        // Upload file untuk mendapatkan foto_path
        $foto = $_FILES['foto'];
        $upload_file = $file_upload->uploadFile($foto);
    
        // Tampilkan notifikasi upload file
        if ($upload_file['success'] != true){
            echo "
            <div class='alert alert-error shadow-lg mt-4'>
                <div>
                    <svg xmlns='http://www.w3.org/2000/svg' class='stroke-current flex-shrink-0 h-6 w-6' fill='none' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>
                    <span>Error! {$upload_file['messages']}</span>
                </div>
            </div>
            ";
            return false;
        }

        // Hapus file lama
        $previous_foto_path = $_SERVER['DOCUMENT_ROOT'] . $_POST['foto_path'];
        $delete_previous_foto = $file_upload->deleteFile($previous_foto_path);

        // Tampilkan notifikasi hapus file
        if ($delete_previous_foto['success'] != true){
            echo "
            <div class='alert alert-error shadow-lg mt-4'>
                <div>
                    <svg xmlns='http://www.w3.org/2000/svg' class='stroke-current flex-shrink-0 h-6 w-6' fill='none' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>
                    <span>Error! {$delete_previous_foto['messages']}</span>
                </div>
            </div>
            ";
            return false;
        }
    
        $todo->foto_path = $upload_file['file_path'];
    }

    // Update data di database
    $todo_update_result = $todo_controller->update($todo);

    // Tampilkan notifikasi update todo
    if ($todo_update_result['success'] != true){
        echo "
        <div class='alert alert-error shadow-lg mt-4'>
            <div>
                <svg xmlns='http://www.w3.org/2000/svg' class='stroke-current flex-shrink-0 h-6 w-6' fill='none' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>
                <span>Error! {$todo_update_result['messages']}</span>
            </div>
        </div>
        ";
        return false;
    }

    echo "
    <div class='alert alert-success shadow-lg mt-4'>
        <div>
            <svg xmlns='http://www.w3.org/2000/svg' class='stroke-current flex-shrink-0 h-6 w-6' fill='none' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>
            <span>{$todo_update_result['messages']}</span>
        </div>
    </div>
    ";

    echo '
    <script>
        window.location.href = "./index.php";
    </script>
    ';
}

?>
</div>

<!-- Template foot HTML -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/view/templates/foot.php";
?>