<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Registro</title>
</head>
<body>

    <div class="contenedor_form registrar">

        <div class="informacion_1">

            <div class="info">

                <h2>¡Bienvenido!</h2>

                <p>Si ya tienes una cuenta inicie sesión con sus datos.</p>

                <input type="button" value="Iniciar Sesión" id="inicio">

            </div>


        </div>

        <div class="informacion_2">

            <div class="info_2">

                <h2>Crea una cuenta</h2>
                <p>Usa un email para registrarte.</p>

                <form action="" method="post" class="form">

                    <label>

                        <i class='bx bx-user' ></i>
                        <input type="text" name="Nombres" placeholder="Nombre Completo" required>

                    </label>

                    <label>

                        <i class='bx bx-envelope' ></i>
                        <input type="email" name="correo" placeholder="forexample@example.com" required>

                    </label>
                    
                    <label>

                        <i class='bx bx-lock-alt'></i>
                        <input type="password" name="password" placeholder="contraseña" required>

                    </label>

                    <input type="submit" value="Registrarse" name="btnregistrar">

                </form>

            </div>

        </div>

    </div>

    <!-- Parte 2 del contenedor iniciar sesion -->

    <div class="contenedor_form login hide">

        <div class="informacion_1">

            <div class="info">

                <h2>¡Bienvenido Nuevamente!</h2>

                <p>Para unirte a nuestra comunidad por favor registrese con sus datos.</p>

                <input type="button" value="Registrarse" id="registrar">

            </div>


        </div>

        <div class="informacion_2">

            <div class="info_2">

                <h2>Inicia Sesión</h2>
                <p>Usa su email para Iniciar Sesión.</p>

                <form action="" method="post" class="form">


                    <label>

                        <i class='bx bx-envelope' ></i>
                        <input type="email" name="correo" placeholder="forexample@example.com" required>

                    </label>
                    
                    <label>

                        <i class='bx bx-lock-alt'></i>
                        <input type="password" name="password" placeholder="contraseña" required>

                    </label>

                    <input type="submit" value="iniciar Sesión" id="iniciar_sesion" name="btnlogin">

                </form>

            </div>

        </div>

    </div>

    <script src="../js/script.js"></script>

</body>
</html>

<?php // registro
    
    if (isset($_POST["btnregistrar"])) {
        $dbhost= "127.0.0.1:3308"; //
        $dbusuario= "root";
        $dbpassword = "";
        $dbnombre= "register";

        $usuario = $_POST["Nombres"];
        $correo = $_POST["correo"];
        $pass = $_POST["password"];

        $conex = mysqli_connect($dbhost, $dbusuario, $dbpassword, $dbnombre);
    
        if (!$conex) {
            die("No hay conexión".mysqli_connect_error());
        }

        $sqlgrabar = "INSERT INTO usuario(nombre,correo,clave) VALUES ('$usuario','$correo','$pass')"; // INSERCION DE DATOS A LA BASE DE DATOS

        if (mysqli_query($conex, $sqlgrabar)) {
            echo "<script> alert('Se ha registrado correctamente!'); window.location = 'registro_login.php'</script>"; 
        }

        else {

            echo "ERROR :/" .$sql."<br>".mysqli_error($conex); //
            
        }
    }
    
    ?>

    <?php

    session_start(); //verifica si se ha iniciado sesion
    if (isset($_SESSION['nombreCorreo'])) {
        header('location: pag_principal.php');
    }
    
    if (isset($_POST['btnlogin'])) {
        $dbhost= "127.0.0.1:3308"; //
        $dbusuario= "root";
        $dbpassword = "";
        $dbnombre= "register";

        $conex = mysqli_connect($dbhost, $dbusuario, $dbpassword, $dbnombre);
        if (!$conex) {
            die("Sin conexion".mysqli_connect_error());
        }

        $correo = $_POST["correo"];
        $pass = $_POST["password"];

        $query = mysqli_query($conex, "Select * from usuario where correo = '".$correo."' and clave = '".$pass."'"); //verifica si el usuario esta en la bd
        $nr = mysqli_num_rows($query); // verifica si hay una fila donde esta registrado el user

        if(!isset($_SESSION['nombreCorreo'])){ // verifica si no hay una sesion abierta

        
        if($nr==1){ // si hay una fila donde coinciden los datos registrados con la bd (deberia haber un registro (una fila))
            $_SESSION['nombreCorreo']= $correo; // guardamos el correo en una session
            header("location: pag_principal.php");
        }

        else if($nr==0){ // si no hay filas que coincidan con los datos ingresados por el user, error.
           echo "<script>alert('Usuario no existe');window.location='registro_login.php' </script>";
        }
        }
    }

    ?>