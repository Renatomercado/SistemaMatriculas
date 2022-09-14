<?php require_once 'admin/db_con.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Matrícula de Estudiantes</title>
    
  </head>
  <style>
body {
  background-color: #7FFFD4;
}
</style>
<body>
    
    <div class="container"><br>
      <a class="btn btn-secondary float-right" href="admin/login.php">Acceso Administrativos</a>
          <h1 class="text-star">Sistema de Matrícula DAEM Limache</h1><br>

          

          <div class="row">
            <div class="col-md-5 offset-md-2">
              <form method="POST">
            <table class=" table-secondary text-star infotable">
              <tr>
                <th colspan="2">
                  <p class="text-star">Información del Alumno</p>
                </th>
              </tr>
              <tr>
                <td>
                   <p>Selecciona el Curso</p>
                </td>
                <td>
                   <select class="form-control" name="choose">
                     <option value="">
                       Selecciona
                     </option>
                     <option value="Primero">
                       1° Basico
                     </option>
                     <option value="Segundo">
                       2° Basico
                     </option>
                     <option value="Tercero">
                       3° Basico
                     </option>
                     <option value="Cuarto">
                       4° Basico
                     </option>
                     <option value="Quinto">
                       5° Basico
                     </option>
                     <option value="Quinto">
                       6° Basico
                     </option>
                     <option value="Quinto">
                       7° Basico
                     </option>
                     <option value="Quinto">
                       8° Basico
                     </option>
                   </select>
                </td>
              </tr>
              
              <tr>
                <td>
                  <p><label for="roll">Número Matricula</label></p>
                </td>
                <td>
                  <input class="form-control" type="text" pattern="[0-9]{6}" id="roll" placeholder="6 dígitos" name="roll">
                </td>
              </tr>
              <tr>
                <td colspan="2" class="text-center">
                  <input class="btn btn-danger" type="submit" name="showinfo">
                </td>
              </tr>
            </table>
          </form>
            </div>
          </div>
        <br>
        <?php if (isset($_POST['showinfo'])) {
          $choose= $_POST['choose'];
          $roll = $_POST['roll'];
          if (!empty($choose && $roll)) {
            $query = mysqli_query($db_con,"SELECT * FROM `student_info` WHERE `roll`='$roll' AND `class`='$choose'");
            if (!empty($row=mysqli_fetch_array($query))) {
              if ($row['roll']==$roll && $choose==$row['class']) {
                $stroll= $row['roll'];
                $stname= $row['name'];
                $stclass= $row['class'];
                $city= $row['city'];
                $photo= $row['photo'];
                $pcontact= $row['pcontact'];
              ?>
        <div class="row">
          <div class="col-sm-7 offset-sm-3">
            <table class="table-primary table-bordered border-dark">
              <tr>
                <td rowspan="5"><h3>Información del Alumno</h3><img class="img-thumbnail" src="admin/images/<?= isset($photo)?$photo:'';?>" width="250px"></td>
                <td>Nombre</td>
                <td><?= isset($stname)?$stname:'';?></td>
              </tr>
              <tr>
                <td>Número de Matrícula</td>
                <td><?= isset($stroll)?$stroll:'';?></td>
              </tr>
              <tr>
                <td>Curso</td>
                <td><?= isset($stclass)?$stclass:'';?></td>
              </tr>
              <tr>
                <td>Dirección</td>
                <td><?= isset($city)?$city:'';?> <a button type="button" class="btn btn-success" href="https://app-maparenato.web.app/"target="_blank">Ver Mapa</button></a></td>
                  
              </tr>
              <tr>
                <td>Celular</td>
                <td><?= isset($pcontact)?$pcontact:'';?></td>
              </tr>
            </table>
          </div>
        </div>  
      <?php 
          }else{
                echo '<p style="color:red;">Por favor ingrese un número válido de matricula y curso</p>';
              }
            }else{
              echo '<p style="color:red;">Informacion Erronea</p>';
            }
            }else{?>
              <script type="text/javascript">alert("Alumno no encontrado");</script>
            <?php }
          }; ?>
    </div>
    <a href="https://www.limache.cl" target="_blank">
    <img src="https://consultamunicipal.cl/logos_muni/logo_limache.png"
    width="250" height="200"
    alt="80"/>

    <a href="https://www.demlimache.cl/"target="_blank">
    <img src="https://pbs.twimg.com/profile_images/705752968289718272/mSTlj1MV_400x400.jpg"
    width="250" height="200"
    alt="80"/>

    <a href="https://www.facebook.com/Seguridad-P%C3%BAblica-e-Inspecci%C3%B3n-Municipalidad-de-Limache-456271861216730/"target="_blank">
    <img src="data:image/jpeg;base64,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"
    width="250" height="200"
    alt="80"/>

    <a href="https://www.facebook.com/oficinamujerlimache/"target="_blank">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfRy83hEy95AGsgno6NaAFPFX-mts6yis17Q&usqp=CAU"
    width="250" height="200"
    alt="80"/>

    <a href="https://www.facebook.com/hospitaldelimache/"target="_blank">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUv26XdI9Zo0CZfJrh-6-rrPHC2n_jr2cboA&usqp=CAU"
    width="250" height="200"
    alt="80"/>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>