<?php
    include("../../conexion.php");

    $IDReservacion=$_GET['IDReservacion'];
    $sql="DELETE FROM reservaciones WHERE IDReservacion='".$IDReservacion."'";
    $resultado=mysqli_query($mysqli, $sql);

    if($resultado){
        echo "  <script language='JavaScript'>
                    alert('Reservación eliminado correctamente!');
                    location.assign('../../empleado/Reservaciones.php');
                </script>";
    } else {
        echo "  <script language='JavaScript'>
                    alert('No se ha podido eliminar los datos');
                    location.assign('../../empleado/Reservaciones.php');
                </script>";
    }
    mysqli_close($mysqli);