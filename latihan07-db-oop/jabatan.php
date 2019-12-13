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
    if (!$s->check("username")) header("location: login.php"); 
    ?>

	<p><a href="pegawai.php">Pegawai</a> | <b>Jabatan</b> | <a href="pengguna.php">Pengguna</a> | <a href="logout.php">Keluar</a></p>

	<?php
	/*
	variable "status" u/ deteksi aksi : simpan, update & hapus
	if menggunakan gaya satu baris karena hanya memiliki satu keputusan
	opsional sih...
	*/
	$action = (!isset($_REQUEST["action"])) ? null : $_REQUEST["action"];
	//die($action);
	if ($action == null){
	?>
	<h3>Data Jabatan</h3>
	<form action="">
		<label>Jabatan</label><input type="text" name="jabatan"/><br/>
		<label>Honor</label><input type="text" name="honor"/><br/>
		<input type="submit" name="action" value="Simpan"/>
		<input type="reset" name="reset" value="Ulangi"/>
	</form><br/>	
	<table border="1">
		<thead><th>Jabatan</th><th>Honor</th><th>&nbsp;</th></thead>
		<tbody>
		<?php
		$d = new Database(); //mengaktifkan class DB
		$sql = "select * from jabatan";
		$hasil = $d->getList($sql); //ambil data dan tampung pada $hasil
		
		//loop untuk menampilkannya
		for($i = 0; $i < count($hasil); $i++){
		?>
		<tr>
			<td><?= $hasil[$i]["jabatan"] ?></td>
			<td><?= $hasil[$i]["honor"] ?></td>
			<td>
				<a href="jabatan.php?action=Ubah&id=<?= $hasil[$i]["idjabatan"] ?>">Ubah</a> | 
				<a href="jabatan.php?action=Hapus&id=<?= $hasil[$i]["idjabatan"] ?>">Hapus</a> 
			</td>
		</tr>
		<?php }	?>
		</tbody>
	</table>
	<?php
	}elseif($action == "Simpan"){
		$d = new Database(); //mengaktifkan class DB
		$sql = "insert into jabatan (jabatan, honor) values ( "
				."'".$_REQUEST['jabatan']."', ".$_REQUEST['honor'].")";
		$d->query($sql); //jalankan function query u/ eksekusi sql
		
		header("location: jabatan.php"); //redirect
	}elseif($action == "Update"){
		$d = new Database(); //mengaktifkan class DB
		$sql = "update jabatan set " 
				."jabatan = '".$_REQUEST['jabatan']."', "
				."honor = ".$_REQUEST['honor']." " 
				."where idjabatan = ". $_REQUEST['idjabatan'];
		$d->query($sql); 
		
		header("location: jabatan.php"); //redirect
	}elseif($action == "Hapus"){
		$d = new Database(); 
		$sql = "delete from jabatan where idjabatan = ".$_REQUEST['id'];
		$d->query($sql); //jalankan function query u/ eksekusi sql
		
		header("location: jabatan.php"); //redirect
	}elseif($action == "Ubah"){
		$d = new Database(); 
		$sql = "select * from jabatan where idjabatan = ".$_REQUEST['id'];
		$result = $d->getList($sql); ?>
		
		<!-- silakan copy form dari atas!!! -->
		<h3>Edit Data Jabatan</h3>
		<form action="">
			<label>Jabatan</label>
			<input value = "<?= $result[0]["jabatan"] ?>" type="text" name="jabatan"/><br/>
			<label>Honor</label>
			<input value = "<?= $result[0]["honor"] ?>" type="text" name="honor"/><br/>
			<input value = "<?= $result[0]["idjabatan"] ?>" type="hidden" name="idjabatan"/>
			<input type="submit" name="action" value="Update"/>
			<input type="button" name="reset" value="Kembali" onclick="window.history.back()"/>
		</form>
	<?php } ?>
</body>
</html>