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

	<p><a href="pegawai.php">Pegawai</a> | <a href="jabatan.php">Jabatan</a> | <b>Pengguna</b> | <a href="logout.php">Keluar</a></p>

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
	<form action="" autocomplete="off">
		<label>Username</label> <input type="text" name="username" maxlength="20"/><br/>
		<label>Password</label> <input type="password" name="password"/><br/>
		<label>Email</label> <input type="text" name="email"/><br/>
		<input type="submit" name="action" value="Simpan"/>
		<input type="reset" name="reset" value="Ulangi"/>
	</form><br/>	
	<small>Password tak dimunculkan</small>
	<table border="1">
		<thead><th>Username</th><th>Email</th><th>&nbsp;</th></thead>
		<tbody>
		<?php
		$d = new Database(); //mengaktifkan class DB
		$sql = "select * from pengguna";
		$hasil = $d->getList($sql); //ambil data dan tampung pada $hasil
		
		//loop untuk menampilkannya
		for($i = 0; $i < count($hasil); $i++){
		?>
		<tr>
			<td><?= $hasil[$i]["username"] ?></td>
			<td><?= $hasil[$i]["email"] ?></td>
			<td>
				<a href="pengguna.php?action=Ubah&id=<?= $hasil[$i]["username"] ?>">Ubah</a> | 
				<a href="pengguna.php?action=Hapus&id=<?= $hasil[$i]["username"] ?>">Hapus</a> 
			</td>
		</tr>
		<?php }	?>
		</tbody>
	</table>
	<?php
	}elseif($action == "Simpan"){
		$d = new Database(); //mengaktifkan class DB
		$sql = "insert into pengguna (username, password, email) values ( "
				."'".$_REQUEST['username']."', '".md5($_REQUEST['password'])."', "
				."'".$_REQUEST['email']."')";
		$d->query($sql); //jalankan function query u/ eksekusi sql
		
		header("location: pengguna.php"); //redirect
	}elseif($action == "Update"){
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

		$d->query($sql); 
		
		header("location: pengguna.php"); //redirect
	}elseif($action == "Hapus"){
		$d = new Database(); 
		$sql = "delete from pengguna where username = '".$_REQUEST['id']."'";
		$d->query($sql); //jalankan function query u/ eksekusi sql
		
		header("location: pengguna.php"); //redirect
	}elseif($action == "Ubah"){
		$d = new Database(); 
		$sql = "select * from pengguna where username = '". $_REQUEST['id'] ."'";
		$result = $d->getList($sql); ?>
		
		<!-- silakan copy form dari atas!!! -->
		<h3>Edit Data Jabatan</h3>
		<form action="" autocomplete="off">
			<label>Username</label>
			<input value = "<?= $result[0]["username"] ?>" type="text" name="username" readonly/><br/>
			<label>Password</label>
			<input type="password" name="password"/><br/>
			<small>Password tak dimuculkan, silakan ketik password jika ingin mengbahnya</small><br/>
			<label>Honor</label>
			<input value = "<?= $result[0]["email"] ?>" type="text" name="email"/><br/>
			<input type="submit" name="action" value="Update"/>
			<input type="button" name="reset" value="Kembali" onclick="window.history.back()"/>
		</form>
	<?php } ?>
</body>
</html>