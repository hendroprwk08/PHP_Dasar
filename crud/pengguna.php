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
$d = new Database(); //mengaktifkan class DB		

//if (!$s->check("username")) header("location: login.php"); 

echo '<p><a href="pegawai.php">Pegawai</a> | 
        <a href="jabatan.php">Jabatan</a>| 
        <b>Pengguna</b> | 
        <a href="logout.php">Keluar</a></p>';

/*
variable "status" u/ deteksi aksi : simpan, update & hapus
if menggunakan gaya satu baris karena hanya memiliki satu keputusan
opsional sih...
*/
$aksi = (! isset( $_REQUEST[ 'aksi' ] ) ) ? null : $_REQUEST[ 'aksi' ]; 

if ( $aksi == 'SIMPAN' ):
    $sql = "insert into pengguna (username, password, email) values ( "
            ."'".$_REQUEST['username']."', '". md5($_REQUEST['username'])."', "
            . "'". $_REQUEST['email']."')";
    $d->exec($sql); //jalankan function query u/ eksekusi sql

    header("location: pengguna.php"); //redirect
elseif( $aksi == 'CARI' ):
    $s->set('cariPengguna', $_REQUEST['cari']);
    header("location: pengguna.php"); //redirect
elseif( $aksi == 'PILIH' ):
    $sql = "select * from pengguna where username = '". $_REQUEST['usr']."'";
    $data = $d->getList($sql);

    #edit form
    echo '<form action ="#" method="post">
            <label>Username </label><input type="text" name="username" value="'. $data[ 0 ][ 'username' ] .'" readonly/><br/>
            <small>Anda tak dapat mengubah Username</small><br/>
            <label>passsword </label><input type="password" name="password"/><br/>
            <small>Tak perlu mengisi password jika tak ingin mengubahnya</small><br/>
            <label>Email </label><input type="text" name="email" value="'. $data[ 0 ][ 'email' ] .'" /><br/>
            <input type="submit" name="aksi" value="UPDATE" />
            <input type="button" name="reset" value="KEMBALI" onclick="window.history.back()"/>
        </form>';
elseif( $aksi == 'UPDATE' ):
    #jika password  diisi
    if(strlen($_REQUEST['password']) > 0 ): #jika ada password baru
        $sql = "update pengguna set " 
                ."username = '". $_REQUEST['username'] ."', "
                ."password = '". md5($_REQUEST['password']) ."', "
                ."email = '". $_REQUEST['email'] ."' " 
                ."where username = '". $_REQUEST['username'] ."'";
    else: #jika tak ada password baru
        $sql = "update pengguna set " 
                ."username = '". $_REQUEST['username'] ."', "
                ."email = '". $_REQUEST['email'] ."' " 
                ."where username = '". $_REQUEST['username'] ."'";
    endif;
    
    $d->exec($sql); 

    header("location: pengguna.php"); //redirect
elseif( $aksi == 'HAPUS' ):
    $sql = "delete from pengguna where username = '". $_REQUEST['usr'] ."'";
    $d->exec($sql); //jalankan function query u/ eksekusi sql

    header("location: pengguna.php"); //redirect
else: #tampilkan html
    echo '<form action="">
            <label>Username </label><input type="text" name="username"/><br/>
            <label>Password </label><input type="password" name="password"/><br/>
            <label>Email </label><input type="text" name="email"/><br/>
            <input type="submit" name="aksi" value="SIMPAN"/>
            <input type="reset" name="reset" value="ULANGI"/>
        </form><br/>';

    #pencarian
    echo '<form action="">
            <label>Pencarian </label><input type="text" size="7" name="cari" value="'. $s->read('cariPengguna') .'"/>
            <input type="submit" name="aksi" value="CARI"/>
        </form><br/>';

    #table
    echo '<table border="1">
        <tr><td>Username</td><td>Email</td><td>&nbsp;&nbsp;</td></tr>';

    #munculkan data tabel jabatan disini
    #jika session pencarian eksis, maka lalukan pencarian
    if($s->check('cariPengguna') ):
    $sql = 'select * from pengguna where '
            . 'username like "%'. $s->read('cariPengguna') .'%"';
    else:
    $sql = 'select * from pengguna';
    endif;

    $data = $d->getList($sql); //ambil data dan tampung pada $hasil

    for( $i = 0; $i < count( $data ) ; $i++ ):
    echo '<tr>
            <td>'. $data[ $i ]['username'] .'</td>
            <td>'. $data[ $i ]['email'] .'</td>
            <td><a href="pengguna.php?aksi=PILIH&usr='. $data[ $i ]['username'] .'">Ubah</a> | 
                    <a href="pengguna.php?aksi=HAPUS&usr='. $data[ $i ]['username'] .'">Hapus</a></td>
            </tr>';        
    endfor;
    echo '</table>';
endif;
?>	
</body>
</html>

