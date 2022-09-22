<?php 
    session_start();
  
    if(!$_SESSION['id']) header('location:index.php');

$conexion = mysqli_connect("localhost", "root", "", "proyecto"); 

$variable = $_POST['id'];
$idC;

$consulta = "SELECT * FROM pacientes WHERE id = '$variable'";
        $resultado = $conexion->query($consulta);
        $datos = [];
        if($resultado->num_rows) {
            while($row = $resultado->fetch_assoc()) {
                $datos[] = [
                    /* 'identificador' => $row['id'], */
                    'nombre' => $row['nombre'],
                    'apell' => $row['apellido'],
                    'nombre' => $row['nombre'],
                    'dni' => $row['dni'],
                    'nac' => $row['fecha_nac'],
                    's' => $row['sexo'],
                    'tel' => $row['tel'],
                    'dir' => $row['direccion'],
                ];
            }
        }

$consulta2 = "SELECT * FROM coment WHERE paciente_id = '$variable'";
    $resultado2 = $conexion->query($consulta2);
    $datos2 = [];
    if($resultado2->num_rows) {
        while($row = $resultado2->fetch_assoc()) {
            $datos2[] = [/* 
                'idComent' => $row['id'],
                'pacienteID' => $row['paciente_id'],
                'nombre' => $row['nombre'], */
                'esp' => $row['especialidad'],
                'com' => $row['comentario'],
                'fecha' => $row['date'],
            ];
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Historia Clinica</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="bootstrap/node_modules\bootstrap\dist\css\bootstrap.min.css">
        <link rel="stylesheet" href="proyectoPP2/style.css">
        <link rel="stylesheet" href="styleLoginReg.css"> -->
    </head>
    <body class="sb-nav-fixed">
        <!-- Barra superior  -->  
        <?php require_once('../componentes/navbar.php'); ?>

        <div id="layoutSidenav">
            <!-- Barra lateral -->          
            <?php require_once('../componentes/sidebar.php'); ?>

            <!-- Historia Clinica -->
            <div id="layoutSidenav_content">
                <div class=" container-fluid px-4">
                    <!-- Falta que aparezca nombre y apellido de Paciente -->
                    <h2 class="mt-4"> Nombre: 
                    <?php
                        foreach ($datos2 as $datoPorColumna) { // o while
                            /* echo '<p><data value="'.$datoPorColumna['identificador'].'">'.$datoPorColumna['nombre']." ".$datoPorColumna['apell'].'</data></p>'; */
                        }
                    ?>
                    </h2>

                    <!-- 2 columnas: Datos personales -->
                    <div class="row">
                        <!-- Datos personales -->
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                            Datos personales - <?php 
                                                            $variableSinBarra = substr($variable,0,-1);
                                                            echo 'id '.$variableSinBarra;
                                                            ?> 
                                </div>
                                <?php
                                    foreach ($datos as $datoPorColumna) { // o while
                                        foreach ($datoPorColumna as $datito){
                                            echo '<p>'.$datito.'</p>';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Comentarios -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Comentarios
                        </div>
                        <?php
                            foreach ($datos2 as $datoPorColumna) { // o while
                                echo '<div class="border">';
                                    foreach ($datoPorColumna as $datito){
                                        echo '<p>'.$datito.'</p>';
                                    }
                                echo '</div>';
                            }
                        ?>
                    </div>

                    <!-- Footer -->
                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-1"><hr>
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Copyright &copy; Your Website 2021</div>
                                <div>
                                    <a href="#">Privacy Policy</a>
                                    &middot;
                                    <a href="#">Terms &amp; Conditions</a>
                                </div>
                            </div>
                        </div>
                    </footer>

                    </div>
                </main>
            </div>
        </div>
        
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script> -->
    </body>
</html>
