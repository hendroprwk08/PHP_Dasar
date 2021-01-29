<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Pegawai</title>
</head>
<body>
<?php
include "db.php";
include "session.php";

$s = new Session();
$d = new Database(); //mengaktifkan class DB		

//if (!$s->check("username")) header("location: login.php"); 

echo '<p><b>Pegawai</b> | 
        <a href="jabatan.php">Jabatan</a> | 
        <a href="pengguna.php">Pengguna</a> | 
        <a href="logout.php">Keluar</a></p>';

/*
variable "status" u/ deteksi aksi : simpan, update & hapus
if menggunakan gaya satu baris karena hanya memiliki satu keputusan
opsional sih...
*/
$aksi = (! isset( $_REQUEST[ 'aksi' ] ) ) ? null : $_REQUEST[ 'aksi' ]; 

/*
1. simpan
2. hapus
3. hapus image
4. pilih data
5. update  
*/

if ( $aksi == 'SIMPAN' ):
endif;
?>
</body>
</html>