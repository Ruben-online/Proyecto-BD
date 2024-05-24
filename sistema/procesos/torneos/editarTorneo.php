<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar/Editar Torneo</title>

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

        $isEditing = false;
        $torneo = ['IDTorneo' => '', 'NombreTorneo' => '', 'FechaInicio' => '', 'FechaFin' => '', 'Descripcion' => ''];

        if(isset($_GET['IDTorneo'])) {
            $isEditing = true;
            $IDTorneo = $_GET['IDTorneo'];

            // Consultar el torneo existente
            $sql_torneo = "SELECT * FROM torneos WHERE IDTorneo = ?";
            $stmt = $mysqli->prepare($sql_torneo);
            if ($stmt) {
                $stmt->bind_param("i", $IDTorneo);
                $stmt->execute();
                $result = $stmt->get_result();
                $torneo = $result->fetch_assoc();
                $stmt->close();
            }

            // Verificación de valores recuperados (depuración)
            echo "<script>console.log('Datos recuperados: " . json_encode($torneo) . "');</script>";
        }

        if(isset($_POST['enviar'])) {
            $IDTorneo = isset($_POST['IDTorneo']) ? $_POST['IDTorneo'] : null;
            $NombreTorneo = $_POST['NombreTorneo'];
            $FechaInicio = $_POST['FechaInicio'];
            $FechaFin = $_POST['FechaFin'];
            $Descripcion = $_POST['Descripcion'];

            if ($IDTorneo) {
                // Actualizar torneo
                $sql = "UPDATE torneos 
                        SET NombreTorneo = ?, FechaInicio = ?, FechaFin = ?, Descripcion = ?
                        WHERE IDTorneo = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('sssii', $NombreTorneo, $FechaInicio, $FechaFin, $Descripcion, $IDTorneo);
            } else {
                // Insertar nuevo torneo
                $sql = "INSERT INTO torneos (NombreTorneo, FechaInicio, FechaFin, Descripcion)
                        VALUES (?, ?, ?, ?)";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('ssss', $NombreTorneo, $FechaInicio, $FechaFin, $Descripcion);
            }

            $result = $stmt->execute();

            if($result){
                echo "<script language='JavaScript'>
                        alert('Torneo " . ($IDTorneo ? "actualizado" : "registrado") . " con éxito!');
                        location.assign('../../empleado/Torneos.php');
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Torneo NO " . ($IDTorneo ? "actualizado" : "registrado") . "');
                        location.assign('../../empleado/Torneos.php');
                      </script>";
            }

            $stmt->close();
        } else {
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="hidden" name="IDTorneo" value="<?php echo $isEditing ? htmlspecialchars($torneo['IDTorneo']) : ''; ?>">
        <div class="form-group">
            <input type="text" name="NombreTorneo" class="form-control" placeholder="Nombre del Torneo" value="<?php echo $isEditing ? htmlspecialchars($torneo['NombreTorneo']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <input type="date" name="FechaInicio" class="form-control" placeholder="Fecha de Inicio" value="<?php echo $isEditing ? htmlspecialchars($torneo['FechaInicio']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <input type="date" name="FechaFin" class="form-control" placeholder="Fecha de Finalización" value="<?php echo $isEditing ? htmlspecialchars($torneo['FechaFin']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <textarea name="Descripcion" class="form-control" placeholder="Descripción" required><?php echo $isEditing ? htmlspecialchars($torneo['Descripcion']) : ''; ?></textarea>
        </div>

        <input type="submit" name="enviar" value="<?php echo $isEditing ? 'Actualizar Torneo' : 'Añadir Torneo'; ?>" class="btn btn-primary">
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
