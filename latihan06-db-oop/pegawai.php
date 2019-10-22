<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Data Pegawai</title>
</head>
<body>
    <?php
    include "db.php"; 

    $action = null;

    if (!isset($_REQUEST['action'])){
        $action = null; 
    }else{
        $action = $_REQUEST['action'];  
    }

    if ($action == null){ 
    ?>
    
    <h3>Data Pegawai</h3>
    <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>">
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

    <input type="submit" name="action" value="SIMPAN">
    <input type="reset" name="reset" values="ULANGI">
    </form>
    <h3>List Pegawai</h3>
    <table border="1">
        <thead>
            <th width="150px">Nama</th>
            <th width="100px">Alamat</th>
            <th width="100px">Lulusan</th>
            <th width="100px">&nbsp;</th>
        </thead>
        <tbody>
        <?php 
        $d = new Database();
        $result = $d->getList("select * from pegawai order by nama asc");
        for ($i = 0; $i < count($result); $i++){
        ?>

            <tr>
                <td><b><?= $result[$i]['nama'] ?></b> - <?= $result[$i]['jkelamin'] ?></td>
                <td><?= $result[$i]['alamat'] ?></td>
                <td><?= $result[$i]['lulusan'] ?></td>
                <td>Ubah | Hapus</td>
            </tr>
        
        <?php } ?>
        </tbody>
    </table>

    <?php 
    }elseif($action == "SIMPAN"){ 
        $d = new Database();
        $sql = "insert into pegawai (nama, alamat, jkelamin, lulusan) " 
                ."values ('". $_REQUEST['nama'] ."', '". $_REQUEST['alamat'] ."', " 
                ."'". $_REQUEST['kelamin'] ."', '". $_REQUEST['lulusan'] ."')";
        $d->query($sql); 
        $d->close();

        header("location: pegawai.php"); //redirect
    }
    ?>
</body>
</html> 