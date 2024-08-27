# Instalasi

## Pre Requisite

-   PHP ^7.2 & < 8.0
-   composer

## Step

Mohon ikuti step by step secara berurutan.

-   clone repository di local anda <code>git clone https://gitlab.com/melkhior/tokomas</code>.
-   <code>cd tokomas</code>.
-   <code>code .</code> (untuk membuka folder di vs code atau buka secara manual).
-   buka terminal dalam vs code dengan tools powershell.
-   ketik perintah <code>Expand-Archive -Force storage.zip storage\ </code>.
-   <code>cp .env.example .env</code>
-   <code>composer install</code>
-   <code>php artisan key:generate</code>
-   buat database dengan nama <strong>tokomas</strong>
-   buka file env dan sesuaikan koneksi database local anda
-   import database dari sumber database/tokomas.sql.
-   <code>php artisan migrate</code>
-   buka aplikasi di browser dengan alamat (http://localhost/tokomas).
-   login dengan username: test dan password: password
