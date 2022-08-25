<?php require_once 'db_con.php'; 
	session_start();
	if (isset($_POST['register'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$c_password = $_POST['c_password'];

		$photo = explode('.', $_FILES['photo']['name']);
		$photo= end($photo);
		$photo_name= $username.'.'.$photo;

		$input_error = array();
		if (empty($name)) {
			$input_error['name'] = "Es necesario diligenciar el campo de Nombre";
		}
		if (empty($email)) {
			$input_error['email'] = "Es necesario diligencia el campo de Correo";
		}
		if (empty($username)) {
			$input_error['username'] = "Debes diligenciar el campo de usuario";
		}
		if (empty($password)) {
			$input_error['password'] = "Debes diligenciar el campo de contraseña";
		}
		if (empty($photo)) {
			$input_error['photo'] = "La fotografía es un campo requerido";
		}

		if (!empty($password)) {
			if ($c_password!==$password) {
				$input_error['notmatch']="Has ingresado mal la contraseña!";
			}
		}

		if (count($input_error)==0) {
			$check_email= mysqli_query($db_con,"SELECT * FROM `users` WHERE `email`='$email';");

			if (mysqli_num_rows($check_email)==0) {
				$check_username= mysqli_query($db_con,"SELECT * FROM `users` WHERE `username`='$username';");
				if (mysqli_num_rows($check_username)==0) {
					if (strlen($username)>7) {
						if (strlen($password)>7) {
								$password = sha1(md5($password));
							$query = "INSERT INTO `users`(`name`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name', '$email', '$username', '$password','$photo_name','inactivo');";
									$result = mysqli_query($db_con,$query);
								if ($result) {
									move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo_name);
									header('Location: register.php?insert=sucess');
								}else{
									header('Location: register.php?insert=error');
								}
						}else{
							$passlan="Esta contraseña debe contener al menos 8 caracteres";
						}
					}else{
						$usernamelan= 'Este nombre de usuario debe contener al menos 8 caracteres';
					}
				}else{
					$username_error="Este usuario ya fue utilizado, intenta con uno diferente";
				}
			}else{
				$email_error= "El correo existe actualmente";
			}
			
		}
		
	}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Registro de Usuarios</title>
  </head>
  <body>
  <nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://golpenoticias.cl/wp/wp-content/uploads/2016/12/logo.png" alt="" width="376" height="168" class="d-inline-block align-text-top">
      
    </a>
  </div>
</nav>
    <div class="container"><br>
          <h1 class="text-center">Registro de personal Autorizado</h1><hr><br>
          <div class="d-flex justify-content-center">
          	<?php 
          		if (isset($_GET['insert'])) {
          			if($_GET['insert']=='sucess'){ echo '<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-success fade hide" data-delay="2000">Tus datos han sido ingresados exitósamente</div>';}
          		}
          	;?>
          </div>
		  
          <div class="row animate__animated animate__pulse">
            <div class="col-md-8 offset-md-2">
             	<form method="POST" enctype="multipart/form-data">
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control" value="<?= isset($name)? $name:'' ?>" name="name" placeholder="Nombre" id="inputEmail3"><?= isset($input_error['name'])? '<label for="inputEmail3" class="error">'.$input_error['name'].'</label>':'';  ?>
				    </div>
				    <div class="col-sm-6">
				      <input type="email" class="form-control" value="<?= isset($email)? $email:'' ?>" name="email" placeholder="Correo" id="inputEmail3"><?= isset($input_error['email'])? '<label class="error">'.$input_error['email'].'</label>':'';  ?>
				      <?= isset($email_error)? '<label class="error">'.$email_error.'</label>':'';  ?>
				    </div>
				  </div>
				  <div class="form-group row">
				  	<div class="col-sm-4">
				      <input type="text" name="username" value="<?= isset($username)? $username:'' ?>" class="form-control" id="inputPassword3" placeholder="Usuario"><?= isset($input_error['usrname'])? '<label class="error">'.$input_error['username'].'</label>':'';  ?><?= isset($username_error)? '<label class="error">'.$username_error.'</label>':'';  ?><?= isset($usernamelan)? '<label class="error">'.$usernamelan.'</label>':'';  ?>
				    </div>
				    <div class="col-sm-4">
				      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Contraseña"><?= isset($input_error['password'])? '<label class="error">'.$input_error['password'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>  
				    </div>
				    <div class="col-sm-4">
				      <input type="password" name="c_password" class="form-control" id="inputPassword3" placeholder="Confirmar Contraseña"><?= isset($input_error['notmatch'])? '<label class="error">'.$input_error['notmatch'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>
				    </div>
				  </div>
				  <div class="row">
				  	<div class="col-sm-3"><label for="photo">Sube tu foto</label></div>
				  	<div class="col-sm-9">
				      <input type="file" id="photo" name="photo" class="form-control" id="inputPassword3" >
				      <br>
				    </div>
				  </div>
				  <div class="text-center">
				      <button type="submit" name="register" class="btn btn-success">Registrar</button>
				    </div>
				  </div>
				</form>
            </div>
          </div>
              <p>Si ya tienes cuenta <a href="login.php">Pincha Aquí</a></p>
    </div>
		<br><br><br><br><br><br>		  
    	<h2>Visite nuestro Sitio web <a href="https://www.demlimache.cl">DAEM LIMACHE</a></h2>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$('.toast').toast('show')
    </script>
  </body>
</html>