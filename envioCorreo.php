<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    $categ = $_POST['categoria'];

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
    echo "<button><a href='index.php'>Volver</a></button>";
    echo "<h1>Formulario Gmail</h1>";
        echo "<form action='recepcionMandaCorreo.php' method='post'>";
            if (empty($categ)) {
                echo "<small style='text-align: center; color: red;'>La categoria no puede estar vacía</small>";
            } else {
                //Aqui recibo
                echo "<small style='color: green'>Categoria recibida correctamente</small>";
                echo "<br>";
                $directorioCarp = "Categorias/$categ";
                if (is_dir($directorioCarp)) {
                    $arrayCategorias = scandir($directorioCarp);
                    $arrayFormateado = array_slice($arrayCategorias, 2);
                    foreach ($arrayFormateado as $ficheros) {
                        echo "<img src='Categorias/$categ/$ficheros' alt='Imagenes'>";
                        echo "<input type='radio' name='radios' value='$ficheros'>";
                        echo "<br><br>";
                    }
                    echo "<input type='hidden' name='categoria' value='$categ'>";
                } else {
                    echo "No es un directorioCarp";
                }
                echo "<br><br>";
                $stmt = $enlace->prepare("select * from clientes");
                $stmt->execute();
                echo "<table>";
                echo "<tr><th>Nombre_Cliente</th><th>Apellidos_Cliente</th><th>Direccion</th><th>Cp</th><th>Email</th><th>Fecha_Nacimiento</th><th>Checkboxes</th></tr>";
                    while ($fila = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>";
                        foreach ($fila as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "<td><input type='checkbox' name='correos[]' value=$fila[4]></td>";
                        echo "</tr>";
                    }
                echo "</table>";
            }
            echo "<input type='submit' name='boton' value='Enviar'>";
        echo "</form>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
?>