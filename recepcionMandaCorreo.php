<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    $archivos = $_POST['radios'];
    $correo = $_POST['correos'];
    $categoria = $_POST['categoria'];

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
        spl_autoload_register(function ($clase){
            $fullpath = "/var/www/html/phpmainler/PHPMailer/src/".$clase.".php";
            if (file_exists($fullpath)) {
                require_once($fullpath);
            } else {
                echo "<p>La clase $fullpath no se encuentra </p>";
            }
        });
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->Username = 'Adrian';
        $mail->Password = 'adrian';
        $mail->Port = 587;
        try {
            $mail->setFrom('Adrian@adrian.es', 'Adrian');
            foreach ($correo as $value) {
                $mail->addAddress($value, 'Receptor');
                echo "<br><br>";
            }
            $mail->Subject = 'Postal por correo';
            $rutaImagen = "Categorias/$categoria/$archivos";
            //$imagen = file_get_contents($rutaImagen); Este metodo es para recibir un contenido especifico
            //Con el siguiente metodo lo que hacemos es enviar el archivo adjunto directamente, y solo coge la ruta especifica lo de arriba
            //no funciona por que es el archivo directo que recogemos a partir de la ruta, unicamente necesita la variable con la ruta
            //o la ruta directamente
            $mail->addAttachment($rutaImagen);
            $mail->Body = "Espero que le guste la postal, $categoria";
            $mail->send();
        } catch (Exception $e) {
            echo 'El mensaje no pudo ser enviado.';
            echo 'Error de correo: ' . $mail->ErrorInfo;
        }
    echo "</div>";
    echo "</body>";
    echo "</html>";
?>