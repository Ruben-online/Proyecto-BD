<?php 

    session_start();

    require 'conexion.php';

    if(!isset($_SESSION['id'])){
        header("Location: index.php");
    }

    $id = $_SESSION['id'];
    $nombre = $_SESSION['nombre'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    if ($tipo_usuario == 1) {
        $where = "";
    } else if ($tipo_usuario == 2) {
        $where = "WHERE id=$id";
    }

    $sql = "SELECT * FROM cliente";
    $resultado = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clientes</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Confirmacion de eliminacion -->
    <script type="text/javascript">
        function confirmar(){
            return confirm('¿Está seguro? Se eliminaran los datos!');
        }
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">Spirit F.c.</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php if ($tipo_usuario == 1) { ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="principal.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel de Control</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php } ?>

            <!-- Heading -->
            <div class="sidebar-heading">
                Servicios
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item active"> <!-- nav-item active para "desactivar" la opcion en la navbar e indicar que se encuentra ahi -->
                <a class="nav-link">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Clientes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="equipos.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Equipos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reservaciones.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Reservaciones</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="torneos.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Torneos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombre; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuracion
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Gestor de Clientes</h1>
                    <p class="mb-4"></p>

                    <!--Boton Agregar Cliente -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-5">
                        <p class="mb-4"></p>
                        <a href="procesos/clientes/agregarCliente.php" 
                            class="d-none d-sm-inline-block btn btn-sm bg-gradient-info text-gray-100 shadow-sm">
                            <i class="fas fa-regular fa-user fa-sm text-white-100"></i> Agregar Cliente</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while($row = $resultado->fetch_assoc()) { ?>
                                        <tr>
                                            <!-- Información de las bases de datos a mostrar (Consulta a la BD al principio del codigo)-->
                                            <td><?php echo $row['id'];?></td>
                                                <!-- LLamado a los procesos para Editar y Eliminar información-->
                                                <?php echo "<a onclick='return confirmar()' href='procesos/clientes/eliminarCliente.php?id=".$row['id']."'>Eliminar</a>";?><i class="fas fa-trash"></i>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Spirit F.C. 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Esta apunto de cerrar su sesion actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="logout.php">Cerrar Sesion</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>