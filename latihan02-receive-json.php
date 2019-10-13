<html>
<head>
    <title>JSON READER</title>   
</head>
<body>
    <h3>MEMBACA DATA DARI JSON</h3>
    <p>Studi kasus https://www.themealdb.com/api.php</p>
    
    <?php
    // Get the contents of the JSON file 
    $strJsonFileContents = file_get_contents("https://www.themealdb.com/api/json/v1/1/filter.php?c=Seafood");
    $arrayMeals = json_decode($strJsonFileContents, true); // Convert to array 
    $object = $arrayMeals["meals"]; 
    print_r("JUMLAH: ". count($object));
    print_r($object);
    ?>

    <h3>TAMPILKAN ARRAY PADA HTML</h3>
    <table border="1">

    <?php for($i = 0; $i < count($object); $i++){ ?>
    
        <tr><td width="200"><img src="<?=  $object[$i]["strMealThumb"]; ?>" height="200px"><br><b><?= $object[$i]["strMeal"]; ?></b></td></tr>
    
    <?php } ?>
    
    </table>
</body>
</html>