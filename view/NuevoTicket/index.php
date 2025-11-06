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

                <form>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Text</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Text Disabled</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" disabled class="form-control" id="inputPassword" placeholder="Text Disabled"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Text Readonly</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" readonly class="form-control" id="inputPassword" placeholder="Text Readonly"></p>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 form-control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="inputPassword" placeholder="Password">
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label">Select</label>
						<div class="col-sm-10">
							<select id="exampleSelect" class="form-control">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleSelect2" class="col-sm-2 form-control-label">Multiple select</label>
						<div class="col-sm-10">
							<select multiple class="form-control" id="exampleSelect2">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label">Textarea</label>
						<div class="col-sm-10">
							<textarea rows="4" class="form-control" placeholder="Textarea"></textarea>
						</div>
					</div>
				</form>
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