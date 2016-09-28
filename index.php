<?php
session_start();
$_SESSION['detalle'] = array();

//require_once 'Config/conexion.php';
//require_once 'Model/Producto.php';
require_once "lib/nusoap.php";



//$objProducto = new Producto();
//$resultado_producto = $objProducto->get();


?>
<!DOCTYPE html>
<head>

    <!--meta name="viewport" content="width=device-width, initial-scale=1"-->
    <title>Mobile 1</title>
    <link rel="stylesheet" href="jqm/jquery.mobile-1.4.5.min.css" />
    
    <link rel="stylesheet" href="libs/js/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="libs/js/alertify/themes/alertify.bootstrap.css" id="toggleCSS" />
    <link href="libs/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <script src="libs/js/jquery.js"></script>
    <script src="libs/js/jquery-1.8.3.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/ajax.js"></script>	     
    <script src="libs/js/alertify/lib/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="jqm/jquery.mobile-1.4.5.min.js"></script>
    
    
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>

<body>

    <div data-role="page" id="home" data-theme="a">
        <?php 
        $cliente = new nusoap_client("http://pymesv.com/datos08new/soap_server.php");
        $resultado_producto = $cliente->call("get");
        ?>    
        <div data-role="header">
            <h1>Productos Disponibles</h1>
        </div>
        
        <div data-role="content">
            <div data-role="navbar">
                <ul class="nav nav-tabs">
                  <li role="presentation" class="active"><a href="#home" data-transition="flip"><span class="glyphicon glyphicon-home" ></span>&nbsp;&nbsp;&nbsp;Home</a></li>
                  <li role="presentation"><a href="#agregar" data-transition="flip"><span class="glyphicon glyphicon-plus" ></span>&nbsp;&nbsp;&nbsp;Agregar</a></li>
                  <li role="presentation"><a href="#carrito" data-transition="flip"><span class="glyphicon glyphicon-shopping-cart" ></span>&nbsp;&nbsp;&nbsp;Carrito</a></li>
                </ul>
            </div><!-- /navbar -->
            <div class="row text-center">
              <?php foreach($resultado_producto as $producto):?>
                  <div class="col-sm-2">
                      <div class="thumbnail">
                        <img src="./productos/<?php echo $producto['imagen']?>" alt="<?php echo $producto['nombre']?>">
                        <p><strong><?php echo $producto['nombre']?></strong></p>
                        <p><?php echo $producto['descripcion']?></p>
                      </div>
                  </div>
              <?php endforeach;?>
            </div>
        
        <!--a href="#agregar" data-transition="flip" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">page 2</a-->
        </div>
    </div>
    
    
    <!--   Agregar   -->
    
    
    <div data-role="page" id="agregar" data-theme="b">
    <?php
    $cliente = new nusoap_client("http://pymesv.com/datos08new/soap_server_insert.php");
    ?>
        <div data-role="header">
            <h1>Agregar productos</h1>
        </div>
        
        <div data-role="content">
            <div data-role="navbar">
                <ul class="nav nav-tabs">
                  <li role="presentation"><a href="#home" data-transition="flip"><span class="glyphicon glyphicon-home" ></span>&nbsp;&nbsp;&nbsp;Home</a></li>
                  <li role="presentation" class="active"><a href="#agregar" data-transition="flip"><span class="glyphicon glyphicon-plus" ></span>&nbsp;&nbsp;&nbsp;Agregar</a></li>
                  <li role="presentation"><a href="#carrito" data-transition="flip"><span class="glyphicon glyphicon-shopping-cart" ></span>&nbsp;&nbsp;&nbsp;Carrito</a></li>
                </ul>
            </div><!-- /navbar -->
        
            <form name="frm1" action="?" method="post" enctype="multipart/form-data">
                <div class="col-xs-7">
                  <div class="form-group">
                    <label for="nombre">Nombre de producto</label>
                    <input type="text" name="txtnombre" class="form-control" id="nombre" aria-describedby="name" placeholder="Ingrese el nombre del producto">
                    <small id="name" class="form-text text-muted">Elija un nombre descriptivo para el producto nuevo.</small>
                  </div>  
                 
                  
                    <div class="form-group">
                    <label for="descripcion">Descripcion del producto</label>
                    <input type="text" name="txtdescripcion" class="form-control" id="descripcion" placeholder="Ingrese la descripción del producto">
                    <small id="descripcion" class="form-text text-muted">Ingrese las características del producto aquí separelas por ",".</small>
                  
                  </div>
                  
                  <div class="form-group">
                    <label for="imagen">Seleccionar archivo</label>
                    <input type="file" name="txtimagen" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Seleccione una imagen para mostrar su producto...</small>    
                    </div>
                    
                    
                    <div class="form-group">
                    <label for="descripcion">Precio del producto</label>
                    <input type="double" name="txtprecio" class="form-control" id="descripcion" placeholder="Precio del producto">
                    <small id="descripcion" class="form-text text-muted">Ingrese el precio del producto</small> 
                  </div>
                  
                  <div class="form-group">
                    <label for="cantidad">Cantidad del producto</label>
                    <input type="double" name="txtcantidad" class="form-control" id="cantidad" placeholder="Cantidad producto">
                    <small id="descripcion" class="form-text text-muted">Ingrese la cantidad inicial del producto en unidades</small> 
                  </div>
                  <input type="submit" name="btnagregar" value="Agregar producto" Class="btn btn-success"/>
                   
              </div>
            </form> 
        
        
        </div>
        
    </div>
    
<?php

if (isset($_POST['btnagregar']))
{
    
    
//$resultado = $cliente->call('ingresar_producto');    
    
    $producto = array();
    $producto[1] =  array('nombre' => $_POST['txtnombre'], 'descripcion' => $_POST['txtdescripcion'], 'archivo'   => $_FILES["txtimagen"]["name"], 'precio'   => $_POST['txtprecio'], 'cantidad'   => $_POST['txtcantidad']);   
     
     
    $datos_producto_entrada = array( "datos_producto_entrada" => $producto);
 
    //$cliente = new nusoap_client("http://pymesv.com/datos08new/soap_server_insert.php");
    try {
    $resultado = $cliente->call('ingresar_producto',$datos_producto_entrada);
    
    $foto = $_FILES["txtimagen"]["tmp_name"];
    $destino = "productos/".$_FILES["txtimagen"]["name"];
    move_uploaded_file($foto,$destino);
    //echo $resultado;
    //$dbhandle = mysqli_connect("basews08.db.8917278.hostedresource.com","basews08","XZ7rADss89@gvc5","basews08");
    //mysqli_query($dbhandle,"INSERT INTO productos(nombre,descripcion,imagen,precio,cantidad) VALUES('".$value['nombre']."','".$value['descripcion']."','".$value['archivo']."',".$value['precio'].",".$value['cantidad'].")");
    echo '<div class="panel panel-success">
          <div class="panel-heading">Registro completado con exito</div>         
          </div>';
  }
  catch (Exception $e) {
    echo $e;

    echo '<div class="panel panel-danger">
          <div class="panel-heading">Ha ocurrido un error</div>
          </div>';
  }
}
?>
    
    <!--   Carrito   -->
    
    
    <div data-role="page" id="carrito">
    
        <div data-role="header">
            <h1>Carrito</h1>
        </div>
        
        <div data-role="content" data-theme="a">
            <?php
            $cliente = new nusoap_client("http://pymesv.com/datos08new/soap_server.php");
            $resultado_producto = $cliente->call("get");
            ?>
            <div data-role="navbar">
                <ul class="nav nav-tabs">
                  <li role="presentation"><a href="#home" data-transition="flip"><span class="glyphicon glyphicon-home" ></span>&nbsp;&nbsp;&nbsp;Home</a></li>
                  <li role="presentation"><a href="#agregar" data-transition="flip"><span class="glyphicon glyphicon-plus" ></span>&nbsp;&nbsp;&nbsp;Agregar</a></li>
                  <li role="presentation" class="active"><a href="#carrito" data-transition="flip"><span class="glyphicon glyphicon-shopping-cart" ></span>&nbsp;&nbsp;&nbsp;Carrito</a></li>
                </ul>
            </div><!-- /navbar -->
            <div class="row">
    			<div class="col-md-4">
    				<div>Producto:
    				<select name="cbo_producto" id="cbo_producto" class="col-md-2 form-control" >
    					<option value="0">Seleccione un producto</option>
    					<?php foreach($resultado_producto as $producto):?>
    						<option value="<?php echo $producto['id']?>"><?php echo $producto['nombre']?></option>
    					<?php endforeach;?>
    				</select>
    				</div>
    			</div> 
    			<div class="col-md-2">
    				<div>Cantidad:
    				  <input id="txt_cantidad" name="txt_cantidad" type="text" class="col-md-2 form-control" placeholder="Ingrese cantidad" autocomplete="off" />
    				</div>
    			</div>
    			<div class="col-md-2">
    				<div style="margin-top: 19px;">
    				<button type="button" class="btn btn-success btn-agregar-producto">Agregar</button>
    				</div>
    			</div>
            </div>
            <br />
            <div class="panel panel-info">
			 <div class="panel-heading">
		        <h3 class="panel-title">Productos</h3>
		      </div>
			<div class="panel-body detalle-producto">
				<?php if(count($_SESSION['detalle'])>0){?>
					<table class="table">
					    <thead>
					        <tr>
					            <th>Descripci&oacute;n</th>
					            <th>Cantidad</th>
					            <th>Precio</th>
					            <th>Subtotal</th>
					            <th></th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php
					    	foreach($_SESSION['detalle'] as $k => $detalle){
					    	?>
					        <tr>
					        	<td><?php echo $detalle['producto'];?></td>
					            <td><?php echo $detalle['cantidad'];?></td>
					            <td><?php echo $detalle['precio'];?></td>
					            <td><?php echo $detalle['subtotal'];?></td>
					            <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle['id'];?>">Eliminar</button></td>
					        </tr>
					        <?php }?>
					    </tbody>
					</table>
				<?php }else{?>
				<div class="panel-body"> No hay productos agregados</div>
				<?php }?>
			</div>
		</div>
        
        <!--a href="#agregar" data-transition="flip" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">page 2</a-->
        </div>
        
    </div>
    
    
    
</body>
</html>