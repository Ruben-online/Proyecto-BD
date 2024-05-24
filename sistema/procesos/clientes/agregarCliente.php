<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Cliente</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Sweetalert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="card card-body">
    <?php 
        // Conectar a la base de datos
        include ("../../conexion.php");

        if(isset($_POST['enviar'])) {
            $Nombre = $_POST['Nombre'];
            $Apellido = $_POST['Apellido'];
            $Email = $_POST['Email'];
            $Telefono = $_POST['Telefono'];
            $Direccion = $_POST['Direccion'];

            $sql = "INSERT INTO clientes (Nombre, Apellido, Email, Telefono, Direccion)
                    VALUES ('$Nombre', '$Apellido', '$Email', '$Telefono', '$Direccion')";

            $result = $mysqli->query($sql) or die ('Error: '. $mysqli->error);

            if($result){
                echo "<script language='JavaScript'>
                        alert('Cliente registrado con éxito!');
                        location.assign('../../empleado/Clientes.php');
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Cliente NO registrado');
                        location.assign('../../empleado/Clientes.php');
                      </script>";
            }

        } else {
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <div class="form-group">
            <input type="text" name="Nombre" class="form-control" placeholder="Nombre(s) del Cliente" required>
        </div>
        <div class="form-group">
            <input type="text" name="Apellido" class="form-control" placeholder="Apellido(s) del Cliente" required>
        </div>
        <div class="form-group">
            <input type="email" name="Email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="tel" name="Telefono" class="form-control" placeholder="Telefono" required>
        </div>
        <div class="form-group">
            <input type="text" name="Direccion" class="form-control" placeholder="Direccion" required>
        </div>

        <input type="submit" name="enviar" value="Añadir Cliente" class="btn btn-primary">
        <a href="../../empleado/Clientes.php" class="btn btn-secondary">Regresar</a>
    </form>
    <?php } ?>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../js/sb-admin-2.min.js"></script>
</body>
</html>
