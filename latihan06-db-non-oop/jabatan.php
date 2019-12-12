<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Data Jabatan</title>
</head>
<body>
	
	<?php
	//set up database
	include("koneksi.php");

	/*
	variable "status" u/ deteksi aksi : simpan, update & hapus
	if menggunakan gaya satu baris karena hanya memiliki satu keputusan
	opsional sih...
	*/
	$action = (!isset($_REQUEST["action"])) ? null : $_REQUEST["action"];
	
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
		$sql = "select * from jabatan";
		$data = $mysqli->query($sql);
		
		while($row = $data->fetch_array()){
		?>

		<tr>
			<td><?= $row["jabatan"] ?></td>
			<td><?= $row["honor"] ?></td>
			<td>
				<a href="jabatan.php?action=Ubah&id=<?= $row["idjabatan"] ?>">Ubah</a> | 
				<a href="jabatan.php?action=Hapus&id=<?= $row["idjabatan"] ?>">Hapus</a> 
			</td>
		</tr>
		
		<?php }	?>
		
		</tbody>

		<?php
		//putuskan koneksi dengan database
		$data->free();
		$mysqli->close();	
		?>
	</table>
	<?php
	}elseif($action == "Simpan"){
		$sql = "insert into jabatan (jabatan, honor) values ( "
				."'".$_REQUEST['jabatan']."', ".$_REQUEST['honor'].")";
		
		if( !$mysqli->query($sql) ) die("Error: ". $mysqli->error);

		$mysqli->close();
		
		header("location: jabatan.php"); //redirect
	}elseif($action == "Update"){
		$sql = "update jabatan set " 
				."jabatan = '".$_REQUEST['jabatan']."', "
				."honor = ".$_REQUEST['honor']." " 
				."where idjabatan = ". $_REQUEST['idjabatan'];
		
		if( !$mysqli->query($sql) ) die("Error: ". $mysqli->error);
		
		$mysqli->close();

		header("location: jabatan.php"); //redirect
	}elseif($action == "Hapus"){
		$sql = "delete from jabatan where idjabatan = ".$_REQUEST['id'];
		
		if( !$mysqli->query($sql) ) die("Error: ". $mysqli->error);
		
		$mysqli->close();

		header("location: jabatan.php"); //redirect
	}elseif($action == "Ubah"){
		$sql = "select * from jabatan where idjabatan = ".$_REQUEST['id'];
		$data = $mysqli->query($sql);
		
		while($row = $data->fetch_array()){		
	?>
		
		<h3>Edit Data Jabatan</h3>
		<form action="">
			<label>Jabatan</label>
			<input value = "<?= $row["jabatan"] ?>" type="text" name="jabatan"/><br/>
			<label>Honor</label>
			<input value = "<?= $row["honor"] ?>" type="text" name="honor"/><br/>
			<input value = "<?= $row["idjabatan"] ?>" type="hidden" name="idjabatan"/>
			<input type="submit" name="action" value="Update"/>
			<input type="button" name="reset" value="Kembali" onclick="window.history.back()"/>
		</form>

	<?php 
		}
		
		$data->free();
		$mysqli->close();
	}
	?>

</body>
</html>