<?php

/**
 * $_FILES
 * 
 * Los obtenemos con distintos datos que muestra incluso donde alojarlo
 * Propiedades que va recibiendo por archivos: "NAME", "TYPE", "TMP_NAME","SIZE","ERROR"
 * 
 * 
 *   move_uploaded_file --> chequea que sea un archivo valido, recibe origen del arhivo y a donde va.  
 *  tomaremos el nombre que ingresa del archivo, concatenar el nombre con la extension y guardarlo en una carpeta.
 *  Chequear el tamaño que sea menor a 8 megas y la extension que va a tener
 */
    echo "Metodo Post";

    var_dump($_POST);

    echo "<br>Metodo FILES";

    var_dump($_FILES);

    echo "<br> Prueba <br>";

    echo($_FILES["archivo"]["name"]);

    $nombre = $_FILES["archivo"]["type"];
    
    //Esto lo convierte en un array, decidir de que lado lo vas a tomar 
    $extension = explode("/",$_FILES["archivo"]["type"]);
    //Para hacerlo podes utilizar el array_reverse

    
    
    
    var_dump($extension);

    //Importante para moverlo, tenes que utilizar el directorio temporal
    if(move_uploaded_file($_FILES["archivo"]["tmp_name"],"../Upload/".$_POST['nombre'].".".$extension[1])){
        echo "<br>lo logro";
    }
   


?>