<?php require_once 'db_con.php'; 
session_start();
if(isset($_SESSION['user_login'])){
	header('Location: index.php');
}
	if (isset($_POST['login'])) {
		$username= $_POST['username'];
		$password= $_POST['password'];


		$input_arr = array();

		if (empty($username)) {
			$input_arr['input_user_error']= "Username Is Required!";
		}

		if (empty($password)) {
			$input_arr['input_pass_error']= "Password Is Required!";
		}

		if(count($input_arr)==0){
			$query = "SELECT * FROM `users` WHERE `username` = '$username';";
			$result = mysqli_query($db_con, $query);
			if (mysqli_num_rows($result)==1) {
				$row = mysqli_fetch_assoc($result);
				if ($row['password']==sha1(md5($password))) {
					if ($row['status']=='activo') {
						$_SESSION['user_login']=$username;
						header('Location: index.php');
					}else{
						$status_inactive = "Su estado está inactivo";
					}
				}else{
					$worngpass= "Contraseña o Usurario Incorrectos!";	
				}
			}else{
				$usernameerr= "Nombre de usuario no existe";
			}
		}
		
	}


?>
<!doctype html>
<html lang="en">
  <head>
  <div class="alert alert-primary d-flex align-items-center" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
  <div>
    Acceso clientes administrativos
  </div>
</div>
</div>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Acceso administrativos</title>
  </head>
  <a href="https://www.demlimache.cl/"target="_blank">
    <img src="https://pbs.twimg.com/profile_images/705752968289718272/mSTlj1MV_400x400.jpg" class="float-start"
    width="250" height="200"
    alt="80"/>

    <a href="https://www.demlimache.cl/"target="_blank">
    <img src="https://pbs.twimg.com/profile_images/705752968289718272/mSTlj1MV_400x400.jpg" class ="float-end"
    width="250" height="200"
    alt="80"/>
	
</a>
  <body>
    <div class="container"><br>
          <h1 class="text-center bg-info">Acceso Administrativo</h1><br>
          
          	<?php if(isset($usernameerr)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $usernameerr; ?></div><?php };?>
          		<?php if(isset($worngpass)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $worngpass; ?></div><?php };?>
          		<?php if(isset($status_inactive)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $status_inactive; ?></div><?php };?>
          </div>
          <div class="row animate__animated animate__pulse">
            <div class="col-md-4 offset-md-4">
             	<form method="POST" action="">
				  <div class="form-group row">
				    <div class="col-sm-12">
				      <input type="text" class="form-control" name="username" value="<?= isset($username)? $username: ''; ?>" placeholder="Usuario" id="inputEmail3"> <?php echo isset($input_arr['input_user_error'])? '<label>'.$input_arr['input_user_error'].'</label>':''; ?>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12">
				      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Contraseña"><label><?php echo isset($input_arr['input_pass_error'])? '<label>'.$input_arr['input_pass_error'].'</label>':''; ?>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12">
				    <tr>
                <th colspan="2">

                </th>
              </tr>
              <tr>
                <td>
                   <p>Selecciona el Colegio</p>
                </td>
                <td>
                   <select class="form-control" name="choose">
                     <option value="">
                       Listado de Colegios
                     </option>
                     <option value="Primero">
                       Pasión de Jesús
                     </option>
                     <option value="Segundo">
                       Liceo De Limache
                     </option>
                     <option value="Tercero">
                       Escuela Limachito
                     </option>
                     <option value="Cuarto">
                       Escuela Mixta 88
                     </option>
                     <option value="Quinto">
                       Escuela los Maitenes
                     </option>
                     <option value="Quinto">
                       Teniente Merino
                     </option>
                     <option value="Quinto">
                       Colegio los Heroes 
                     </option>
                     <option value="Quinto">
                       Colegio Tabolango
                     </option>
                   </select>
                </td>
              </tr>
				    </div>
				  </div>

				  
				  <div class="text-center">
				      <button type="submit" name="login" class="btn btn-info">Ingresar</button>
				    </div>
				    <p>Si aún no tienes una cuenta de usuario, puedes <a href="register.php">Registrarte acá</a></p>
				  </div>
				</form>
            </div>
          </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript">
    	$('.toast').toast('show')

    </script>
    
    <footer class="et-l et-l--footer">
			<div class="et_builder_inner_content et_pb_gutters3"><div class="et_pb_section et_pb_section_0_tb_footer et_pb_with_background et_section_regular" >
				
				
				
				
					<div class="et_pb_row et_pb_row_0_tb_footer">
				<div class="et_pb_column et_pb_column_1_4 et_pb_column_0_tb_footer  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_image et_pb_image_0_tb_footer">
				
				
				<span class="et_pb_image_wrap "><img loading="lazy" width="150" height="150" src=" alt="" title="logo_contorno_150" srcset="https://consultamunicipal.cl/logos_muni/logo_limache.png 150w, https://consultamunicipal.cl/logos_muni/logo_limache.png 66w" sizes="(max-width: 150px) 100vw, 150px" class="wp-image-1774" /></span>
			</div>
			</div><div class="et_pb_column et_pb_column_1_4 et_pb_column_1_tb_footer  et_pb_css_mix_blend_mode_passthrough et_pb_column_empty">
				
				
				
			</div><div class="et_pb_column et_pb_column_1_4 et_pb_column_2_tb_footer  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_image et_pb_image_1_tb_footer">
				
				

				
				
				
				<div class="et_pb_blurb_content">
					<div class="et_pb_main_blurb_image"></div>
					<div class="et_pb_blurb_container">
						
						<div class="et_pb_blurb_description"><p>Palmira Romano Sur #340, Limache</p></div>
					</div>
				</div>
			</div><div class="et_pb_module et_pb_blurb et_pb_blurb_1_tb_footer  et_pb_text_align_left  et_pb_blurb_position_left et_pb_bg_layout_light">
				
				
				<div class="et_pb_blurb_content">
					<div class="fas fa-phone-volume"></div>
						<div class="et_pb_blurb_description"><p>Mesa central<br />33 2 297200</p></div>
				</div>
			</div>
			
				
				
			</div>
				
				
			</div>		</div>
	</footer>

  </body>
</html>