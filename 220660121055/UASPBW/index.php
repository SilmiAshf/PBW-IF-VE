<?php
include 'config.php';

$sukses = "";
$error  = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM mahasiswa WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}

$sql2 = "SELECT * FROM mahasiswa ORDER BY id DESC";
$q2 = mysqli_query($koneksi, $sql2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa UNSAP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="script.js" defer></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Data Mahasiswa UNSAP</h2>
        <a href="form.php" class="btn btn-primary mb-3">Tambah Data</a>

        <?php if ($error) { ?>
            <div class="alert alert-danger"><?php echo $error ?></div>
        <?php } ?>
        <?php if ($sukses) { ?>
            <div class="alert alert-success"><?php echo $sukses ?></div>
        <?php } ?>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Fakultas</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                    $id = $r2['id'];
                    $nim = $r2['nim'];
                    $nama = $r2['nama'];
                    $fakultas = $r2['fakultas'];
                    $prodi = $r2['prodi'];
                ?>
                    <tr>
                        <td><?php echo $urut++ ?></td>
                        <td><?php echo $nim ?></td>
                        <td><?php echo $nama ?></td>
                        <td><?php echo $fakultas ?></td>
                        <td><?php echo $prodi ?></td>
                        <td>
                            <a href="form.php?op=edit&id=<?php echo $id ?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?op=delete&id=<?php echo $id ?>" class="btn btn-danger" onclick="return confirm('Yakin mau delete data?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>