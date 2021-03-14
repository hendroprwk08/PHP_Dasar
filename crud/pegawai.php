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
$d = new Database(); 		
$u = new Upload(); 		

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

if ( $aksi == 'SIMPAN' ):
    # jika ada foto, maka diunggah + simpan data berikut nama file. 
    # jika tidak ada foto, simpan data tanpa ada nama file.
    
    #cek, apakah ada foto? (pemeriksaan berdasarkan ukuran file)
    $cek = $u->uploadFile($_FILES["foto"]);
    
    if($cek["status"] == "0" ): # ada file tapi tak terunggah
        die($cek["info"] ." <p>foto tak terunggah, <a href='#' onClick='window.history.back()'>Silakan coba lagi</a></p>" );
    elseif($cek["status"] == "2" ): # tidak ada file
        $sql = "insert into pegawai (nama, alamat, jkelamin, lulusan, idjabatan) values "
            . "( '".$_REQUEST['nama']."', '".$_REQUEST['alamat']."', '".$_REQUEST['kelamin']."', "
            . "'".$_REQUEST['lulusan']."', ".$_REQUEST['jabatan'].")";
        
        $d->exec($sql); //jalankan function query u/ eksekusi sql
        header("location: pegawai.php"); //redirect?
    else: # file tersedia
        $sql = "insert into pegawai (nama, alamat, jkelamin, lulusan, foto, idjabatan) values "
            . "( '". $_REQUEST['nama'] ."', '". $_REQUEST['alamat'] ."', '". $_REQUEST['kelamin'] ."', "
            . "'". $_REQUEST['lulusan'] ."', '". $cek["info"] ."', ". $_REQUEST['jabatan'] .")";
        
        $d->exec($sql); //jalankan function query u/ eksekusi sql
        header("location: pegawai.php"); //redirect?
    endif;

elseif( $aksi == 'CARI' ):

elseif( $aksi == 'PILIH' ):

elseif( $aksi == 'UPDATE' ):

elseif( $aksi == 'HAPUS' ):

else: #tampilkan html
    echo '<form action="" enctype="multipart/form-data" method="POST">
            <label>Foto </label><input type="file" name="foto"/><br/>
            <label>Nama </label><input type="text" name="nama"/><br/>
            <label>Alamat </label><textarea name="alamat"/></textarea><br/>
            
            <label>Kelamin </label>
            <select name="kelamin">
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
            </select><br/>
            
            <label>Lulusan </label>
            <input type="radio" name="lulusan" value="SMA"/> SMA
            <input type="radio" name="lulusan" value="SMK"/> SMK
            <input type="radio" name="lulusan" value="MA"/> MA <br/>
            
            <label>Jabatan </label>
            <select name="jabatan">';
     
    #ambil data jabatan dari table jabatan dan masukkan kedalam "select"
    $data = $d->getList("select idjabatan, jabatan from jabatan");
    
    #tampilkan kedalam option
    for($i = 0; $i < count($data); $i++):
        echo '<option value="'. $data[$i][0] .'">'. $data[$i][1] .'</option>';
    endfor;
    
    echo '</select><br/><input type="submit" name="aksi" value="SIMPAN"/>
          <input type="reset" name="reset" value="ULANGI"/>
        </form><br/>';

    #pencarian
    echo '<form action="">
            <label>Pencarian </label><input type="text" size="7" name="cari" value="'. $s->read('cariJabatan') .'"/>
            <input type="submit" name="aksi" value="CARI"/>
        </form><br/>';

    #table
    echo '<table border="1">
        <tr><td>No</td><td>Bio</td><td>Lulusan</td><td>Jabatan</td><td>&nbsp;&nbsp;</td></tr>';

    #munculkan data tabel jabatan disini
    #jika session pencarian eksis, maka lalukan pencarian
    if($s->check('cariPegawai') ):
        $sql = 'select * from v_pegawai where '
                . 'nama like "%'. $s->read('cariPegawai') .'%"';
    else:
        $sql = 'select * from v_pegawai';
    endif;
    
    $data = $d->getList($sql); //ambil data dan tampung pada $hasil

    for( $i = 0; $i < count( $data ) ; $i++ ):
    
        $foto = ( $data[$i]["foto"] == "" ) ? "" : '<img src="images/'. $data[$i]["foto"] .'" width="100px"/><br/>';
    
        echo '<tr>
            <td>'. ($i + 1) .'</td>
            <td>'. $foto . $data[ $i ]['nama'] .' - '. $data[ $i ]['jkelamin'] .'</td>
            <td>'. $data[ $i ]['lulusan'] .'</td>
            <td>'. $data[ $i ]['jabatan'] .'</td>
            <td><a href="pegawai.php?aksi=PILIH&id='. $data[ $i ]['idpegawai'] .'">Ubah</a> | 
                    <a href="pegawai.php?aksi=HAPUS&id='. $data[ $i ]['idpegawai'] .'">Hapus</a></td>
            </tr>';        
    endfor;
    echo '</table>';
endif;
?>	
</body>
</html>