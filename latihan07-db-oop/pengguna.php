<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Pengguna</title>
</head>
<body>
<?php
include "db.php";
include "session.php";

$s = new Session();
//if (!$s->check("username")) header("location: login.php"); 

echo '<p><a href="pegawai.php">Pegawai</a> | 
        <a href="jabatan.php">Jabatan</a> | 
        <b>Pengguna</b> | 
        <a href="logout.php">Keluar</a></p>';

/*
variable "status" u/ deteksi aksi : simpan, update & hapus
if menggunakan gaya satu baris karena hanya memiliki satu keputusan
opsional sih...
*/
$aksi = (!isset($_REQUEST["aksi"])) ? null : $_REQUEST["aksi"];

if ($aksi == null):
    echo'<form action="" autocomplete="off">
            <label>Username</label> <input type="text" name="username" maxlength="20"/><br/>
            <label>Password</label> <input type="password" name="password"/><br/>
            <label>Email</label> <input type="text" name="email"/><br/>
            <input type="submit" name="aksi" value="SIMPAN"/>
            <input type="reset" name="reset" value="ULANGI"/>
        </form><br/>';

    #tabel	
    echo'<small>Password tak dimunculkan</small>
        <table border="1"><tr><th>Username</th><th>Email</th><th>&nbsp;</th></tr>';

    $d = new Database(); //mengaktifkan class DB
    $sql = "select * from pengguna";
    $data = $d->getList($sql); //ambil data dan tampung pada $data

    //loop untuk menampilkannya
    for($i = 0; $i < count($data); $i++):		
        echo'<tr>
                <td>'. $data[$i]["username"] .'</td>
                <td>'. $data[$i]["email"] .'</td>
                <td>	
                    <a href="pengguna.php?aksi=UBAH&id='. $data[$i]["username"] .'">Ubah</a> | 
                    <a href="pengguna.php?aksi=HAPUS&id='. $data[$i]["username"] .'">Hapus</a> 
                </td>
            </tr>';
    endfor;

    echo '</table>';
elseif($aksi == "SIMPAN"):
    $d = new Database(); //mengaktifkan class DB
    $sql = "insert into pengguna (username, password, email) values ( "
            ."'".$_REQUEST['username']."', '".md5($_REQUEST['password'])."', "
            ."'".$_REQUEST['email']."')";
    $d->exec($sql); //jalankan function query u/ eksekusi sql

    header("location: pengguna.php"); //redirect
elseif($aksi == "UPDATE"):
    $d = new Database(); //mengaktifkan class DB

    //die($_REQUEST['password']);

    $sql = null;
    if (strlen($_REQUEST['password']) > 0){
        $sql = "update pengguna set " 
            ."password = '".md5($_REQUEST['password'])."', " 
            ."email = '".$_REQUEST['email']."' " 
            ."where username = '". $_REQUEST['username'] ."'";
    }else{
        $sql = "update pengguna set " 
            ."email = '".$_REQUEST['email']."' " 
            ."where username = '". $_REQUEST['username'] ."'";
    }

    $d->exec($sql); 

    header("location: pengguna.php"); //redirect
elseif($aksi == "HAPUS"):
    $d = new Database(); 
    $sql = "delete from pengguna where username = '".$_REQUEST['id']."'";
    $d->exec($sql); //jalankan function query u/ eksekusi sql

    header("location: pengguna.php"); //redirect
elseif($aksi == "UBAH"):
    $d = new Database(); 
    $sql = "select * from pengguna where username = '". $_REQUEST['id'] ."'";
    $data = $d->getList($sql);

    echo '<form action="" >
            <label>Username</label>
            <input autocomplete="off" value="'. $data[0]["username"] .'" type="text" name="username" readonly/><br/>
            <label>Password</label>
            <input autocomplete="off" type="password" name="password"/><br/>
            <small>Password tak dimuculkan, silakan ketik password jika ingin mengbahnya</small><br/>
            <label>Email</label>
            <input value = "'. $data[0]["email"] .'" type="text" name="email"/><br/>
            <input type="submit" name="aksi" value="UPDATE"/>
            <input type="button" name="reset" value="KEMBALI" onclick="window.history.back()"/>
        </form>';
endif;
?>
</body>
</html>