# Instalasi

## Pre Requisite

-   PHP ^7.2 & < 8.0
-   composer

## Step

Mohon ikuti step by step secara berurutan.

-   clone repository di local anda <code>git clone https://gitlab.com/melkhior/tokomas</code>.
-   <code>cd tokomas</code>.
-   <code>code .</code> (untuk membuka folder di vs code atau buka secara manual).
-   Ekstrak Storage.zip dengan cara buka terminal dalam vs code dengan tools powershell.
-   Lalu ketik perintah <code>Expand-Archive -Force storage.zip storage\ </code>. (Alternatif : ekstrak dengan menggunakan winrar)
-   buka terminal dalam vs code dengan tools gitbash or cmd.
-   <code>cp .env.example .env</code>
-   <code>composer install</code>
-   <code>php artisan key:generate</code>
-   buat database dengan nama <strong>tokomas</strong>
-   buka file env dan sesuaikan koneksi database local anda
-   import database dari sumber database/tokomas.sql.
-   <code>php artisan migrate --seed</code>
-   buka aplikasi di browser dengan alamat (http://localhost/tokomas).

### Credential

Super Admin
username: test
password: password

Management
username : management
password : password
