<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html>
<?php require_once("../MainHead/head.php");?>
    <title>Helpdesk::Nuevo Ticket</title>
</head>
<body class="with-side-menu">

	<?php require_once("../MainHeader/header.php");?>

	<div class="mobile-menu-left-overlay"></div>
	
	<?php require_once("../MainNav/nav.php");?>

	<div class="page-content">
		<div class="container-fluid">

			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Nuevo Ticket</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Nuevo Ticket</li>
							</ol>
						</div>
					</div>
				</div><!--.page-content-->
            </header>

            <div class="box-typical box-typical-padding">
				<p>
					Por favor ingrese la información para el inicio del caso.
				</p>

				<h5 class="m-t-lg with-border">Ingresar información</h5>

				<div class="row">
					<form method="post" id="ticket_form">

					<input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

					<div class="col-lg-6">
						<fieldset class="form-group">
							<label class="form-label semibold" for="div_id">División</label>
							<select id="div_id" name="div_id" class="form-control">	
							</select>
						</fieldset>
					</div>
					<div class="col-lg-6">
						<fieldset class="form-group">
							<label class="form-label semibold" for="id_nov">Novedad</label>
							<select id="id_nov" name="id_nov" class="form-control">
							</select>
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label semibold" for="tick_descripcion">Descripción</label>
							<div class="summernote-theme-1">
								<textarea id="tick_descrip" name="tick_descripcion" class="summernote"></textarea>
							</div>
						</fieldset>
					</div>
					<div class="col-lg-12">
						<button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Guardar</button>
					</div>
</form>	
				</div><!--.row-->
               
            </div>
        </div>
    </div>
	<?php require_once("../MainJs/js.php");?>
	<script type="text/javascript" src="nuevoticket.js"></script>
</body>
</html>
<?php
}else{
	header("Location:".Conectar::ruta()."index.php");
}
?>