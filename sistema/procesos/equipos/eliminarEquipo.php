<?php
    include("../../conexion.php");

    $IDEquipo=$_GET['IDEquipo'];
    $sql="DELETE FROM equipos WHERE IDEquipo='".$IDEquipo."'";
    $resultado=mysqli_query($mysqli, $sql);

    if($resultado){
        echo "  <script language='JavaScript'>
                    alert('Equipo eliminado correctamente!');
                    location.assign('../../empleado/Equipos.php');
                </script>";
    } else {
        echo "  <script language='JavaScript'>
                    alert('No se ha podido eliminar los datos');
                    location.assign('../../empleado/Equipos.php');
                </script>";
    }
    mysqli_close($mysqli);