<?php

// Tampilkan error manual
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Require config
require_once __DIR__ . "/../../config.php";

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
            <textarea name="detail_tugas" class="textarea textarea-bordered h-24" placeholder="Detail tugas"> </textarea>
        </div>

        <input type="submit" value="Tambah Tugas" class="btn btn-primary mt-4 w-full">
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
            <!-- row 1 -->
            <tr>
                <th>1</th>
                <td>
                    <input type="checkbox" name="" id="" class="checkbox checkbox-success" disabled>
                </td>
                <td>Cy Ganderton</td>
                <td>Quality Control Specialist</td>
                <td>Blue</td>
                <td>
                    <div class="flex gap-4">
                        <a href="./edit_todo.php" class="btn btn-info">Edit</a>
                        <a href="#" class="btn btn-warning" onclick="return confirm('ingin menghapus tugas ini?');">Hapus</a>
                    </div>
                </td>
            </tr>
            <!-- row 2 -->
            <tr class="active">
                <th>2</th>
                <td>
                    <input type="checkbox" name="" id="" class="checkbox checkbox-success" disabled>
                </td>
                <td>Hart Hagerty</td>
                <td>Desktop Support Technician</td>
                <td>Purple</td>
                <td>
                    <div class="flex gap-4">
                        <a href="./edit_todo.php" class="btn btn-info">Edit</a>
                        <a href="#" class="btn btn-warning" onclick="return confirm('ingin menghapus tugas ini?');">Hapus</a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Template foot HTML -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/view/templates/foot.php";
?>