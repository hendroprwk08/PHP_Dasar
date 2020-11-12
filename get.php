<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTOH GET</title>
</head>
<body>
    <?php
    #mengambil nilai dari URL
    $nama = $_GET['nama'];
    $status = $_GET['status'];

    echo "<p>Nama: $nama</p>
    <p>Status: $status</p>";
    ?>
</body>
</html>