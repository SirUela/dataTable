<?php 
	session_start();

	$dataTable = array(); 

    $estearchivo = $_SERVER['PHP_SELF'];

	if(!isset ($_SESSION["myArray"]) ) {
	    $_SESSION["myArray"] = array(['id_cliente' => 'id_cliente', 'nombre' => 'nombre1']);
	    
	}

	$dataTable = $_SESSION["myArray"];
	
	if (isset($_POST['btn_borrar']))
	{
		array_splice($dataTable, $_POST['btn_borrar'], 1);
		$_SESSION["myArray"] = $dataTable;
			
	}

	if (isset($_POST['btn_editar2']))
	{
		
		$nuevaFila2 = ['id_cliente' => $_POST['id_cliente2'], 'nombre' => $_POST['nombre2']];

		$dataTable[$_POST['indice']]['id_cliente'] = $nuevaFila2['id_cliente'];
		$dataTable[$_POST['indice']]['nombre'] = $nuevaFila2['nombre'];
		
		$_SESSION["myArray"] = $dataTable;
	}

	if (isset($_POST['btn_guardar']))
	{ 
	    $nuevaFila = ['id_cliente' => $_POST['id_cliente'], 'nombre' => $_POST['nombre1']];
	    array_push($dataTable, $nuevaFila);

	    $_SESSION["myArray"] = $dataTable;
	    unset($_POST);
	}

	
	
?>

<html lang="ES">
	<head>
		<title>Ejemplo con isset</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="img/img1.png">
		<link href="css/sb-admin-2.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/14fb03f716.js" crossorigin="anonymous"></script>

		<script type="text/javascript">
			function validaNumericos(event) {

			    if(event.charCode >= 48 && event.charCode <= 57){
			      return true;
			    }else{
			    	return false;        
			    }

			}
		</script>
		
	</head>

	<body >


		<nav class="navbar bg-success text-white">
			<h4>Data Table</h4>
			<a href="logout.php" class="btn btn-light">Reiniciar</a>
			<a class="btn btn-light" href="<?php echo $estearchivo;?>?action=new">New Client +</a>
		</nav>

		<div class="container mt-5">
				<div class="row">                 
                    <div class="col-12 text-center">
                        <h3 class="text-success">Data table</h3>
                        <table class="table table-striped shadow rounded">
							<thead class="thead-dark">
								<tr>
									<th>#</th>
									<th>ID</th>
									<th>Full Name</th>
									<th>Delete</th>
									<th>Edit</th>
								</tr>
							</thead>
							
								<?php foreach ($dataTable as $indice => $valor){
												
												if ($valor == $valor['id_cliente']) {
													echo "error";
												}else{
									?>
													<tr>
														<td style="vertical-align: middle; font-size:20px;"><?php echo $indice; ?></td>
														<td style="vertical-align: middle; font-size:20px;"><?php echo $valor['id_cliente']; ?></td>
														<td style="vertical-align: middle; font-size:20px;"><?php echo $valor['nombre']; ?></td>
														<td> 
															<form name="borrar" method="post">
																<button name="btn_borrar" value="<?php echo $indice; ?>" class="btn">
																	<i class="fas fa-user-minus text-danger mt-2"></i>
																</button>
															</form>
														</td>
														<td>
															<form name="actualizar" method="post" action="<?php echo $estearchivo;?>">
																<button name="btn_editar" value="<?php echo $indice; ?>" class="btn">
																	<i class="fas fa-user-edit text-success mt-2"></i>
																	<input type="hidden" name="valor" value="<?php echo $valor; ?>" />
																</button>
															</form>
														</td>
													</tr>
													<?php
												}
								}?>
															
						</table>
                    </div>
					
                    <?php if(isset($_GET['action']) and $_GET['action'] == 'new') { ?>	
						<div class="col-12">
							<div class="card shadow mt-5">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-success">New Client</h6>
								</div>
								<div class="card-body">
									<div class="chart-area" style="height: 100%">
										<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
											<input type="text" name="id_cliente" required class="form-control" placeholder="Id" onkeypress='return validaNumericos(event)'/>
											<input type="text" name="nombre1" required class="form-control mt-3 mb-3" placeholder="Full Name"/>
											<button name="btn_guardar" class="btn btn-lg btn-outline-success">SAVE</button>
										</form>
									</div>
								</div>
							</div>
						</div>						
                    <?php } ?>

                    <?php if(isset($_POST['btn_editar']) ) { 
						$valor_recibido = $_POST["valor"];
                    ?>
                    <div class="col-12">
                        <?php 
                        echo "El indice a editar es ".$_POST['btn_editar'];?>
                        <div class="card shadow mt-5">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-success">Edit Client</h6>
								</div>
								<div class="card-body">
									<div class="chart-area" style="height: 100%">
										<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
											<input type="text" name="id_cliente2" required class="form-control" placeholder="Id" onkeypress='return validaNumericos(event)'/>
											<input type="text" name="nombre2" required class="form-control mt-3 mb-3" placeholder="Full Name"/>
											<?php 
											echo '<input type="hidden" name="indice" value="'.$_POST['btn_editar'].'">'; ?>
											<button name="btn_editar2" class="btn btn-lg btn-outline-success">EDIT</button>			
										</form>
									</div>
								</div>
							</div>
                       
					</div>
					
                    <?php } ?>

                </div>
		</div>
      
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>
