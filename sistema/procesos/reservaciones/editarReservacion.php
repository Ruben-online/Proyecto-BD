<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar/Editar Reservación</title>

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

        $isEditing = false;
        if(isset($_GET['IDReservacion'])) {
            $isEditing = true;
            $IDReservacion = $_GET['IDReservacion'];
            // Consultar la reservación existente
            $sql_reservacion = "SELECT * FROM reservaciones WHERE IDReservacion = ?";
            $stmt = $mysqli->prepare($sql_reservacion);
            if ($stmt) {
                $stmt->bind_param("i", $IDReservacion);
                $stmt->execute();
                $result = $stmt->get_result();
                $reservacion = $result->fetch_assoc();
                $stmt->close();
            }
        }

        if(isset($_POST['enviar'])) {
            $IDReservacion = isset($_POST['IDReservacion']) ? $_POST['IDReservacion'] : null;
            $IDCliente = $_POST['IDCliente'];
            $FechaReservacion = $_POST['FechaReservacion'];
            $HoraInicio = $_POST['HoraInicio'];
            $HoraFin = $_POST['HoraFin'];
            $Cancha = $_POST['Cancha'];

            if ($IDReservacion) {
                // Actualizar reservación
                $sql = "UPDATE reservaciones 
                        SET IDCliente = ?, FechaReservacion = ?, HoraInicio = ?, HoraFin = ?, Cancha = ?
                        WHERE IDReservacion = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('issssi', $IDCliente, $FechaReservacion, $HoraInicio, $HoraFin, $Cancha, $IDReservacion);
            } else {
                // Insertar nueva reservación
                $sql = "INSERT INTO reservaciones (IDCliente, FechaReservacion, HoraInicio, HoraFin, Cancha)
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('issss', $IDCliente, $FechaReservacion, $HoraInicio, $HoraFin, $Cancha);
            }

            $result = $stmt->execute();

            if($result){
                echo "<script language='JavaScript'>
                        alert('Reservación " . ($IDReservacion ? "actualizada" : "registrada") . " con éxito!');
                        location.assign('../../empleado/Reservaciones.php');
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Reservación NO " . ($IDReservacion ? "actualizada" : "registrada") . "');
                        location.assign('../../empleado/Reservaciones.php');
                      </script>";
            }

            $stmt->close();
        } else {
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="hidden" name="IDReservacion" value="<?php echo $isEditing ? $reservacion['IDReservacion'] : ''; ?>">
        <div class="form-group">
            <select name="IDCliente" id="IDCliente" class="form-control" required>
            <?php
                // Verificar si hay resultados
                if ($result_clientes->num_rows > 0) {
                    // Recorrer los resultados y crear las opciones del dropdown
                    while($row = $result_clientes->fetch_assoc()) {
                        $selected = $isEditing && $row['IDCliente'] == $reservacion['IDCliente'] ? 'selected' : '';
                        echo "<option value='" . $row['IDCliente'] . "' $selected>" . $row['Nombre'] . " " . $row['Apellido'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay clientes disponibles</option>";
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <input type="date" name="FechaReservacion" class="form-control" placeholder="Fecha de Reservación" value="<?php echo $isEditing ? $reservacion['FechaReservacion'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <input type="time" name="HoraInicio" class="form-control" placeholder="Hora de Inicio" value="<?php echo $isEditing ? $reservacion['HoraInicio'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <input type="time" name="HoraFin" class="form-control" placeholder="Hora de Fin" value="<?php echo $isEditing ? $reservacion['HoraFin'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <input type="text" name="Cancha" class="form-control" placeholder="Cancha" value="<?php echo $isEditing ? $reservacion['Cancha'] : ''; ?>" required>
        </div>

        <input type="submit" name="enviar" value="<?php echo $isEditing ? 'Actualizar Reservación' : 'Añadir Reservación'; ?>" class="btn btn-primary">
        <a href="../../empleado/Reservaciones.php" class="btn btn-secondary">Regresar</a>
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
