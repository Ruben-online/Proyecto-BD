<?php
    include("../../conexion.php");

    $IDCliente=$_GET['IDCliente'];
    $sql="DELETE FROM clientes WHERE IDCliente='".$IDCliente."'";
    $resultado=mysqli_query($mysqli, $sql);

    if($resultado){
        echo "  <script language='JavaScript'>
                    alert('Cliente eliminado correctamente!');
                    location.assign('../../empleado/Clientes.php');
                </script>";
    } else {
        echo "  <script language='JavaScript'>
                    alert('No se ha podido eliminar los datos');
                    location.assign('../../empleado/Clientes.php');
                </script>";
    }
    mysqli_close($mysqli);