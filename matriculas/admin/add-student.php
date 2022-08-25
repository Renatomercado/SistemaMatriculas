<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }

  if (isset($_POST['addstudent'])) {
  	$name = $_POST['name'];
  	$roll = $_POST['roll'];
  	$address = $_POST['address'];
  	$pcontact = $_POST['pcontact'];
  	$class = $_POST['class'];
	$apellido = $_POST['apellido'];
	$nombre_apoderado = $_POST['nombre_apoderado'];
	$apellido_apoderado = $_POST['apellido_apoderado'];
	$apellidomaterno = $_POST['apellidomaterno'];
  	
  	$photo = explode('.', $_FILES['photo']['name']);
  	$photo = end($photo); 
  	$photo = $roll.date('Y-m-d-m-s').'.'.$photo;

  	$query = "INSERT INTO `student_info`(`name`, `roll`, `class`, `city`, `pcontact`, `photo`, `apellido` , `nombre_apoderado`, `apellido_apoderado` , `apellidomaterno`) VALUES ('$name', '$roll', '$class', '$address', '$pcontact','$photo', '$apellido', '$nombre_apoderado', '$apellido_apoderado', '$apellidomaterno');";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
  		move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
  	}else{
  		$datainsert['inserterror']= '<p style="color: red;">Estudiante no ingresado, revise la información diligenciada.</p>';
  	}
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Agregar Alumno<small class="text-warning"> Nuevo Alumno</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Volver a inicio </a></li>
     <li class="breadcrumb-item active" aria-current="page"></li>
  </ol>
</nav>

<div class="row">
	
<div class="col-sm-6">
		<?php if (isset($datainsert)) {?>
	<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
	  <div class="toast-header">
	    <strong class="mr-auto">Student Insert Alert</strong>
	    <small><?php echo date('d-M-Y'); ?></small>
	    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="toast-body">
	    <?php 
	    	if (isset($datainsert['insertsucess'])) {
	    		echo $datainsert['insertsucess'];
	    	}
	    	if (isset($datainsert['inserterror'])) {
	    		echo $datainsert['inserterror'];
	    	}
	    ?>
	  </div>
	</div>
		<?php } ?>
	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
		    <label for="name">Nombre Alumno</label>
		    <input name="name" type="text" class="form-control" id="name" value="<?= isset($name)? $name: '' ; ?>" required="">
	  	</div>
		  <div class="form-group">
		    <label for="apellido">Apellido Paterno Alumno</label>
		    <input name="apellido" type="text" class="form-control" id="apellido" value="<?= isset($apellido)? $apellido: '' ; ?>" required="">
	  	</div> 
		  <div class="form-group">
		    <label for="apellidomaterno">Apellido Materno del Alumno</label>
		    <input name="apellidomaterno" type="text" class="form-control" id="apellidomaterno" value="<?= isset($apellidomaterno)? $apellidomaterno: '' ; ?>" required="">
	  	</div>   
	  	<div class="form-group">
		    <label for="roll">Numero Matricula</label>
		    <input name="roll" type="text" value="<?= isset($roll)? $roll: '' ; ?>" class="form-control" pattern="[0-9]{6}" id="roll" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="address">Dirección</label>
		    <input name="address" type="text" value="<?= isset($address)? $address: '' ; ?>" class="form-control" id="address" required="">
	  	</div>
		  <div class="form-group">
		    <label for="nombre_apoderado">Nombre Apoderado</label>
		    <input name="nombre_apoderado" type="text" value="<?= isset($nombre_apoderado)? $nombre_apoderado: '' ; ?>" class="form-control" id="nombre_apoderado" required="">
	  	</div>
		  <div class="form-group">
		    <label for="apellido_apoderado">Apellido Apoderado</label>
		    <input name="apellido_apoderado" type="text" value="<?= isset($apellido_apoderado)? $apellido_apoderado: '' ; ?>" class="form-control" id="apellido_apoderado" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="pcontact">	Celular</label>
		    <input name="pcontact" type="text" class="form-control" id="pcontact" pattern="[0-9]{8}" value="<?= isset($pcontact)? $pcontact: '' ; ?>" placeholder="+56" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="class">Curso</label>
		    <select name="class" class="form-control" id="class" required="">
		    	<option>Selecciona</option>
		    	<option value="Primero">Primero</option>
		    	<option value="Segundo">Segundo</option>
		    	<option value="Tercero">Tercero</option>
		    	<option value="Cuarto">Cuarto</option>
		    	<option value="Quinto">Quinto</option>
		    </select>
	  	</div>
	  	<div class="form-group">
		    <label for="photo">Fotografía de Estudiante</label>
		    <input name="photo" type="file" class="form-control" id="photo" required="">
	  	</div>
	  	<div class="form-group text-center">
		    <input name="addstudent" value="Agregar Estudiante" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>