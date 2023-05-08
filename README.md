# TODO list Image

Aplikasi todo list dengan upload image.

***

Aplikasi ini adalah contoh CRUD dan file upload yang dibuat dengan basic PHP. Tampilan menggunakan tailwind dan daisyUI untuk mempercantik  proses belajar.

## Sebelum digunakan

1. Git clone repository dan simpan di dalam folder htdocs
2. Install dependencies node package

```bash
# Bisa dengan install
npm install

# Atau dengan update
npm update
```

3. Ubah base_url di config, sesuai dengan lokasi folder di htdocs

```php
$base_url = '/belajar/todo_image";
```

4. Import database yang ada di folder db/test.db, taruh di nama database mana saja, karena yang penting hanya tablenya
   - Jangan lupa sesuaikan nama database di app/utils/Connection.php

5. Buat folder assets/images/uploads dengan permission reand, write, delete untuk semuanya, kalau di linux pakai ```chmod 777 assets/images/uploads``` untuk memberi permission.

6. Buka project di browser dengan alamat ```localhost/{$base_url}```