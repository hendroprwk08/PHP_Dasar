<html>
<head>
    <title>Latihan Looping</title>   
</head>
<body>
    <h3>FOR NEXT</h3>
    <?php
    $loop = 10;

    for($i = 0; $i <= $loop; $i++){
        Print $i."</br>";
    }
    ?>
    <h3>WHILE</h3>
    <?php
    $i = 0;
    while($i <= $loop){
        Print $i."</br>";
        $i++;
    }
    ?>
    <h3>DO WHILE</h3>
    <?php
    $i = 0;
    do{
        Print $i."</br>";
        $i++;
    }while($i <= $loop);    
    ?>    
    <h3>FOR - ARRAY</h3>
    <?php
    $arrTeman = Array('Anto', 'Desi', 'Rahmat', 'Sobari');
    $jumTeman = count($arrTeman);
    
    for($i = 0; $i < $jumTeman; $i++){
        Print $arrTeman[$i]."</br>";
    }
    ?>
    <h3>FOR - WHILE</h3>
    <?php
    $i = 0;
    while($i < $jumTeman){
        Print $arrTeman[$i]."</br>";
        $i++;
    }
    ?>
    <h3>FOR - DO WHILE</h3>
    <?php
    $i = 0;
    do{
        Print $arrTeman[$i]."</br>";
        $i++;
    }while($i < $jumTeman);
    ?>
</body>
</html>