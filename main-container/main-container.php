<?php 
    session_start();
  
    if(!$_SESSION['id'])   header('location:index.php');
    
    $conexion = mysqli_connect("localhost", "root", "", "proyecto"); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Buscador</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="bootstrap/node_modules\bootstrap\dist\css\bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="styleLoginReg.css"> -->
        
    </head>
    <body class="sb-nav-fixed">
        <!-- Barra superior  -->
        <?php require_once('../componentes/navbar.php'); ?>

        <div id="layoutSidenav">
            <!-- Barra lateral -->   
            <?php require_once('../componentes/sidebar.php'); ?>

            <!-- Contenido de la página -->  
            <div id="layoutSidenav_content">
                <div class=" container-fluid px-4">
                    <h1 class="mt-3">Bienvenido <?php echo ucfirst($_SESSION['nombre']); ?></h1>

                <section id="search_clear">    
                    <!-- Tabla Pacientes por DNI -->
                    <?php 
                    if(isset($_POST['dniPaciente'])) {
                        $dni = $_POST['dniPaciente'];
                        $encontrarUser = "SELECT * FROM pacientes WHERE dni ='$dni'";
                        $result1 = mysqli_query($conexion, $encontrarUser) or die("Problemas en el select: ".mysqli_error($conexion));

                        if (isset($dni)){
                            while ($dato=mysqli_fetch_array($result1)) { 
                                echo 
                                    '<table border="0" cellspacing="2" cellpadding="2" class="table table-light"> 
                                        <tr> 
                                            <td> <font face="Arial">Nombre</font> </td> 
                                            <td> <font face="Arial">Apellido</font> </td> 
                                            <td> <font face="Arial">DNI</font> </td> 
                                            <td> <font face="Arial">Fecha de Nacimiento</font> </td> 
                                            <td> <font face="Arial">Sexo</font> </td> 
                                            <td> <font face="Arial">Historia clinica</font> </td> 
                                            <td> <font face="Arial">Cobertura</font> </td> 
                                            <td> <font face="Arial">Telefono</font> </td> 
                                            <td> <font face="Arial">Direccion</font> </td> 
                                        </tr>
                                        <tr>
                                            <td>'.$dato["nombre"].'</td> 
                                            <td>'.$dato["apellido"].'</td> 
                                            <td>'.$dato["dni"].'</td> 
                                            <td>'.$dato["fecha_nac"].'</td> 
                                            <td>'.$dato["sexo"].'</td> 
                                            <td><form action="../historia_clinica/historia_clinica.php" method="post">
                                                <input type="hidden" name="id" value='.$dato["id"].'/>
                                                <input type="submit" value="Info"/>
                                                </form></td>                         
                                            <td>Cobertura</td> 
                                            <td>'.$dato["tel"].'</td> 
                                            <td>'.$dato["direccion"].'</td>
                                        </tr>
                                        </table>';
                                        
                                    }   
                        $result1->free();
                        } 
                    } 
                    ?>
                </section>

                <!-- Formulario Modal: Agregar Paciente -->
                <nav id="add__container">
                    <div class="add__div">
                        <div class="add__item">
                            <p class="add__title" id="home-page">Página principal</p>
                            <div id="add">
                                <form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" id="agregarPaciente_Form">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="" name="surname">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">DNI</label>
                                        <input type="number" class="form-control" name="newDNI">
                                    </div>
                                    <div class="mb-3">
                                        <label class="control-label" for="date">Fecha de Nacimiento</label>
                                        <input type="text" class="form-control" id="date" name="date" placeholder="Seleccionar fecha">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sexo</label>
                                        <input type="text" class="form-control" name="newGender">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Telefono</label>
                                        <input type="text" class="form-control" name="newTel">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Direccion</label>
                                        <input type="text" class="form-control" name="newAddress">
                                    </div>
                                    <button type="submit" id="submit" class="btn btn-primary" name="submit" value="Submit" onclick="sendPaciente()">Agregar</button>  
                                </form>    
                            </div>
                        </div>
                    </div>
                </nav>

                
                <!-- Javascript para el Modal -->
                <script>
                    const botonAgregar = document.querySelector('#agregarPaciente');
                    const agregarDiv = document.querySelector('.add__div');
                    const modalAparece = () => {
                        agregarDiv.classList.toggle('active');
                    }
                    botonAgregar.addEventListener('click', modalAparece);
                </script>

                <!-- Insertar datos del Form a MySQL -->
                <?php  
                if(isset($_POST['name'])) { 
                    $fname = $_POST['name'];
                    $nAp = $_POST['surname'];
                    $nD = $_POST['newDNI'];
                    $ndate = $_POST['date'];
                    $nnewGender = $_POST['newGender'];
                    $nnewTel = $_POST['newTel'];
                    $nnewAddress = $_POST['newAddress'];

                    $sql = "INSERT INTO pacientes (nombre, apellido, dni, fecha_nac, sexo, tel, direccion) VALUES ('".$fname."', '".$nAp."', '".$nD."', '".$ndate."', '".$nnewGender."', '".$nnewTel."', '".$nnewAddress."')";

                    $results = $conexion->query($sql); 
                } 
                mysqli_close($conexion);   
                ?>      

                <br/><br/>
                <!-- Tabla nombres random -->
                <!-- <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                    </tr>
                                    <tr>
                                        <td>Cedric Kelly</td>
                                        <td>Senior Javascript Developer</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2012/03/29</td>
                                        <td>$433,060</td>
                                    </tr>
                                    <tr>
                                        <td>Herrod Chandler</td>
                                        <td>Sales Assistant</td>
                                        <td>San Francisco</td>
                                        <td>59</td>
                                        <td>2012/08/06</td>
                                        <td>$137,500</td>
                                    </tr>
                                    <tr>
                                        <td>Rhona Davidson</td>
                                        <td>Integration Specialist</td>
                                        <td>Tokyo</td>
                                        <td>55</td>
                                        <td>2010/10/14</td>
                                        <td>$327,900</td>
                                    </tr>
                                    <tr>
                                        <td>Colleen Hurst</td>
                                        <td>Javascript Developer</td>
                                        <td>San Francisco</td>
                                        <td>39</td>
                                        <td>2009/09/15</td>
                                        <td>$205,500</td>
                                    </tr>
                                    <tr>
                                        <td>Sonya Frost</td>
                                        <td>Software Engineer</td>
                                        <td>Edinburgh</td>
                                        <td>23</td>
                                        <td>2008/12/13</td>
                                        <td>$103,600</td>
                                    </tr>
                                    <tr>
                                        <td>Jena Gaines</td>
                                        <td>Office Manager</td>
                                        <td>London</td>
                                        <td>30</td>
                                        <td>2008/12/19</td>
                                        <td>$90,560</td>
                                    </tr>
                                    <tr>
                                        <td>Quinn Flynn</td>
                                        <td>Support Lead</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2013/03/03</td>
                                        <td>$342,000</td>
                                    </tr>
                                    <tr>
                                        <td>Charde Marshall</td>
                                        <td>Regional Director</td>
                                        <td>San Francisco</td>
                                        <td>36</td>
                                        <td>2008/10/16</td>
                                        <td>$470,600</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->

                <!-- Footer  -->              
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
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

                <!-- Etiquetas finales -->
                </div>
            </div>


            <!-- date picker -->
            <script type="text/javascript" src="node_modules\jquery\dist\jquery.min.js"></script> 
            <script type="text/javascript" src="bootstrap\datepicker\bootstrap-datepicker.min.js"></script>
            <link rel="stylesheet" href="bootstrap\datepicker\bootstrap-datepicker3.css"/>
            <script>
                $(document).ready(function(){
                    var date_input=$('input[name="date"]'); //our date input has the name "date"
                    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                    date_input.datepicker({
                        format: 'yyyy-mm-dd',
                        container: container,
                        todayHighlight: true,
                        autoclose: true,
                    })
                })
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
            <script src="js/datatables-simple-demo.js"></script> -->
    </body>
</html>
