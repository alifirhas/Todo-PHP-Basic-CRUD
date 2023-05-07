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

        <!-- Input selesai | checkbox selesai -->
        <div class="form-control max-w-xs mt-4">
            <label class="label cursor-pointer">
                <span class="label-text">Sudah selesai?</span> 
                <input type="checkbox"  class="checkbox checkbox-primary" />
            </label>
        </div>

        <input type="submit" value="Update Tugas" class="btn btn-primary mt-4 w-full">
    </form>
</div>

<!-- Template foot HTML -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . $base_url . "/view/templates/foot.php";
?>