<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Cliente</title>

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
        include ("../../conexion.php");

        if (isset($_POST['enviar'])) {
            $IDCliente = $_POST['IDCliente'];
            $NombreEquipo = $_POST['NombreEquipo'];

            $sql = "UPDATE equipos SET 
                        IDCliente = ?,
                        NombreEquipo = ?,
                    WHERE IDCliente = ?";
            $stmt = $mysqli->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('sssssi', $IDCliente, $NombreEquipo);
                $resultado = $stmt->execute();

                if ($resultado) {
                    echo "<script>
                            alert('Equipo actualizado con éxito!');
                            location.assign('../../empleado/Equipos.php');
                          </script>";
                } else {
                    echo "<script>
                            alert('Equipo NO actualizado');
                            location.assign('../../empleado/Equipos.php');
                          </script>";
                }
                $stmt->close();
            } else {
                echo "<script>
                        alert('Error en la preparación de la consulta');
                        location.assign('../../empleado/Clientes.php');
                      </script>";
            }
            $mysqli->close();

        } else {
            if (isset($_GET['IDEquipo'])) {
                $IDEquipo = $_GET['IDEquipo'];

                // Depuración
                // echo "<script>console.log('IDCliente: $IDCliente');</script>";

                $sql = "SELECT * FROM equipos WHERE IDEquipo = ?";
                $stmt = $mysqli->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('i', $IDEquipo);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        $row = $resultado->fetch_assoc();
                        $NombreEquipo = $row['NombreEquipo'];
                        $IDCliente = $row['IDCliente'];
                    } else {
                        echo "<script>
                                alert('Equipo no encontrado');
                                location.assign('../../empleado/Equipos.php');
                              </script>";
                        exit();
                    }
                    $stmt->close();
                } else {
                    echo "<script>
                            alert('Error en la preparación de la consulta');
                            location.assign('../../empleado/Equipos.php');
                          </script>";
                    exit();
                }
                $mysqli->close();
            } else {
                echo "<script>
                        alert('ID de equipo no proporcionado');
                        location.assign('../../empleado/Equipos.php');
                      </script>";
                exit();
            }
        }
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

        <input type="hidden" name="IDCliente" value="<?php echo htmlspecialchars($IDCliente); ?>">
        
        <input type="submit" name="enviar" value="Actualizar Equipo" class="btn btn-primary">
        <a href="../../empleado/Equipos.php" class="btn btn-secondary">Regresar</a>
    </form>
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
