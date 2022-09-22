<link rel="stylesheet" href="../componentes/css/sidebar.css">

<!-- Barra lateral -->  
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">                           
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="myForm" class="mx-3">
                    <label class="my-3">DNI paciente: </label>
                    <div class="input-group bg-light buscar" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" placeholder="Search" type="number" name="dniPaciente">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-grid gap-3 d-md-block mt-3">
                        <button class="col-5" type="submit" name="submit" value="Buscar">Buscar</button>
                        <button class="col-5" type="submit" name="clear" value="clear" onclick="myFunction()" id="clear">Borrar</button>
                    </div>
                </form>                            
                <div class="sb-sidenav-menu-heading">Acciones</div>
                <button type="button" name="agregar" value="agregar" id="agregarPaciente">Agregar Paciente</button>
            </div>
        </div>
    </nav>
</div>

<!-- Buscar - Borrar -->
<script>
document.getElementById("clear").onclick = function(){
    document.getElementById("myForm").reset();
};

let add = document.getElementById("agregarPaciente");
function cambiar() {
    document.getElementById("agregarPaciente_Form").setAttribute("method", "POST");
}
add.onclick = cambiar; 
</script>

<script> /* Para q no se envien datos vacios a MySQL */
    document.getElementById("submit").onclick = function() {
        document.getElementById("agregarPaciente_Form").removeAttribute("method");
    }; 
</script>