<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    function pintaSelects(){
        $directorio = "Categorias/";
        if (is_dir($directorio)) {
            echo "Categorias: <select name='categoria'>";
            $arrayCategorias = scandir($directorio);
            $arrayFormateado = array_slice($arrayCategorias, 2);
            foreach ($arrayFormateado as $categoria) {
                echo "<option value='$categoria' selected>$categoria</option>";
            }
            echo "</select>";
        } else {
            echo "No es un directorio";
        }
    }

    $boton = $_POST['boton'];

    if ($boton != "Enviar") {
        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Gmail</title>";
        echo "<link rel='stylesheet' href='css/estilo.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h1>Formulario Gmail</h1>";
            echo "<form action='envioCorreo.php' method='post'>";
                pintaSelects();
                echo "<br><br>";
                echo "<input type='submit' name='boton' value='Enviar'>";
            echo "</form>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
?>