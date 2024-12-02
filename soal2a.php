<?php
require "koneksi.php";

// Tangkap input pencarian
$filter_hobi = isset($_GET['filter_hobi']) ? pg_escape_string($db, $_GET['filter_hobi']) : '';
$where_clause = '';

// Tambahkan klausa WHERE jika ada input pencarian
if (!empty($filter_hobi)) {
    $where_clause = "WHERE h.hobi ILIKE '%$filter_hobi%'"; // ILIKE untuk case-insensitive
}

// Query data
$query = "SELECT 
            h.hobi AS hobi,
            COUNT(DISTINCT h.person_id) AS jumlah_orang
        FROM 
            hobi h
        $where_clause
        GROUP BY 
            h.hobi
        ORDER BY 
            jumlah_orang DESC";

if ($db_type === 'pgsql') {
    // Query untuk PostgreSQL
    $result = pg_query($db, $query);
    if (!$result) {
        die("Query gagal (PostgreSQL): " . pg_last_error($db));
    }

    $dataArray = [];
    while ($data = pg_fetch_assoc($result)) {
        $dataArray[] = $data;
    }
} elseif ($db_type === 'mysql') {
    // Query untuk MySQL
    $result = mysqli_query($db, $query);
    if (!$result) {
        die("Query gagal (MySQL): " . mysqli_error($db));
    }

    $dataArray = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $dataArray[] = $data;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Soal 2</title>
</head>
<body>
    <section class="p-5">
        <h2>Data Hobi</h2>
        <div class="row mt-2">
            <!-- Form Pencarian -->
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-3">
                        <input 
                            type="text" 
                            name="filter_hobi" 
                            class="form-control" 
                            value="<?= isset($_GET['filter_hobi']) ? htmlspecialchars($_GET['filter_hobi']) : '' ?>" 
                            placeholder="Cari Hobi"
                        />
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Hobi</th>
                            <th>Jumlah Orang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($dataArray) > 0) {
                            foreach ($dataArray as $data) {
                        ?>
                        <tr>
                            <td><?= !empty($data['hobi']) ? htmlspecialchars($data['hobi']) : '-' ?></td>
                            <td><?= !empty($data['jumlah_orang']) ? htmlspecialchars($data['jumlah_orang']) : '0' ?></td>
                        </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="2" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
