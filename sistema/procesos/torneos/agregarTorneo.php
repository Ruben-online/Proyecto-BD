<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Torneo</title>

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
            $NombreTorneo = $_POST['NombreTorneo'];
            $FechaInicio = $_POST['FechaInicio'];
            $FechaFin = $_POST['FechaFin'];
            $Descripcion = $_POST['Descripcion'];

            $sql = "INSERT INTO torneos (NombreTorneo, FechaInicio, FechaFin, Descripcion)
                    VALUES ('$NombreTorneo', '$FechaInicio', '$FechaFin', '$Descripcion')";

            $result = $mysqli->query($sql) or die ('Error: '. $mysqli->error);

            if($result){
                echo "<script language='JavaScript'>
                        alert('Torneo registrado con éxito!');
                        location.assign('../../empleado/Torneos.php');
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Torneo NO registrado');
                        location.assign('../../empleado/Torneos.php');
                      </script>";
            }

        } else {
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <div class="form-group">
            <input type="text" name="NombreTorneo" class="form-control" placeholder="Nombre del Torneo" required>
        </div>
        <div class="form-group">
            <input type="date" name="FechaInicio" class="form-control" placeholder="Fecha de Inicio" required>
        </div>
        <div class="form-group">
            <input type="date" name="FechaFin" class="form-control" placeholder="Fecha de Finalización" required>
        </div>
        <div class="form-group">
            <textarea name="Descripcion" class="form-control" placeholder="Descripción" required></textarea>
        </div>

        <input type="submit" name="enviar" value="Añadir Torneo" class="btn btn-primary">
        <a href="../../empleado/Torneos.php" class="btn btn-secondary">Regresar</a>
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
