<?php
include 'db.php';

// Crear un nuevo usuario
if (isset($_POST['create'])) {  //Vereifica si el formulario fué enviado
    // Obtenemos los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];

    //Construimos la consulta SQL
    $sql = "INSERT INTO users(name, email) VALUES ('$name', '$email')";

    // Se realiza la consulta utilizan el objeto de conexión $conn
    if ($conn->query(query: $sql) === TRUE) {
        //Redirigir a la página principal si la inserción fué exitosa
        header(header: 'Location: index.php');
    } else {
        // Si hubo error se imprime el mensaje de error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Editar el usuario
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = 'SELECT * FROM users WHERE id = $id';
    $result = $conn->query(query: $sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Usuario</title>
            <link rel="stylesheet" href="./styles.css">
            </head>

            <body>
                <div class="conatiner">
                    <h1>Editar Usuario</h1>
                    <form action="process.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                        <button type="submit" name="update">Actualizar Usuario</button>
                    </form>
                </div>
            </body>

        </html>
        <?php
    }
}