<?php
include 'db.php';

// Crear un nuevo usuario
if(isset($_POST['create'])){  //Vereifica si el formulario fué enviado
    // Obtenemos los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];

    //Construimos la consulta SQL
    $sql = "INSERT INTO users(name, email) VALUES ('$name', '$email')";

    // Se realiza la consulta utilizan el objeto de conexión $conn
    if ($conn->query(query: $sql) === TRUE) {
        //Redirigir a la página principal si la inserción fué exitosa
        header(header:'Location: index.php'); 
    } else {
        // Si hubo error se imprime el mensaje de error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


