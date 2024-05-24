<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Empleado</title>

    <!-- Custom fonts for this template-->
    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Sweetalert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="card card-body">
    <?php 
        // Conectar a la base de datos y realizar la consulta de roles
        include ("../../conexion.php");

        $sql_roles = "SELECT IDRol, NombreRol FROM roles";
        $result_roles = $mysqli->query($sql_roles);

        if(isset($_POST['enviar'])) {
            $usuario = $_POST['Usuario'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $password = $_POST['contrasenia'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            $tipoUsuario = $_POST['roles_idroles'];

            $sql = "INSERT INTO usuarios(usuario, nombres, apellidos, correo, contrasenia, roles_idroles)
                    VALUES('$usuario', '$nombres', '$apellidos', '$correo', '$password', '$tipoUsuario')";

            $result = $mysqli->query($sql) or die ('Error: '. $mysqli->error);

            if($result){
                echo "<script language='JavaScript'>
                        alert('Empleado registrado con éxito!');
                        location.assign('../../principalAdmin.php');
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Empleado NO registrado');
                        location.assign('../../principalAdmin.php');
                      </script>";
            }

        } else {
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <div class="form-group">
            <input type="text" name="usuario" class="form-control" placeholder="Nombre de Usuario" required>
        </div>
        <div class="form-group">
            <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
        </div>
        <div class="form-group">
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
        </div>
        <div class="form-group">
            <input type="text" name="correo" class="form-control" placeholder="Correo Electrónico" required>
        </div>
        <div class="form-group">
            <input type="password" name="contrasenia" class="form-control" placeholder="Contraseña" required>
        </div>
        <div class="form-group">
            <select name="roles_idroles" id="roles" class="form-control" required>
            <?php
                // Verificar si hay resultados
                if ($result_roles->num_rows > 0) {
                    // Recorrer los resultados y crear las opciones del dropdown
                    while($row = $result_roles->fetch_assoc()) {
                        echo "<option value='" . $row['idroles'] . "'>" . $row['cargo'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay roles disponibles</option>";
                }
            ?>
            </select>
        </div>
        <input type="submit" name="enviar" value="Añadir Usuario" class="btn btn-primary">
        <a href="../principalAdmin.php" class="btn btn-secondary">Regresar</a>
    </form>
    <?php } ?>
</div>
</body>
</html>
