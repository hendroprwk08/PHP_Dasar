<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Data Pegawai</title>
</head>
<body>
    <?php
    include "db.php"; 
    include "upload.php"; 

    $action = null;

    if (!isset($_REQUEST['action'])){
        $action = null; 
    }else{
        $action = $_REQUEST['action'];  
    }
    
    if ($action == null){ 
    ?>
    
    <h3>Data Pegawai</h3>
    <form enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
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
            <td>
                <?php if (!$result[$i]['foto'] == "") print "<img src='images/".$result[$i]['foto']. "' width='150px'/><br/>"; ?>
                <b><?= $result[$i]['nama'] ?></b> - <?= $result[$i]['jkelamin'] ?>
            </td>
            <td><?= $result[$i]['alamat'] ?></td>
            <td><?= $result[$i]['lulusan'] ?></td>
            <td><a href="pegawai.php?action=UBAH&id=<?= $result[$i]['id_pegawai'] ?>">Ubah</a> | 
                <a href="pegawai.php?action=HAPUS&foto=<?= $result[$i]['foto'] ?>&id=<?= $result[$i]['id_pegawai'] ?>">Hapus</a></td>
        </tr>        
        <?php } ?>
        </tbody>
    </table>

    <?php 
    }elseif($action == "SIMPAN"){ 
        $u = new Upload();
        $hasil = $u->uploadFile($_FILES["foto"]);
        
        if ($hasil["status"] == "0"){
            die ($hasil["info"]. "<p><a href='#' onClick='window.history.back()'>Coba lagi</a></p>");
        }else{
            $d = new Database();
            $sql = "insert into pegawai (nama, alamat, jkelamin, lulusan, foto) " 
                    ."values ('". $_REQUEST['nama'] ."', '". $_REQUEST['alamat'] ."', " 
                    ."'". $_REQUEST['kelamin'] ."', '". $_REQUEST['lulusan'] ."', '". $hasil['info'] ."')";
            $d->query($sql); 
            $d->close();

            header("location: pegawai.php"); //redirect
        }
    }elseif($action == "HAPUS"){ 
        $u = new Upload();
        $u->hapusFile($_REQUEST["foto"]);

        $d = new Database();
        $sql = "delete from pegawai where id_pegawai = ". $_REQUEST['id'];
        $d->query($sql); 
        $d->close();

        header("location: pegawai.php"); //redirect
    }elseif($action == "HAPUSGAMBAR"){ 
        $u = new Upload();
        $u->hapusFile($_REQUEST["foto"]);

        $d = new Database();
        $sql = "update pegawai set foto = null where id_pegawai = ". $_REQUEST['id'];
        $d->query($sql); 
        $d->close();

        header("location: pegawai.php?action=UBAH&id=".$_REQUEST['id']); //redirect ke posisi edit
    }elseif($action == "UPDATE"){ 
        /* 
        1. kalo ada file yang akan diupload, maka hapus dahulu file yang lama dan update data foto
        2. jika tak ada yang diupload maka data foto jangan diupdate 
        */

        //cek gambarnya sama ga? atau adakah file yang diunggah?
        $u = new Upload();
        $ukuran = $u->fileSize($_FILES["foto"]); //cek ukuran file

        $d = new Database();

        //cek ukuran kalo diatas 0 berarti ada file
        if ($ukuran > 0){ 
            
            //kalo ada temporary foto, maka hapus dahulu
            if ($_REQUEST['tempFoto'] != "") $u->hapusFile($_REQUEST['tempFoto']);
            
            //upload foto baru
            $u = new Upload();
            $hasil = $u->uploadFile($_FILES["foto"]);

            print_r($hasil);

            if ($hasil["status"] == "0"){
                die ($hasil["info"]. "<p><a href='#' onClick='window.history.back()'>Coba lagi</a></p>");
            }else{
                //update data termasuk fotonya
                $sql = "update pegawai set nama = '". $_REQUEST['nama'] ."', " 
                        ."alamat = '". $_REQUEST['alamat'] ."', "
                        ."jkelamin = '". $_REQUEST['kelamin'] ."', "
                        ."lulusan = '". $_REQUEST['lulusan'] ."', "
                        ."foto = '". $hasil['info'] ."' "
                        ."where id_pegawai = ". $_REQUEST['tempID'];
            }
        } else{
            //update data kecuali fotonya
            $sql = "update pegawai set nama = '". $_REQUEST['nama'] ."', " 
                    ."alamat = '". $_REQUEST['alamat'] ."', "
                    ."jkelamin = '". $_REQUEST['kelamin'] ."', "
                    ."lulusan = '". $_REQUEST['lulusan'] ."' "
                    ."where id_pegawai = ". $_REQUEST['tempID'];
        }
        
        $d->query($sql); 
        $d->close();
           
        header("location: pegawai.php"); //redirect
    }elseif($action == "UBAH"){ 
        $d = new Database();
        $sql = "select * from pegawai where id_pegawai = ". $_REQUEST['id'];
        
        $result = $d->getList($sql); ?>

        <h3>Data Pegawai</h3>
        <form enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="tempID" value = "<?= $result[0]['id_pegawai'] ?>"/>
        <input type="hidden" name="tempFoto" value = "<?= $result[0]['foto'] ?>"/>
        
        <?php if (!$result[0]['foto'] == "") { ?>
            <img src="images/<?= $result[0]['foto'] ?>" width="200px"/><br/> 
            <a href="pegawai.php?action=HAPUSGAMBAR&foto=<?= $result[0]['foto'] ?>&id=<?= $result[0]['id_pegawai'] ?>">Hapus</a><br/> 
        <?php } ?>
        
        <label>Foto: </label>
        <input type="file" name="foto"/><br/>
        
        <label>Nama: </label>
        <input type="text" name="nama" value = "<?= $result[0]['nama'] ?>"/><br/>
        
        <label>Alamat: </label>
        <Textarea name="alamat"><?= $result[0]['alamat'] ?></Textarea><br/>
        
        <label>Kelamin:
        </label>
        <select name="kelamin">
            <option value="Pria" <?php if ($result[0]['jkelamin'] == "Pria") print "selected" ?>>Pria</option>
            <option value="Wanita" <?php if ($result[0]['jkelamin'] == "Wanita") print "selected" ?>>Wanita</option>
        </select><br/>
        
        <label>Lulus: </label><br/>
        <input type="radio" name="lulusan" value="SMA" <?php if ($result[0]['lulusan'] == "SMA") print "checked" ?>> SMA
        <input type="radio" name="lulusan" value="SMK" <?php if ($result[0]['lulusan'] == "SMK") print "checked" ?>> SMK
        <input type="radio" name="lulusan" value="STM" <?php if ($result[0]['lulusan'] == "STM") print "checked" ?>> STM
        <input type="radio" name="lulusan" value="MA" <?php if ($result[0]['lulusan'] == "MA") print "checked" ?>> MA<br>

        <input type="submit" name="action" value="UPDATE">
        <input type="reset" name="reset" values="ULANGI">
        </form>
    
        <?php
        $d->close();
    }
    ?>
</body>
</html> 