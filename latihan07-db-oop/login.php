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
	$action = (!isset($_REQUEST["action"])) ? null : $_REQUEST["action"];
	//die($action);
	if ($action == null){
	?>
	<h3>LOGIN</h3>
	<form action="" autocomplete="off">
		<label>Username</label> <input type="text" name="username" maxlength="20"/><br/>
		<label>Password</label> <input type="password" name="password"/><br/>
		<input type="submit" name="action" value="Login"/>
		<input type="reset" name="reset" value="Ulangi"/>
	</form>
	<?php
	}elseif($action == "Login"){
		$d = new Database(); //mengaktifkan class DB
		$sql = "select * from pengguna where " 
			."username ='". $_REQUEST['username']."' and "
			."password = '". md5($_REQUEST['password'])."'";

		$result = $d->getList($sql); //jalankan function query u/ eksekusi sql
		
		print_r(count($result));

		if(count($result) > 0){
			//daftarkan session
			$s = new Session();
			$s->set("username", $_REQUEST['username']);
			header("location: pegawai.php"); 
		}else{
			die ("Sepertinya pengguna tak terdaftar. <a href='#' onClick='window.history.back()'>Coba lagi</a>");
		}
	}
	?>
</body>
</html>