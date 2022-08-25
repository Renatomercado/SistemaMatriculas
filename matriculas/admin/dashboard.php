<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }
?>

<h1><a href="index.php"><i class="fas fa-chalkboard-teacher"></i>   Sistema de Matriculas</a> <small>Pasión de Jesús</small></h1>
<img src="https://convivenciactiva.cl/wp-content/uploads/2020/09/74f22149d4d0a3e902e5df836bce1cf3_M.jpg" class ="float-end"
    width="140" height="90"
    alt="80"/>

<hr>
<h3>Listado General de Alumnos</h3>



<table class="table  table-striped table-hover table-bordered" id="data">
  
  <thead class="thead-dark">
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Dirección</th>
      <th scope="col">Telefono</th>
      <th scope="col">Curso</th>
      
      
    </tr>
  </thead>

  <tbody>
    <?php 
      $query=mysqli_query($db_con,'SELECT * FROM `student_info` ORDER BY `student_info`.`datetime` DESC;');
      $i=1;
      while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php 
        echo '<td>'.$i.'</td>
          <td>'.ucwords($result['name']).'</td>
          <td>'.ucwords($result['apellido']).'</td>
          <td>'.ucwords($result['city']).'</td>
          <td>'.$result['pcontact'].'</td>*
          
          <td>'.$result['class'].'</td>
          '
          ;?>
        
      </tr>  

     <?php $i++;} ?>
     
    
  </tbody>
  
</table>
<input type=button value=Imprimir onclick= javascript:window.print() />


<input type=button value=descargar onclick="exportTableToExcel('data')">