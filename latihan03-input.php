<html>
<head>
    <title>INPUT HTML</title>   
</head>
<body>
    <?php if (empty($_REQUEST['Submit'])){ ?>
    
    <h3>FORM SISWA</h3>
    <form action="<?php $_SERVER['PHP_SELF'] ?>">
        <label>Nama</label>
        <input type="text" name="nama"/><br/>
        <label>Usia</label>
        <input type="text" name="usia"/><br/>
        <label>Lulusan</label>
        <select name="lulus">
            <option value="SMA">SMA</option>
            <option value="SMK">SMK</option>
            <option value="STM">STM</option>
        </select><br/>
        <input type="submit" name="Submit" value="Submit">
        <input type="reset" name="Reset" value="Reset">
    </form>   

    <?php } else { ?>

    <p>Nama ku <?= $_REQUEST["nama"] ?>, aku berusia <?= $_REQUEST["usia"] ?> tahun, lulusan <?= $_REQUEST["lulus"] ?> </p>
    <a href="latihan03-input.php">Kembali</a>

    <?php } ?>
</body>
</html>