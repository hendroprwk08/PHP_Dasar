<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
<?php
include("db.php");
include("session.php");

/*
variable "status" u/ deteksi aksi : simpan, update & hapus
if menggunakan gaya satu baris karena hanya memiliki satu keputusan
opsional sih...
*/
$aksi = (!isset($_REQUEST["aksi"])) ? null : $_REQUEST["aksi"];
//die($action);
if ($aksi == null):
    
    echo'<form action="" >
            <label>Username</label> <input type="text" autocomplete="off" name="username" maxlength="20"/><br/>
            <label>Password</label> <input type="password" autocomplete="off" name="password"/><br/>
            <input type="submit" name="aksi" value="LOGIN"/>
            <input type="reset" name="reset" value="ULANGI"/>
        </form>';
    
elseif($aksi == "LOGIN"):

    $d = new Database(); //mengaktifkan class DB
    $sql = "select * from pengguna where " 
            ."username ='". $_REQUEST['username']."' and "
            ."password = '". md5($_REQUEST['password'])."'";

    $data = $d->getList($sql); //jalankan function query u/ eksekusi sql

    if(count($data) > 0):
        //daftarkan session
        $s = new Session();
        $s->set("username", $_REQUEST['username']);
        header("location: pegawai.php"); 
    else:
        die ("Sepertinya pengguna tak terdaftar. <a href='#' onClick='window.history.back()'>Coba lagi</a>");
    endif;
    
endif;
?>
</body>
</html>