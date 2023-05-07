<?php

class FileUpload
{
    public $base_url = "/belajar/todo_image";

    public function generateRandomString()
    {
        $string = uniqid();
        return $string;
    }

    public function uploadFile($file)
    {
        $result = [
            "success" => true,
            "messages" => "Berhasil upload file",
            "file_path" => "",
        ];

        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_type = $file['type'];
        $file_error = $file['error'];
        $file_size = $file['size'];

        // buat file baru
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_new_name = $this->generateRandomString() . "." . $file_ext;

        // Cek error
        if ($file_error > 0) {
            $result['success'] = false;
            $result['messages'] = "Terdapat error pada file";

            return $result;
        }

        // Cek file type
        if ($file_type != "image/jpeg" && $file_type != "image/png") {
            $result['success'] = false;
            $result['messages'] = "Pastikan ekstensi file JPG, JPEG, atau PNG";

            return $result;
        }

        // Cek file size kurang dari 5mb
        if ($file_size >= 5000000) {
            $result['success'] = false;
            $result['messages'] = "File tidak boleh dari 5MB";

            return $result;
        }

        // Upload file
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . $this->base_url . "/assets/images/uploads/";
        $upload_file_path = $upload_dir . $file_new_name;
        $file_path = $this->base_url . "/assets/images/uploads/" . $file_new_name;

        $upload_file = move_uploaded_file($file_tmp_name, $upload_file_path);
        if (!$upload_file) {
            $result['success'] = false;
            $result['messages'] = "Gagal upload file";

            return $result;
        }

        $result['file_path'] = $file_path;

        return $result;

    }

    public function deleteFile($file_path)
    {
        $result = [
            "success" => true,
            "messages" => "Berhasil hapus file",
        ];

        if (!file_exists($file_path)) {
            $result['success'] = false;
            $result['messages'] = "File tidak ditemukan";
            return $result;
        }

        if (!unlink($file_path)) {
            $result['success'] = false;
            $result['messages'] = "File tidak dapat dihapus";
            return $result;
        }

        return $result;
    }
}
