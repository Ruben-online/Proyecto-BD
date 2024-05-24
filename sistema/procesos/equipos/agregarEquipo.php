<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Equipo</title>

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

        // Consultar los clientes
        $sql_clientes = "SELECT IDCliente, Nombre, Apellido FROM clientes";
        $result_clientes = $mysqli->query($sql_clientes);

        if(isset($_POST['enviar'])) {
            $NombreEquipo = $_POST['NombreEquipo'];
            $IDCliente = $_POST['IDCliente'];
            $FechaCreacion = date('Y-m-d H:i:s'); // Obtiene la fecha y hora actuales

            $sql = "INSERT INTO equipos (NombreEquipo, IDCliente, FechaCreacion)
                    VALUES ('$NombreEquipo', '$IDCliente', '$FechaCreacion')";

            $result = $mysqli->query($sql) or die ('Error: '. $mysqli->error);

            if($result){
                echo "<script language='JavaScript'>
                        alert('Equipo registrado con éxito!');
                        location.assign('../../empleado/Equipos.php');
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Equipo NO registrado');
                        location.assign('../../empleado/Equipos.php');
                      </script>";
            }

        } else {
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <div class="form-group">
            <input type="text" name="NombreEquipo" class="form-control" placeholder="Nombre del Equipo" required>
        </div>
        <div class="form-group">
            <select name="IDCliente" id="IDCliente" class="form-control" required>
            <?php
                // Verificar si hay resultados
                if ($result_clientes->num_rows > 0) {
                    // Recorrer los resultados y crear las opciones del dropdown
                    while($row = $result_clientes->fetch_assoc()) {
                        echo "<option value='" . $row['IDCliente'] . "'>" . $row['Nombre'] . " " . $row['Apellido'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay clientes disponibles</option>";
                }
            ?>
            </select>
        </div>

        <input type="submit" name="enviar" value="Añadir Equipo" class="btn btn-primary">
        <a href="../../empleado/Equipos.php" class="btn btn-secondary">Regresar</a>
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
