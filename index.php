<?php

$conn = new mysqli('10.254.1.18', 'fmancilla', 'fmancilla.,', 'BD_DISCADOR');

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
  }

if(!empty($_POST['fonos'])){
    $fonos = preg_replace("/[\r\n|\n|\r]+/", "",str_replace(' ', '',trim($_POST['fonos'])));

    $fono = explode(',',$fonos);
    // print "<pre>";
    // var_dump($fono);
    // print "</pre>";

    foreach ($fono as $key => $value) {
        $sql = "select BD_DISCADOR.MOSTRAR_COMPANIA2( $value) as compania;";

        if($resultado = $conn->query($sql)){
            while ($objeto = $resultado->fetch_object()) {

            print $value.' - '.$objeto->compania.'<br>';

            }
    }
}
} else {
    print "Ingrese los numeros separados por comas";
}

  $conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>company's</title>
</head>
<body>
    <h1>Telefonos</h1>
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">

        <textarea name='fonos' id="" cols="30" rows="10"></textarea>
        <br><br>
        <input type="submit">

    </form>
</body>
</html>
