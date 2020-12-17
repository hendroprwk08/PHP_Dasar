<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Data Jabatan</title>
</head>
<body>
	<?php
	include "db.php";
	include "session.php";

	$s = new Session();
	$d = new Database(); //mengaktifkan class DB		
	
	//if (!$s->check("username")) 
	//	header("location: login.php"); 
        ?>

	<p><a href="pegawai.php">Pegawai</a> | <b>Jabatan</b> | <a href="pengguna.php">Pengguna</a> | <a href="logout.php">Keluar</a></p>

	<?php
	/*
	variable "status" u/ deteksi aksi : simpan, update & hapus
	if menggunakan gaya satu baris karena hanya memiliki satu keputusan
	opsional sih...
	*/
	$aksi = (! isset( $_REQUEST[ 'aksi' ] ) ) ? null : $_REQUEST[ 'aksi' ]; 

	if ( $aksi == 'simpan' ):
            $sql = "insert into jabatan (jabatan, honor) values ( "
                    ."'".$_REQUEST['jabatan']."', ".$_REQUEST['honor'].")";
            $d->exec($sql); //jalankan function query u/ eksekusi sql

            header("location: jabatan.php"); //redirect
	elseif( $aksi == 'pilih' ):
            $sql = "select * from jabatan where idjabatan = ".$_REQUEST['id'];
            $data = $d->getList($sql);

            #edit form
            echo '<form action ="#" method="post">
                    <input type="hidden" name="id" value="'. $data[ 0 ][ 'idjabatan' ] .'" />
                    <label>Jabatan</label><input type="text" name="jabatan" value="'. $data[ 0 ][ 'jabatan' ] .'" /><br/>
                    <label>Honor</label><input type="text" name="honor" value="'. $data[ 0 ][ 'honor' ] .'" /><br/>
                    <input type="submit" name="aksi" value="update" />
                    <a href="jabatan.php">Batal</a>
            </form>';
	elseif( $aksi == 'update' ):
            $sql = "update jabatan set " 
                            ."jabatan = '".$_REQUEST['jabatan']."', "
                            ."honor = ".$_REQUEST['honor']." " 
                            ."where idjabatan = ". $_REQUEST['id'];
            $d->exec($sql); 

            header("location: jabatan.php"); //redirect
	elseif( $aksi == 'hapus' ):
            $sql = "delete from jabatan where idjabatan = ".$_REQUEST['id'];
            $d->exec($sql); //jalankan function query u/ eksekusi sql

            header("location: jabatan.php"); //redirect
	else: #tampilkan html
            echo '<form action="">
                    <label>Jabatan</label><input type="text" name="jabatan"/><br/>
                    <label>Honor</label><input type="text" name="honor"/><br/>
                    <input type="submit" name="aksi" value="simpan"/>
                    <input type="reset" name="reset" value="Ulangi"/>
            </form>';

            #table
            echo '<table border="1">
                <tr><td>ID</td><td>Jabatan</td><td>Honor</td><td>&nbsp;&nbsp;</td></tr>';
		
            #munculkan data tabel jabatan disini
            $sql = "select * from jabatan";
            $data = $d->getList($sql); //ambil data dan tampung pada $hasil

            for( $i = 0; $i < count( $data ) ; $i++ ):
                echo '<tr>
                        <td>'. $data[ $i ]['idjabatan'] .'</td>
                        <td>'. $data[ $i ]['jabatan'] .'</td>
                        <td>'. $data[ $i ]['honor'] .'</td>
                        <td><a href="jabatan.php?aksi=pilih&id='. $data[ $i ]['idjabatan'] .'">Ubah</a> | 
                                <a href="jabatan.php?aksi=hapus&id='. $data[ $i ]['idjabatan'] .'">Hapus</a></td>
                    </tr>';        
            endfor;
            echo '</table>';
	endif;
	?>	
</body>
</html>