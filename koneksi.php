<?php
// Konfigurasi koneksi database PostgreSQL
define('DB_SERVER_PG', 'localhost');
define('DB_USERNAME_PG', 'postgres');
define('DB_PASSWORD_PG', '4dmindeveloper');
define('DB_DATABASE_PG', 'testdb');

// Konfigurasi koneksi database MySQL
define('DB_SERVER_MYSQL', 'localhost');
define('DB_USERNAME_MYSQL', 'root');
define('DB_PASSWORD_MYSQL', '');
define('DB_DATABASE_MYSQL', 'testdb');

// Cobalah koneksi ke PostgreSQL terlebih dahulu
$connection_string_pg = "host=" . DB_SERVER_PG . " dbname=" . DB_DATABASE_PG . " user=" . DB_USERNAME_PG . " password=" . DB_PASSWORD_PG;
$db = @pg_connect($connection_string_pg);

if (!$db) {
    // Jika PostgreSQL gagal, coba koneksi ke MySQL
    $db = @mysqli_connect(DB_SERVER_MYSQL, DB_USERNAME_MYSQL, DB_PASSWORD_MYSQL, DB_DATABASE_MYSQL);
    if (!$db) {
        die("Koneksi ke PostgreSQL dan MySQL gagal: " . (pg_last_error() ?: mysqli_connect_error()));
    } else {
        // Gunakan MySQL
        $db_type = 'mysql';
    }
} else {
    // Gunakan PostgreSQL
    $db_type = 'pgsql';
}
?>
