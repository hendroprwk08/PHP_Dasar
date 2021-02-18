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
include "upload.php";

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

if ($aksi == null):
    
    echo'<form enctype="multipart/form-data" method="POST" action="#">
        <label>Foto: </label>
        <input type="file" name="foto"/><br/>
        <label>Nama: </label>
        <input type="text" name="nama"/><br/>

        <label>Alamat: </label>
        <Textarea name="alamat"></Textarea><br/>

        <label>Kelamin: </label>
        <select name="kelamin">
            <option value="Pria">Pria</option>
            <option value="Wanita">Wanita</option>
        </select><br/>

        <label>Lulus: </label><br/>
        <input type="radio" name="lulusan" value="SMA"> SMA
        <input type="radio" name="lulusan" value="SMK"> SMK
        <input type="radio" name="lulusan" value="STM"> STM
        <input type="radio" name="lulusan" value="MA"> MA<br>

        <label>Jabatan: </label>
        <select name="jabatan">';

    $d = new Database();
    $data = $d->getList("select idjabatan, jabatan from jabatan");
    
    for ($i = 0; $i < count($data); $i++):
        echo'<option value="'. $data[$i][0] .'">'. $data[$i][1] .'</option>';
    endfor;

    echo'</select><br/>
        <input type="submit" name="aksi" value="SIMPAN">
        <input type="reset" name="reset" value="ULANGI">
        </form><br/>';
    
    #table
    echo'<table border="1">
        <tr><th width="150px">Nama</th>
        <th width="100px">Alamat</th>
        <th width="100px">Lulusan</th>
        <th width="100px">&nbsp;</th>
        </tr>';
    
    $d = new Database();
    $sql = "select pegawai.idpegawai, pegawai.nama, pegawai.alamat, pegawai.jkelamin, "
            ."pegawai.lulusan, pegawai.foto, jabatan.jabatan from pegawai inner join jabatan "
            ."on pegawai.idjabatan = jabatan.idjabatan";
    
    $data = $d->getList($sql);
    
    for ($i = 0; $i < count($data); $i++):
        
        $foto = ( $data[$i]['foto'] == "" ) ? '' : '<img src="images/'. $data[$i]['foto'].'" width="150px"/><br/>';
           
        echo '<tr>
            <td>'. $foto .'<b>'. $data[$i]['nama'] .'</b> - '. $data[$i]['jabatan'] .'<br/> 
                '. $data[$i]['jkelamin'] .'</td>
            <td>'. $data[$i]['alamat'] .'</td>
            <td>'. $data[$i]['lulusan'] .'</td>
            <td><a href="pegawai.php?aksi=UBAH&id='. $data[$i]['idpegawai'] .'">Ubah</a> | 
                <a href="pegawai.php?aksi=HAPUS&foto='. $data[$i]['foto'] .'&id='. $data[$i]['idpegawai'] .'">Hapus</a></td>
            </tr>';        
    endfor;
    
    echo '</table>';
    
elseif($aksi == "SIMPAN"): 
    
    $u = new Upload();
    $hasil = $u->uploadFile($_FILES["foto"]);
    
    $d = new Database();
    
    if ($hasil["status"] == "0"):
        die ($hasil["info"]. "<p><a href='#' onClick='window.history.back()'>Coba lagi</a></p>");
    elseif ($hasil["status"] == "2"):
        # tidak mengunggah gambar
        $sql = "insert into pegawai (nama, alamat, jkelamin, lulusan, idjabatan) " 
                ."values ('". $_REQUEST['nama'] ."', '". $_REQUEST['alamat'] ."', " 
                ."'". $_REQUEST['kelamin'] ."', '". $_REQUEST['lulusan'] ."', "
                ."". $_REQUEST['jabatan'] .")";
        $d->exec($sql); 

        header("location: pegawai.php"); //redirect
    else:
        $sql = "insert into pegawai (nama, alamat, jkelamin, lulusan, foto, idjabatan) " 
                ."values ('". $_REQUEST['nama'] ."', '". $_REQUEST['alamat'] ."', " 
                ."'". $_REQUEST['kelamin'] ."', '". $_REQUEST['lulusan'] ."', "
                ."'". $hasil['info'] ."', ". $_REQUEST['jabatan'] .")";
        $d->exec($sql); 

        header("location: pegawai.php"); //redirect
    endif;

elseif($aksi == "HAPUS"):
    
    $u = new Upload();
    $u->hapusFile($_REQUEST["foto"]);

    $d = new Database();
    $sql = "delete from pegawai where idpegawai = ". $_REQUEST['id'];
    $d->exec($sql); 

    header("location: pegawai.php"); //redirect

elseif($aksi == "HAPUSGAMBAR"):

    $u = new Upload();
    $u->hapusFile($_REQUEST["foto"]);

    $d = new Database();
    $sql = "update pegawai set foto = '' where idpegawai = ". $_REQUEST['id'];
    $d->exec($sql); 

    header("location: pegawai.php?aksi=UBAH&id=".$_REQUEST['id']); //redirect ke posisi edit

elseif($aksi == "UPDATE"):
    /* 
    1. kalo ada file yang akan diupload, maka hapus dahulu file yang lama dan update data foto
    2. jika tak ada yang diupload maka data foto jangan diupdate 
    */

    //adakah file yang diunggah?
    $u = new Upload();
    $ukuran = $u->cekUkuran($_FILES["foto"]); //cek ukuran file

    $d = new Database();

    //cek ukuran kalo diatas 0 berarti ada file
    if ($ukuran > 0){ 

        //kalo ada temporary foto, maka hapus dahulu
        if ($_REQUEST['tempFoto'] != "") $u->hapusFile($_REQUEST['tempFoto']);

        //upload foto baru
        $u = new Upload();
        $hasil = $u->uploadFile($_FILES["foto"]);

        if ($hasil["status"] == "0"){
            die ($hasil["info"]. "<p><a href='#' onClick='window.history.back()'>Coba lagi</a></p>");
        }else{
            //update data termasuk fotonya
            $sql = "update pegawai set nama = '". $_REQUEST['nama'] ."', " 
                    ."alamat = '". $_REQUEST['alamat'] ."', "
                    ."jkelamin = '". $_REQUEST['kelamin'] ."', "
                    ."lulusan = '". $_REQUEST['lulusan'] ."', "
                    ."foto = '". $hasil['info'] ."', "
                    ."idjabatan = ". $_REQUEST['jabatan'] ." "
                    ."where idpegawai = ". $_REQUEST['tempID'];
        }
    } else{
        //update data kecuali fotonya
        $sql = "update pegawai set nama = '". $_REQUEST['nama'] ."', " 
                ."alamat = '". $_REQUEST['alamat'] ."', "
                ."jkelamin = '". $_REQUEST['kelamin'] ."', "
                ."lulusan = '". $_REQUEST['lulusan'] ."', "
                ."idjabatan = ". $_REQUEST['jabatan'] ." "
                ."where idpegawai = ". $_REQUEST['tempID'];
    }
    
    $d->exec($sql); 

    header("location: pegawai.php"); //redirect
elseif($aksi == "UBAH"): 

    $d = new Database();
    $sql = "select * from pegawai where idpegawai = ". $_REQUEST['id'];

    $data = $d->getList($sql); 

    $foto = ( $data[0]['foto'] == "" ) ? "" : '<br/><img src="images/'. $data[0]['foto'] .'" width="200px"/><br/><a href="pegawai.php?aksi=HAPUSGAMBAR&foto='. $data[0]['foto'] .'&id='. $data[0]['idpegawai'] .'">Hapus</a><br/>'; 
  
    echo'<form enctype="multipart/form-data" method="POST" action="">
        <input type="hidden" name="tempID" value = "'. $data[0]['idpegawai'] .'"/>
        <input type="hidden" name="tempFoto" value = "'. $data[0]['foto'] .'"/>
        <label>Foto: </label>'. $foto.'
        <input type="file" name="foto"/><br/>
        <label>Nama: </label>
        <input type="text" name="nama" value = "'. $data[0]['nama'] .'"/><br/>
        <label>Alamat: </label>
        <Textarea name="alamat">'. $data[0]['alamat'] .'</Textarea><br/>
        <label>Kelamin:
        </label>
        <select name="kelamin">';
    
    #tampilkan jenis kelamin pada check box
    $jk = ['Pria', 'Wanita'];
    foreach($jk as $v):  
        if($v == $data[0]['jkelamin']):
            echo '<option value="'. $v .'" selected>'. $v .'</option>';
        else:
            echo '<option value="'. $v .'">'. $v .'</option>';
        endif;
    endforeach;
            
    echo '</select><br/>
        <label>Lulus: </label><br/>';
    
    #tampilkan lulusan pada radio button
    $jk = ['SMA', 'SMK', 'STM', 'MA'];
    foreach($jk as $v):  
        if($v == $data[0]['lulusan']):
            echo '<input type="radio" name="lulusan" value="'. $v .'" checked> '. $v;
        else:
            echo '<input type="radio" name="lulusan" value="'. $v .'"> '. $v;
        endif;
    endforeach;
    
    echo '<br/><label>Jabatan: </label><select name="jabatan">';
    
    $d = new Database();
    $row = $d->getList("select idjabatan, jabatan from jabatan");

    for ($i = 0; $i < count($row); $i++): 
        //variable penampung jika nilai jabatan sama dengan option, 
        //maka beri TANDA "SELECTED"
        $select = ($data[0]['idjabatan'] == $row[$i][0]) ? "selected" : null;
        echo '<option value="'. $row[$i][0] .'"  '. $select .'>'. $row[$i][1] .'</option>';
    endfor;

    echo '</select><br/>
        <input type="submit" name="aksi" value="UPDATE">
        <input type="button" name="reset" value="KEMBALI" onClick="window.history.back()">
        </form>';

endif;
?>
</body>
</html>