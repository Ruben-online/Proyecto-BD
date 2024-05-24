<?php
    include("../../conexion.php");

    $IDTorneo=$_GET['IDTorneo'];
    $sql="DELETE FROM torneos WHERE IDTorneo='".$IDTorneo."'";
    $resultado=mysqli_query($mysqli, $sql);

    if($resultado){
        echo "  <script language='JavaScript'>
                    alert('Torneo eliminado correctamente!');
                    location.assign('../../empleado/Torneos.php');
                </script>";
    } else {
        echo "  <script language='JavaScript'>
                    alert('No se ha podido eliminar los datos');
                    location.assign('../../empleado/Torneos.php');
                </script>";
    }
    mysqli_close($mysqli);