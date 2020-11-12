<!DOCTYPE html>
<html>
<head>
    <title>PHP Form</title>
</head>
<body>
    <h1>FORM DENGAN PHP</h1>
    <?php
    #menangkap respon dari method="post"
    if($_SERVER['REQUEST_METHOD'] == "POST"){ #jika ditekan submit
        #Tangkap variable
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $lulus = $_POST['lulus'];
        
        #menangkap nilai dari radio "status" menggunakan if ternary
        $status = isset($_POST['status']) ? $_POST['status'] : "";

        #menangkap nilai dari checkbox yang memiliki nama berbeda-beda
        $hobi =  isset($_POST['musik']) ? $_POST['musik'] .", " : "";
        $hobi .=  isset($_POST['olah_raga']) ? $_POST['olah_raga'] .", " : "";
        $hobi .=  isset($_POST['travel']) ? $_POST['travel'] .", " : "";

        #membuang koma diakhir variabel $hobi
        $hobi = rtrim($hobi, ", ");

        #tampilkan dalam bentuk html
        echo "<p>Nama: $nama</p>
                <p>Alamat: $alamat</p>
                <p>Lulus: $lulus</p>
                <p>Status: $status</p>
                <p>Hobi: $hobi</p>
                <p><a href='form.php'>Ulangi</a></p>";
    }else{
    ?>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
            <p>Nama: <input type="text" name="nama"/></p>
            <p>Alamat: <textarea name="alamat"></textarea></p>
            <p>Lulus: 
                <select name="lulus">
                    <option value="SMA">SMA</option>
                    <option value="D3">D3</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </p>
            <p>Status: <br/>
                <input type="radio" name="status" value="Bekerja"/> Bekerja<br/>
                <input type="radio" name="status" value="Magang"/> Magang<br/>
                <input type="radio" name="status" value="Belum kerja"/> Belum Kerja<br/>    
            </p>
            <p>Hobi: <br/>
                <input type="checkbox" name="musik" value="Musik"/> Musik<br/>
                <input type="checkbox" name="olah_raga" value="Olah Raga"/> Olah Raga<br/>
                <input type="checkbox" name="travel" value="Travel"/> Travel<br/>
            </p>
            <input type="submit" name="submit" value="SIMPAN"/>
            <input type="reset" name="reset" value="ULANGI"/>
        </form>
    <?php } ?>
</body>
</html>