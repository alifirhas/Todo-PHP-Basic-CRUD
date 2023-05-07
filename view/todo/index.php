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
                <input type="text" name="judul_tugas" placeholder="Isi judul tugas" class="input input-bordered w-full" required />
            </div>

            <!-- Input deadline -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Dadline?</span>
                </label>
                <input type="date" name="deadline" class="input input-bordered w-full" required />
            </div>

            <!-- Input gambar -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Dadline?</span>
                </label>
                <input type="file" name="foto" class="file-input file-input-bordered file-input-primary w-full" required />
            </div>

        </div>

        <!-- Input detail tugas -->
        <div class="form-control">
            <label class="label">
                <span class="label-text">Detail tugas?</span>
            </label>
            <textarea name="detail" class="textarea textarea-bordered h-24" placeholder="Detail tugas"> </textarea>
        </div>

        <input type="submit" name="form_submit" value="Tambah Tugas" class="btn btn-primary mt-4 w-full">

<?php

// Tambah todo ke database
if (isset($_POST['form_submit'])){
    // Masukkan data ke model
    $todo->judul_tugas = $_POST['judul_tugas'];
    $todo->detail = $_POST['detail'];
    $todo->deadline = $_POST['deadline'];
    $todo->is_done = 0;

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

    $todo->foto_path = $upload_file['file_path'];

    // Masukkan data ke database
    $todo_create_result = $todo_controller->create($todo);

    // Tampilkan notifikasi tambah todo
    if ($todo_create_result['success'] != true){
        echo "
        <div class='alert alert-error shadow-lg mt-4'>
            <div>
                <svg xmlns='http://www.w3.org/2000/svg' class='stroke-current flex-shrink-0 h-6 w-6' fill='none' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>
                <span>Error! {$todo_create_result['messages']}</span>
            </div>
        </div>
        ";
        return false;
    }

    echo "
    <div class='alert alert-success shadow-lg mt-4'>
        <div>
            <svg xmlns='http://www.w3.org/2000/svg' class='stroke-current flex-shrink-0 h-6 w-6' fill='none' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>
            <span>{$todo_create_result['messages']}</span>
        </div>
    </div>
    ";
}

?>
    </form>
</div>

<div class="container mx-auto mt-4 p-4 bg-base-100 w-[70%]">
    <div class="overflow-x-auto">
        <table class="table w-full">
            <!-- head -->
            <thead>
            <tr>
                <th></th>
                <th>Selesai?</th>
                <th>Judul</th>
                <th>Detail</th>
                <th>Deadline</th>
                <th>Menu</th>
            </tr>
            </thead>
            <tbody>
<?php
$todo_get_result = $todo_controller->read();

while ($todo_item = mysqli_fetch_array($todo_get_result['data'])){
?>
    <tr>
        <th><?= $todo_item['id'] ?></th>
        <td>
            <input type="checkbox" <?php if($todo_item['is_done']) {echo "checked";} ?> name="" id="" class="checkbox checkbox-success" disabled>
        </td>
        <td><?= $todo_item['judul_tugas'] ?></td>
        <td><?= $todo_item['detail'] ?></td>
        <td><?= $todo_item['deadline'] ?></td>
        <td>
            <div class="flex gap-4">
                <a href="./edit_todo.php" class="btn btn-info">Edit</a>
                <a href="#" class="btn btn-warning" onclick="return confirm('ingin menghapus tugas ini?');">Hapus</a>
            </div>
        </td>
    </tr>
<?php
}
?>
            </tbody>
        </table>
    </div>
</div>

<!-- Template foot HTML -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/view/templates/foot.php";
?>