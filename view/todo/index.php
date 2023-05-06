<?php

// Tampilkan error manual
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Require config
require_once __DIR__."/../../config.php";

?>

<!-- Template head HTML -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'].$base_url."/view/templates/head.php";
?>

<!-- Component navbar -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'].$base_url."/view/components/navbar.php";
?>

<!-- Content -->
<div class="container mx-auto mt-4 p-4 bg-base-100">
    content
</div>

<!-- Template foot HTML -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'].$base_url."/view/templates/foot.php";
?>