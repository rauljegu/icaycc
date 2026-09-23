<?php include 'settings.php'; //include settings ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>EPPENS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="UNAM_FM_blanco.png" width="100%"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
          <?php include 'menu_movil.php'; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2><img src="UNAM_FM_blanco.png" width="100%"></h2>
      <ul class="nav nav-pills nav-stacked">
          <?php include 'menu_movil.php'; ?>
      </ul><br>
    </div>
    <br>

    <div class="col-sm-9">
      <div class="well">
          <div class="col-sm-9">
        <h4>Bienvenido  <?php $ufunc->UserName(); //Show name who is in session user?></h4>
        <p></p>
          </div>
          <div class="col-sm-2">
        <h4>Administrador</h4>
        <p></p>
          </div>
      </div>
      <div align="right">

      </div>
    </div>

  </div>
</div>
<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Ingresar personal</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
     <label>Ingrese nombre de personal</label>
     <input type="text" name="nombres" id="name" class="form-control" />
     <br />
     <label>Direccion del personal</label>
     <textarea name="direccion" id="address" class="form-control"></textarea>
     <br />
     <label>Selecione genero</label>
     <select name="genero" id="gender" class="form-control">
      <option value="Hombre">Hombre</option>
      <option value="Mujer">Mujer</option>
     </select>
     <br />
     <label>Designado</label>
     <input type="text" name="designado" id="designation" class="form-control" />
     <br />
     <label>Edad</label>
     <input type="text" name="edad" id="age" class="form-control" />
     <br />
     <input type="submit" name="insert" id="insert" value="Ingresar personal" class="btn btn-success" />

    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
   </div>
  </div>
 </div>
</div>
<script>
$(document).ready(function(){
 $('#insert_form').on("submit", function(event){
  event.preventDefault();
  if($('#name').val() == "")
  {
   alert("Name is required");
  }
  else if($('#address').val() == '')
  {
   alert("Address is required");
  }
  else if($('#designation').val() == '')
  {
   alert("Designation is required");
  }

  else
  {
   $.ajax({
    url:"insertar.php",
    method:"POST",
    data:$('#insert_form').serialize(),
    beforeSend:function(){
     $('#insert').val("Inserting");
    },
    success:function(data){
     $('#insert_form')[0].reset();
     $('#add_data_Modal').modal('hide');
     $('#employee_table').html(data);
    }
   });
  }
 });




 $(document).on('click', '.view_data', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"VistaPrevia.php",
   method:"POST",
   data:{personal_id:personal_id},
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 });
});
 </script>
</body>
</html>
