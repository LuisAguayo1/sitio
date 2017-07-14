<!DOCTYPE html>
<html>
	<div>
		<head>
		<!-- IMPORTACION DE ESTILOS -->
			
		<!-- IMPORTACION DE BOOTSTRAP Y JS -->
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 

			<script src="js/jquery.js"></script>
			<script src="bootstrap/js/bootstrap.min.js"></script>
			
		<!-- CIERRE DE IMPORTACION DE BOOTSTRAP Y JS -->
			<link rel="stylesheet" type="text/css" href="css/style.css">
			<link rel="stylesheet" type="text/css" href="css/estilos1.css">
			<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

			<link rel="stylesheet" href="css/blogF.css">
			<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script> 
			<script src="js/jquery.openCarousel.js" type="text/javascript"></script>

		<!-- REFERENCIA A LOS ESTILOS -->
			<link rel="stylesheet" href="css/main.css"> 
			<link rel="stylesheet" href="css/stilos.css"> 
		<!--CIERRA SECCION DE ESTILOS-->
		
		</head>
		
		<body class="fondo">
			<!-- ABRE MENU DE NAVEGACION -->
			<nav class="navbar navbar-default navbar-fixed-top container">
				<class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					
					 <a class="navbar-brand"  href="#"><img src="images/logo_cotexcanegro.png" id="logocotexca"></a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="myNavbar">
					  <ul class="nav navbar-nav">
						<li class="active"><a href="#Inicio"><h7>Inicio</7><span class="sr-only">(current)</span></a></li>
						<li><a href="#Productos"><h7>Productos</7></a></li>
						<li><a href="#Nosotros"><h7>Nosotros</7></a></li>
						<li><a href="#Proyectos"><h7>Proyectos</7></a></li>
						<li><a href="#Clientes"><h7>Clientes</7></a></li>
						<li><a href="#Contacto"><h7>Contacto</7></a></li>
						
					  </ul>
					  <form class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Buscar">
						</div>
						<button type="submit" class="btn btn-default">Enviar</button>
					 </form>
					</div><!-- /.navbar-collapse -->
			<!-- /.	</div>container-fluid -->
			</nav>
		
		<!-- CIERRA MENU DE NAVEGACION -->
		<br><br><br>
		<!--Inicia imagen con logo-->
			<div>
				<center><img id="head"   src="images/banner.png" class="img-responsive" alt="Imagen responsive"></center>
			</div>
		<!--Cierra imagen-->
		<br><br><br>
		<!--Inicia secciones de productos-->
		<center>
			<div class="row">
			<A name="Productos"></a>
				<div class="col-xs-12 col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="550ms">
					<div class="service-icon">
						<img src="images/calzado.png" class="imgproductos">
						<br><br>
						<center><button type="button" class="btn btn-danger">Calzado</button><center>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="service-icon">
						<img src="images/muebles.png" class="imgproductos">
						<br><br>
						<center><button type="button" class="btn btn-danger">Muebles</button><center>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="service-icon">
						<img src="images/marroquineria.png" class="imgproductos">
						<br><br>
						<center><button type="button" class="btn btn-danger">Marroquineria</button><center>
					</div>
				</div>
			</div>
		</center>
		
		<!--Cierre seccion de prouctos-->
		
<br><br><br>
		
		<!-- Inicia seccion de nosotros-->
		<A name="Nosotros"></a>
		<div class="nosotros">
			<div class="col-sm-6">
			<img src="images/video.png" class="video">
			</div>
			<div class="col-sm-6">
			<p> 
			
			<video><source src="ima/1.mp4" type="video/mp4"></video><br>
			
			<p><h1 id="tltleproyect">COTEXCA</h1>
						<br>
						Somos una compañia funadada en Mexico en el 2001. Hoy representamos la cuna de innovacion  y moda para el sector de piel  sint&eacute;tica del pais.
						<br>
						somos un equipo de gente muy creativa, dedicada a sacar productos que se asemejen lo m&aacute;s posible en tacto, aparencia y efecto a la piel natural.
						<br>
						Colaboramos de la mano con casas de moda eurpeas, quienes os proveen con informaci&oacute;n en colorido, tenndencias y texturas.
						<br>
						Nuestro amplio equipo de diseño y desarrollo selecciona cautelosamente y miniciosamente las mejores materias primas para llegar a la creaci&oacute;n del producto deseado,
						poniendo a su disposici&oacute;n la &uacute;ltima tecnologia tanto de materias primas (resinas, lacas, ceras, bases coaguladas, etc.), como de maquinaria para poder estar siempre a la vanguardia  del mercado.
						
						</p>
			</div>
		<center>
			<div class="row">
				<div class="col-sm-3 ">
					<div class="service-icon">
						<img src="images/circuloazul.png" class="figura"> 
						<br><br>
						<p>INVESTIGACIN <br>
						Y DESARROLLO </p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="service-icon">
						<img src="images/circuloazul.png" class="figura">
						<br><br>
						<p>MANUFACTURA <br> DE CLASE MUNDIAL</p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="service-icon">
						<img src="images/circuloazul.png" class="figura">
						<br><br>
						<p>MAQUINARIA  <br> DE PRIMER NIVEL</p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="service-icon">
						<img src="images/circuloazul.png" class="figura">
						<br><br>
						<p>CAPACITACIONES</p>
					</div>
				</div>
			</div>
		</center>
		</div>
		<!-- Cierra seccion de nosotros-->
		

		
		<!--Inicia secciones de proyectos-->
	<div class="row proyecto">
		<div class="col-sm-6">
					<p><h1 id="titleproyect">HAGAMOS <br> UN PROYECTO <br> JUNTOS.</h1>
					<h4>Pres&eacute;ntanos tu proyecto  y trabajemos juntos para poder hacerlo espectacular. Confia en nuestros diseñadores y asesores. Somos THE FASHION SUPPLIER.</h4>
					</p>
		</div><br>
		<div class="col-sm-6">
                 <form >	
                           <input class="form-control" style="width: 70%; margin-bottom: 20px; padding: 7px; box-sizing: border-box; font-size: 17px;
                           	border: none;" class type="text" name="nombre" placeholder="Nombre" required>
							
                            <input class="form-control" style="width: 70%;	margin-bottom: 20px;	padding: 7px;	box-sizing: border-box; font-size: 17px;
	                        border: none;" type="text" name="correo" placeholder="Correo" required>
								   
                            <textarea class="form-control" style="min-height: 100px;	max-height: 200px; max-width: 70%; " name="mensaje"                                                     placeholder="Escriba su mensaje" required></textarea>
                            <br>
                            <input type="submit"  class="myButton" value="Enviar" id="boton">


                    </form>
		
		</div>
</div>
		<!--Cierre seccion de proyectos-->
		
<br><br><br>
		
		<!--Inicia secciones de clientes-->
		<br><br><br>
		<center><div class="row">
			<div class="col-sm-3">
				<p><h1>ALIANZAS</h1></p>
			</div>
			<div class="col-sm-3">
				<div class="service-icon">
						<img src="images/alianzas/salle.png">
					</div>
			</div>
			<div class="col-sm-3">
				<div class="service-icon">
						<img src="images/alianzas/tec.png">
					</div>
			</div>
			<div class="col-sm-3">
				<div class="service-icon">
						<img src="images/alianzas/ibero.png">
					</div>
			</div>
		</div></center>
		
		<!--Cierre seccion de proyectos-->
		
<br><br><br>
		
		<!--Inicia secciones de clientes-->
		<div id="Clientes" class="container-fluid">
			<center><div class="row">
			<div class="col-sm-3">
				<p><h1>Clientes</h1></p>
			</div>
			<div class="col-sm-3">
				<div class="service-icon">
						<img src="images/flexi.png">
					</div>
			</div>
			<div class="col-sm-3">
				<div class="service-icon">
						<img src="images/flexi.png">
					</div>
			</div>
			<div class="col-sm-3">
				<div class="service-icon">
						<img src="images/flexi.png">
					</div>
			</div>
		</div></center>
		
		
		
		</div>
		
		<!--Cierre seccion de clientes-->
		
<br><br><br>
		
		<!--Inicia secciones de contactanos-->
		<div class="row">
           <div class="col-md-6">
                 <p><h1>Contacto</h1></p>
				<br>
				 <h4>MATRIZ</h4>
				 <h5>Carretera Le&oacute;n-Cuer&aacute;maro <br> Km.0.800, Los Arcos. CP. 37684
				 <br>Le&oacute;n, Guanajuato,M&eacute;xico. <br> Tel.(477)152 11 00 <br> fabiancornelli@hotmial.com <br> ajdealbale&oacute;n@hotmail.com
				 <h5>
				 
				 <h4>SUCURSL</h4>
				 <h5>Emiliano Zapata 173 (calle 30) <br> Colonia San Felipe 44380 <br> Guadalajara, Jalisco, M&eacute;xico <br> Tel. (0133) 3653 0628, (0133) 3617 6938 <br> ajdealba@hotmail.com</h5>      
			</div>
			<div class="col-sm-6">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.87251792331!2d-101.69539168549504!3d21.03778628599347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842b953a4903de97%3A0x8dca6823a9ff6997!2sCarretera+Leon-Cuer%C3%A1maro%2C+Guanajuato!5e0!3m2!1ses-419!2smx!4v1499830126587" width="600" height="450" frameborder="0" style="border:0" allowfullscreen"></iframe>
			</div>
		</div>
		
		<!--Cierre seccion de contactanos-->
		
<br><br><br>
		
		<!--Inicio de pie de pagina-->
		<div class="pie">
		<center>
		<br><br>
			<div class="row">
				<div class="col-sm-2" class="logopie">
					<img src="images/logo_cotexcagris.png">
				</div>
				<div class="col-sm-2">
						<p>INICIO<br>
						PRODUCTO </p>
				</div>
				<div class="col-sm-2">
						<p>NOSOTROS <br> PROYECTOS</p>
				</div>
				<div class="col-sm-2">
						<p>CLIENTES <br> CONTACTOS</p>
				</div>
				<div class="col-sm-2">
						<p>DAMA <br>CABALLERO<br>INFANTIL</p>
				</div>
			</div>
		<br><br>
		</center>
		</div>
		
		<!--Fin de pie de pagina-->
		
		</body>
	</div>
</html>