<?php

  require('bd.php');

  $reg_por_pag = 8;
   
  @$nro_pag = $_GET['num'];
    if (is_numeric($nro_pag)){ 
      $inicio = ($nro_pag - 1) * $reg_por_pag;
    }else{
      $inicio = 0;
      $nro_pag = 1;
    }
  //******categoria y feriante************************************************
  @$id_cat = $_GET['cat'];
  @$id_fer = $_GET['fer'];
  //************VISTA- MOSTRAR SOLO PRODUCTOS ACTIVOS**********************
  $vista=0;
  //************FILTRO**********************
  @$busca=$_GET['busca'];
  if ($busca!="") {//si la caja de texto no esta vacia entonces
    $consulta = mysqli_query($conexion,"SELECT * FROM producto WHERE nombre LIKE '%".$busca."%' AND vista=$vista LIMIT $inicio,$reg_por_pag");
    $nro_reg2 = mysqli_query($conexion,"SELECT * FROM producto WHERE nombre LIKE '%".$busca."%' AND vista=$vista ");
  //************FIN FILTRO**********************     
  }elseif (is_numeric($id_fer)) {
   $consulta = mysqli_query($conexion,"SELECT * FROM producto WHERE id_feriante = $id_fer AND vista=$vista LIMIT $inicio,$reg_por_pag");
   $nro_reg2 = mysqli_query($conexion,"SELECT * FROM producto WHERE id_feriante = $id_fer AND vista=$vista ");
  }elseif (is_numeric($id_cat)) {
   $consulta = mysqli_query($conexion,"SELECT * FROM producto WHERE id_categoria = $id_cat AND vista=$vista LIMIT $inicio,$reg_por_pag");
   $nro_reg2 = mysqli_query($conexion,"SELECT * FROM producto WHERE id_categoria = $id_cat AND vista=$vista ");
  }else{
    $consulta = mysqli_query($conexion,"SELECT * FROM producto WHERE vista=$vista LIMIT $inicio,$reg_por_pag");
    $nro_reg2 = mysqli_query($conexion,"SELECT * FROM producto WHERE vista=$vista ");
  }

  //*****NUM TOTAL DE REGISTROS EN LA TABLA PROD******************************  
  $nro_reg = mysqli_num_rows($nro_reg2);
  //*****CANTIDAD PAGINAS***************************************************** 
  $can_pag = ceil($nro_reg / $reg_por_pag);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio | FeriaVerde</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="estilos.css" rel="stylesheet">
    <link href="social/css/social.css" rel="stylesheet">
    <link href="social/css/font.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="header.js"></script>

</head>
<body class="body-index">

  <div class="HEADER">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expANDed="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <h7 class="text-logo"><img src="img/logo.jpg" class="img-logo"> FeriaVerde</h7>
          <br>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         
          <ul class="nav5 navbar-nav5">
            <li class="active"><a>Inicio</a></li>
            <li><a href="acercade.php">Acerca de</a></li>
            <li><a href="contacto.php">Contacto</a></li>
          </ul>

          <form class="navbar-form navbar-left align-nav6">
             <div class="form-group">
               <a href="#scroll">
                <input type="text" name="busca" id="busca" class="form-control" placeholder="Buscar..." >
               </a> 
             </div>
             <button type="submit" class="btn btn-success" role="button" name="boton">
                <span class="glyphicon glyphicon-search"></span>
             </button>
          </form>

          <ul class="nav navbar-nav navbar-right align-nav6">
              <li><a class="btn btn-lg" role="button" href="https://www.facebook.com/profile.php?id=100009164895357&fref=ts" target="_blank"><span class="fa fa-facebook"></span></a></li>
              <li><a class="btn" role="button" href="#VENTANA1" data-toggle="modal"><samp class="glyphicon glyphicon-user"></samp> INICIAR SESIÓN</a></li>
          </ul>         
        </div> 
      </div>
    </nav>
  </div>  

  <!--VENTANA INICIAR SESION-->  
    <div class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="VENTANA1" >
      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header"><!--Encabezado-->  
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center title3" id="myModalLabel">Iniciar sesión</h4>
            </div><!--/Encabezado--> 
            <div class="modal-body" ><!--Contenido-->
              <div class="login-form">
                  <form action="login.php" method="post" >
                     <div class="form-group">
                    <label>Nombre de usuario:</label> 
                    <input type="text" name="user" class="form-control" required="" >
                    </div>
                    <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="pass" class="form-control" required="" >
                    </div> 
                    <div class="form-group">
                    <button class="btn btn-success btn-lg btn-block" type="submit">Ingresar</button>
                    </div>
                  </form>
              </div>
            </div><!--/Contenido-->
          </div>
      </div>
    </div>
  <!--/VENTANA INICIAR SESION--> 
 

    <!-- Carrusel -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="img/1.png" alt="0">
        </div>

        <div class="item">
          <img src="img/1.png" alt="1">
        </div>

        <div class="item">
          <img src="img/1.png" alt="2">
        </div>

        <div class="item">
          <img src="img/1.png" alt="3">
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!-- /Carrusel -->


      <div class="container-fluid">
      
        <!--Barra lateral-->
        <div class="col-sm-3">
          <h3 class="title2">CATEGORIAS</h3> <!-- Antes estaba la clase "title"-->
          <div class="hr2"></div>
            <ul class="nav2">
              <?php if ($id_cat!="") { ?><!-- condicional para agregar/quitar clase "active" -->
              <li><a href="index.php?#scroll">Todas las categorias</a></li>
              <?php } else { ?>
              <li class="active"><a href="index.php?#scroll">Todas las categorias</a></li>
              <?php } ?>
                <?php 
                 $consulta_categ= mysqli_query($conexion,"SELECT id, nombre FROM categoria as c WHERE (SELECT count(*) FROM producto WHERE id_categoria = c.id AND vista=$vista) > 0"); 
                  while ($fila3=mysqli_fetch_assoc($consulta_categ)) {
					  if ($fila3['id'] == $id_cat) { ?><!-- condicional para agregar/quitar clase "active" -->
              <li class="active"><a href="index.php?cat=<?php echo $fila3['id'];?>#scroll"> <?php echo $fila3['nombre']; ?></a></li>
                <?php } else { ?>
			  <li><a href="index.php?cat=<?php echo $fila3['id'];?>#scroll"> <?php echo $fila3['nombre']; ?></a></li>
                <?php }
                } ?>
            </ul>
          <h3 class="title2">FERIANTES</h3>
          <div class="hr2"></div>
            <ul class="nav3">
                <?php
				  $consulta_fer= mysqli_query($conexion,"SELECT id, nombre , apellido FROM feriante as c WHERE (SELECT count(*) FROM producto WHERE id_feriante = c.id AND vista=$vista) > 0");
                  while ($fila5=mysqli_fetch_assoc($consulta_fer)) {
					  if ($fila5['id'] == $id_fer) { ?><!-- condicional para agregar/quitar clase "active" -->
              <li class="active"><a href="index.php?fer=<?php echo $fila5['id'];?>#scroll"> <?php echo $fila5['nombre']." ".$fila5['apellido']; ?> 
                <span class="badge pull-right cant-fer">  
                 <?php 
                   $cod_fer=$fila5['id'];
                   $total_prod_fer2 = mysqli_query($conexion,"SELECT * FROM producto WHERE id_feriante = $cod_fer AND vista=$vista");
                   $total_prod_fer = mysqli_num_rows($total_prod_fer2);
                   echo "(".$total_prod_fer.")";
                 ?> 
                </span></a>
              </li>
                <?php } else { ?>
			  <li><a href="index.php?fer=<?php echo $fila5['id'];?>#scroll"> <?php echo $fila5['nombre']." ".$fila5['apellido']; ?> 
                <span class="badge pull-right cant-fer">  
                 <?php 
                   $cod_fer=$fila5['id'];
                   $total_prod_fer2 = mysqli_query($conexion,"SELECT * FROM producto WHERE id_feriante = $cod_fer AND vista=$vista");
                   $total_prod_fer = mysqli_num_rows($total_prod_fer2);
                   echo "(".$total_prod_fer.")";
                 ?> 
                </span></a>
              </li>
				<?php }
				} ?>
            </ul>
          <br>
          <!--imagen lateral-->
          <div class="LATERAL-IMG">
             <img src="img/fecha.jpg"/>
          </div>
          <!--/imagen lateral-->
              
        </div>
        <!--/Barra lateral-->

        <!--todos los Productos-->
        <div class="col-sm-9">
          <div id="scroll"></div>
          <h3 class="title2">PRODUCTOS</h3> 
          <div class="hr1"></div>
            <?php
            while ($fila=mysqli_fetch_assoc($consulta)) { 
            ?>  
            <!--producto-->
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="thumbnail">
                    <div class="MARCO-IMG">
                      <img class="IMG" src="img/productos/<?php echo $fila["imagen"]; ?>"> <!--IMAGEN-->
                    </div> 
                    <div class="text-center">
                      <p class="parrafo3"> <?php echo $fila["nombre"];?> </p> <!--NOMBRE-->
                      <p>
                      <a href="#ventana<?php echo $fila["id"];?>" data-toggle="modal" class="btn btn-success" role="button">Mas información</a>
                    <!--ventana modal-->  
                            <div class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ventana<?php echo $fila["id"]; ?>" >
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div ALIGN=left>
                                  <!--Encabezado de la ventana-->  
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title title3" id="myModalLabel"><?php echo $fila["nombre"]; ?></h4>
                                  </div>  
                                  <!--Contenido de la ventana-->
                                  <div class="modal-body" >
                                    <h5 class="title3">FERIANTE:</h5>
                                      <?php  
                                          $cod = $fila['id_feriante'];
                                          $sql = "SELECT * FROM feriante WHERE id = $cod";
                                          $res= mysqli_query($conexion,$sql);
                                          $fila1=mysqli_fetch_assoc($res); 
                                      ?> 
                                        <p class="parrafo1"><?php echo "NOMBRE Y APELLIDO: ".$fila1['nombre']." ".$fila1['apellido']."<br> TELEFONO: ".$fila1['telefono']."<br> DIRECCION: ".$fila1['direccion']."<br> LOCALIDAD: ".$fila1['localidad']; ?>
                                        </p>
                                    <h5 class="title3">CATEGORIA:</h5>
                                       <?php  
                                        $cod = $fila['id_categoria'];
                                        $sql = "SELECT * FROM categoria WHERE id = $cod";
                                        $res= mysqli_query($conexion,$sql);
                                        $fila2=mysqli_fetch_assoc($res); 
                                        ?>
                                        <p class="parrafo1"><?php echo $fila2['nombre']; ?></p>
                                     <h5 class="title3">DETALLE:</h5>
                                     <pre><p class="parrafo2"><tt><?php echo $fila["detalle"]; ?></tt></p></pre>
                                  </div>
                                  </div>
                                  <!--Pie de paguina de la ventana-->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Salir</button>
                                  </div>
                                </div>
                              </div>
                            </div> 
                  <!--//ventana modal-->                
                      </p>
                    </div>
                </div>
            </div>
            <!--/producto-->
            <?php  } ?>
        </div>
        <!--/Todos los Productos-->
               
          <!--Paginacion-->
          <div class="row">
            <nav aria-label="Page navigation" class="text-center">
              <ul class="pagination2">
              <?php 
                     @$id_cat = $_GET['cat'];
                          if ($nro_pag > 1){ //Anterior
                              echo "<li><a href='index.php?num=".($nro_pag-1).".&cat=".($id_cat).".&fer=".($id_fer).".&busca=".($busca)."'>Anterior </a></li>"; 
                           }
                           
                          for ($cont=1; $cont <= $can_pag ; $cont++) {  //Numero de paginas
                            if ($cont == $nro_pag) {
                                echo "<li class='disabled'><a href='#'> $cont </a></li>";//deja inactivo el num que seleccione
                            } else { //bucle para mostrar nros de paginas 1 2 3 4 
                                echo "<li><a href='index.php?num=".($cont).".&cat=".($id_cat).".&fer=".($id_fer).".&busca=".($busca)."'> $cont </a></li>"; 
                            }
                          }

                          if ($nro_pag < $can_pag){ //Siguiente
                              echo "<li><a href='index.php?num=".($nro_pag+1).".&cat=".($id_cat).".&fer=".($id_fer).".&busca=".($busca)."'> Siguiente</a></li>"; 
                           }
                         
              ?>
              </ul>
            </nav>
          </div> 
          <!--/Paginacion-->
           
        </div>
      </div> 


<!--Pie de pagina-->
    <div class="info-footer">
      <div class="container-fluid">
          <div class="col-sm-6">
             <p>
              <?php 
                   $cod_adm=1;
                   $res = mysqli_query($conexion,"SELECT * FROM feriante WHERE admin = $cod_adm");
              while ($fila_adm=mysqli_fetch_assoc($res)) { 
              ?>  
              <br> 
                <h4>Cominicate con el administrador:</h4>
                <strong>Nombre y Apellido: </strong><?php echo $fila_adm['nombre']." ".$fila_adm['apellido']; ?><br>
                <strong>Teléfono: </strong><?php echo $fila_adm['telefono']; ?><br>
                <strong>Dirección: </strong><?php echo $fila_adm['direccion']; ?><br>
                <strong>Localidad: </strong><?php echo $fila_adm['localidad']; ?><br>
                <strong>E-mail: </strong><?php echo $fila_adm['email']; ?><br>
                <strong>Enviar mensaje: </strong><ins><a class="link_contacto" href="contacto.php">Contacto</a></ins>
              <?php  } ?> 
             </p>
             <h2><img src="img/logo.jpg" width="60"> FeriaVerde</h2>
             <br><br>
          </div>

          <div class="col-sm-6">
            
            <div class="text-center">
            <br>  
            <a class="btn btn-social btn-facebook btn-lg" href="https://www.facebook.com/profile.php?id=100009164895357&fref=ts" target="_blank">
              <span class="fa fa-facebook"></span> Facebook
            </a>
            </div>
              <div>
                <br>
                <br>
                <p>
                  <br>
                </p>
              </div> 
          </div>
        </div>  
    </div>
    
    <div class="footer">
        <div  class="container-fluid">
          <div class="text-center">
            <h6>© 2016 Feria verde. Todos los derechos reservados. Creadores del sitio: <a class="btn btn-facebook btn-xs" role="button" href="" target="_blank"><span class="fa fa-facebook"></span> Facebook</a></h6>
          </div>  
        </div>  
    </div> 
<!--/Pie de pagina-->
      
</body>
</html>


