<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }
    
    $id = base64_decode($_GET['id']);
    $oldPhoto = base64_decode($_GET['photo']);

  if (isset($_POST['updatestudent'])) {
  	$name = $_POST['name'];
	$apellido = $_POST['apellido'];
  	$roll = $_POST['roll'];
  	$address = $_POST['address'];
  	$pcontact = $_POST['pcontact'];
  	$class = $_POST['class'];
	$apellido = $_POST['apellido'];
	$nombre_apoderado = $_POST['nombre_apoderado'];
	$apellido_apoderado = $_POST['apellido_apoderado'];
	$apellidomaterno = $_POST['apellidomaterno'];
	$alergia = $_POST['alergia'];
	$emergencia = $_POST['emergencia'];
	$correo = $_POST['correo'];

  	
  	if (!empty($_FILES['photo']['name'])) {
  		 $photo = $_FILES['photo']['name'];
	  	 $photo = explode('.', $photo);
		 $photo = end($photo); 
		 $photo = $roll.date('Y-m-d-m-s').'.'.$photo;
  	}else{
  		$photo = $oldPhoto;
  	}
  	

  	$query = "UPDATE `student_info` SET `name`='$name',`apellido`='$apellido',`roll`='$roll',`class`='$class',`city`='$address',`pcontact`='$pcontact',`photo`='$photo', `nombre_apoderado`='$nombre_apoderado', `apellido_apoderado`='$apellido_apoderado', `apellidomaterno`='$apellidomaterno' , `alergia`='$alergia' , `emergencia`='$emergencia' , `correo`='$correo'  WHERE `id`= $id";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Student Updated!</p>';
		if (!empty($_FILES['photo']['name'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
			unlink('images/'.$oldPhoto);
		}	
  		
  	}else{
  		header('Location: index.php?page=all-student&edit=error');
  	}
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Editar Información de Estudiante<small class="text-warning"> Editar</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="index.php?page=all-student">Todos los Estudiantes </a></li>
     <li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
  </ol>
</nav>

	<?php
		if (isset($id)) {
			$query = "SELECT `id`, `name` , `roll`, `class`, `city`, `pcontact`, `photo`, `datetime`, `apellido` , `nombre_apoderado`, `apellido_apoderado` , `apellidomaterno` , `alergia`, `emergencia`, `correo`  FROM `student_info` WHERE `id`=$id";
			$result = mysqli_query($db_con,$query);
			$row = mysqli_fetch_array($result);
		}
	 ?>
<div class="row">
<div class="col-sm-6">
	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
		    <label for="name">Nombre de Estudiante</label>
		    <input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
	  	</div>
		<div class="form-group">
		    <label for="apellido">Apellido Paterno del Alumno</label>
		    <input name="apellido" type="text" class="form-control" id="apellido" value="<?php echo $row['apellido']; ?>" required="">
	  	</div>
		<div class="form-group">
		    <label for="apellidomaterno">Apellido Materno del Alumno</label>
		    <input name="apellidomaterno" type="text" class="form-control" id="apellidomaterno" value="<?php echo $row['apellidomaterno']; ?>" required="">
	  	</div>		
	  	<div class="form-group">
		    <label for="roll">Número de Matrícula</label>
		    <input name="roll" type="text" class="form-control" pattern="[0-9]{6}" id="roll" value="<?php echo $row['roll']; ?>" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="address">Dirección de Estudiante</label>
		    <input name="address" type="text" class="form-control" id="address" value="<?php echo $row['city']; ?>" required="">
	  	</div>
		<div class="form-group">
		    <label for="nombre_apoderado">Nombre del Apoderado</label>
		    <input name="nombre_apoderado" type="text" class="form-control" id="nombre_apoderado" value="<?php echo $row['nombre_apoderado']; ?>" required="">
	  	</div>
		<div class="form-group">
		    <label for="apellido_apoderado">Apellido del Apoderado</label>
		    <input name="apellido_apoderado" type="text" class="form-control" id="apellido_apoderado" value="<?php echo $row['apellido_apoderado']; ?>" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="pcontact">Número de Contacto</label>
		    <input name="pcontact" type="text" class="form-control" id="pcontact" value="<?php echo $row['pcontact']; ?>" pattern="[0-9]{8}" placeholder="+57..." required="">
	  	</div>
	  	<div class="form-group">
		    <label for="class">Curso</label>
		    <select name="class" class="form-control" id="class" required="" value="">
		    	<option>Select</option>
		    	<option value="Primero" <?= $row['class']=='Primero'? 'selected':'' ?>>Primero</option>
		    	<option value="Segundo" <?= $row['class']=='Segundo'? 'selected':'' ?>>Segundo</option>
		    	<option value="Tercero" <?= $row['class']=='Tercero'? 'selected':'' ?>>Tercero</option>
		    	<option value="Cuarto" <?= $row['class']=='Cuarto'? 'selected':'' ?>>Cuarto</option>
		    	<option value="Quinto" <?= $row['class']=='Quinto'? 'selected':'' ?>>Quinto</option>
				<option value="Quinto" <?= $row['class']=='Sexto'? 'selected':'' ?>>Sexto</option>
				<option value="Quinto" <?= $row['class']=='Septimo'? 'selected':'' ?>>Septimo</option>
				<option value="Quinto" <?= $row['class']=='Octavo'? 'selected':'' ?>>Octavo</option>
		    </select>
	  	</div>
		  <div class="form-group">
		    <label for="alergia"> Alergias del Alumno</label>
		    <input name="alergia" type="text" class="form-control" id="alergia" value="<?php echo $row['alergia']; ?>" required="">
	  	</div>
		  <div class="form-group">
		    <label for="emergencia">Número de Emergencia</label>
		    <input name="emergencia" type="text" class="form-control" id="emergencia" value="<?php echo $row['emergencia']; ?>" pattern="[0-9]{8}" placeholder="+56" required="">
	  	</div>
		  <div class="form-group">
		    <label for="correo"> Correo del Apoderado</label>
		    <input name="correo" type="text" class="form-control" id="correo" value="<?php echo $row['correo']; ?>" required="">
	  	</div>
		
	  	<div class="form-group">
		    <label for="photo">Fotografía</label>
		    <input name="photo" type="file" class="form-control" id="photo">
	  	</div>
	  	<div class="form-group text-center">
		    <input name="updatestudent" value="Editar Estudiante" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>