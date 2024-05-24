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
            $Nombre = $_POST['Nombre'];
            $Apellido = $_POST['Apellido'];
            $Email = $_POST['Email'];
            $Telefono = $_POST['Telefono'];
            $Direccion = $_POST['Direccion'];

            $sql = "UPDATE clientes SET 
                        Nombre = ?,
                        Apellido = ?,
                        Email = ?,
                        Telefono = ?,
                        Direccion = ?
                    WHERE IDCliente = ?";
            $stmt = $mysqli->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('sssssi', $Nombre, $Apellido, $Email, $Telefono, $Direccion, $IDCliente);
                $resultado = $stmt->execute();

                if ($resultado) {
                    echo "<script>
                            alert('Cliente actualizado con éxito!');
                            location.assign('../../empleado/Clientes.php');
                          </script>";
                } else {
                    echo "<script>
                            alert('Cliente NO actualizado');
                            location.assign('../../empleado/Clientes.php');
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
            if (isset($_GET['IDCliente'])) {
                $IDCliente = $_GET['IDCliente'];

                // Depuración
                // echo "<script>console.log('IDCliente: $IDCliente');</script>";

                $sql = "SELECT * FROM clientes WHERE IDCliente = ?";
                $stmt = $mysqli->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('i', $IDCliente);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        $row = $resultado->fetch_assoc();
                        $Nombre = $row['Nombre'];
                        $Apellido = $row['Apellido'];
                        $Email = $row['Email'];
                        $Telefono = $row['Telefono'];
                        $Direccion = $row['Direccion'];
                    } else {
                        echo "<script>
                                alert('Cliente no encontrado');
                                location.assign('../../empleado/Clientes.php');
                              </script>";
                        exit();
                    }
                    $stmt->close();
                } else {
                    echo "<script>
                            alert('Error en la preparación de la consulta');
                            location.assign('../../empleado/Clientes.php');
                          </script>";
                    exit();
                }
                $mysqli->close();
            } else {
                echo "<script>
                        alert('ID de cliente no proporcionado');
                        location.assign('../../empleado/Clientes.php');
                      </script>";
                exit();
            }
        }
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <div class="form-group">
            <input type="text" name="Nombre" class="form-control" value="<?php echo htmlspecialchars($Nombre); ?>" placeholder="Nombre(s) del Cliente">
        </div>
        <div class="form-group">
            <input type="text" name="Apellido" class="form-control" value="<?php echo htmlspecialchars($Apellido); ?>" placeholder="Apellido(s) del Cliente">
        </div>
        <div class="form-group">
            <input type="text" name="Email" class="form-control" value="<?php echo htmlspecialchars($Email); ?>" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="tel" name="Telefono" class="form-control" value="<?php echo htmlspecialchars($Telefono); ?>" placeholder="Telefono">
        </div>
        <div class="form-group">
            <input type="text" name="Direccion" class="form-control" value="<?php echo htmlspecialchars($Direccion); ?>" placeholder="Direccion">
        </div>

        <input type="hidden" name="IDCliente" value="<?php echo htmlspecialchars($IDCliente); ?>">
        
        <input type="submit" name="enviar" value="Actualizar Cliente" class="btn btn-primary">
        <a href="../../empleado/Clientes.php" class="btn btn-secondary">Regresar</a>
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
