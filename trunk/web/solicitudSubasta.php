<?

// Linea para que reconosca las Ñ y las tildes				

	header('Content-Type: text/html; charset=ISO-8859-1');

	$Path = "./";

	include($Path."php/SendCorreo.php");
	
	$send_coreo = new SendCorreo;
	
	// Enviar Correo
	if($wlock == 'WU9Q')
	{
		$Cuerpo_Mail_HTML = '<h3>Correo de Prueba de Solicitud de Repuestos</h3>

							<p><b>Tipo de Veh&iacute;culo:</b> '.$tipoVehiculo.'</p>
							
							<p><b>Marca:</b> '.$marcaVehiculo.'</p>
							
							<p><b>Modelo:</b> '.$modeloVehiculo.'</p>
							
							<p><b>A&ntilde;o:</b> '.$anioVehiculo.'</p>
							
							<p><b>Comentarios:</b> '.nl2br($comentarios).'</p>';
							

		$destinos = 'Hugo Barrientos <hugol.barrientos@gmail.com>' . '*,*' . 'Claudia Moreno <alediejo@yahoo.com>';
		$_StatsMails = $send_coreo->Correo($destinos,'IMPORTA... sin L&iacute;mites - Contacto',$Cuerpo_Mail_HTML,'Hugo <hugol.barrientos@gmail.com>');
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="Importa, vehiculos, tramites aduanales, El Salvador, Estados Unidos" />
<meta name="description" content="Importa, vehiculos, tramites aduanales, El Salvador, Estados Unidos" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>IMPORTA... sin l&iacute;mites</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>	
<script type="text/javascript" src="js/jqueryui.js"></script>
<link href="css/jqueryui.css" rel="stylesheet" type="text/css" media="screen" />	
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />


<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery("#correoEnviado").dialog({
      bgiframe: true, autoOpen: false, height: 200, width:400, modal: true
    });
  });
</script>


</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
	<div id="header">
		<!--div id="search">
			<form method="get" action="">
				<fieldset>
				<input type="text" name="s" id="search-text" size="15" value="enter keywords here..." />
				<input type="submit" id="search-submit" value="GO" />
				</fieldset>
			</form>
		</div-->
		
		<img id="logoImporta" src="images/banner.png"/>
		
	</div>
	</div>
	<!-- end #header -->
	<div id="menu">
		<ul>
			<li><a href="home.html">Home</a></li>
			<li><a href="conocenos.html">Con&oacute;cenos</a></li>
			<li class="current_page_item"><a href="servicios.html">Servicios</a></li>
			<li><a href="clientes.html">Clientes</a></li>
			<li><a href="vehiculos_reparados.html">Autolote</a></li>
			<li><a href="contactanos.php">Cont&aacute;ctanos</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<h2 class="title"><strong>Subastas</strong></h2>
				<div class="entry">
				
				<center><p style="font-weight:bold; font-size:15px; color:#000000;">Con IMPORTA puedes participar en nuestras subastas.</p></center>
				
<?php 

	if(!isset($_StatsMails['send']))

	{

?>

				
				<p>Solo ingresa la informaci&oacute;n solicitada del veh&iacute;culo que te interesa y nos pondremos en contacto contigo:</p>
				
				<form action="solicitudSubasta.php?wlock=WU9Q" method="post" target="_self">
				
				<div class="titletForm"><b>Tipo de veh&iacute;culo:</b></div>
				<select class="txtForm" type="text" name="tipoVehiculo" id="tipoVehiculo">
				<option>Autom&oacute;vil</option>
				<option>Pickup</option>
				<option>Cami&oacute;n</option>
				<option>Microbus</option>
				<option>Autobus</option>
				<option>Motocicleta</option>
				<option>Rastras</option>
				<option>Otros</option>
				</select>
				
				<div class="titletForm"><b>Marca:</b></div>
				<select class="txtForm" type="text" name="marcaVehiculo" id="marcaVehiculo">
				<option></option>
				<option></option>
				</select>
				
				<div class="titletForm"><b>Modelo:</b></div>
				<select class="txtForm" type="text" name="modeloVehiculo" id="modeloVehiculo">
				<option></option>
				<option></option>
				</select>
				
				<div class="titletForm"><b>A&ntilde;o:</b></div>
				<select class="txtForm" type="text" name="anioVehiculo" id="anioVehiculo">
				<?php
				$anio=date('Y');
				for ($i = 1975; $i <= $anio; $i++) {
					echo '<option>'.$i.'</option>';
				}
				?>
				</select>
				
				<div class="titletForm"><b>Comentarios:</b></div>
				<textarea name="comentarios" id="comentarios" class="txtFormC" cols="50" rows="8"></textarea>
				
				<div class="txtFormC">
				<input type="submit" value="Enviar" class="accept-button" name="enviarVehiculo">
				</div>
				
				</form>
				
<?php 

	}

	elseif($_StatsMails['send'] == '2')

	{
		echo '<br><br><br><div align="center"><img src="images/mail_send.jpg" /></div>';
	}

?>

				<br>
				<div class="hlinks">
					<span >|</span>
					<a href="subasta.html">Atr&aacute;s</a>
					<span >|</span>
					<a href="vehiculos.html">Veh&iacute;culos</a>
					<span >|</span>
					<a href="servicios.html">Servicios</a>
					<span >|</span>
				</div>
				</div>
	</div>	
	<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #content -->
		<div id="sidebar">
			<ul>
			
				<li>
					<h2>Importaciones</h2>
					<p>Todo tipo de importaciones para Hermanos Lejanos.</p>
					<p><a href="importaciones.html"><img src="images/hl.jpg"></a></p>
				</li>
				
				<li>
					<h2>Repuestos</h2>
					<p><object name="imFlash" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width= "225" height= "250" >
<param name="movie" value="swf/anuncioRepuesto.swf" />
<param name="menu" value="false" />
<param name="quality" value="high" />
<param name="wmode" value="transparent" />

<!--[if !IE]> <-->
<object type="application/x-shockwave-flash" width= "225" height= "250" data="swf/anuncioRepuesto.swf" >
<param name="menu" value="false" />
<param name="quality" value="high" />
<param name="wmode" value="transparent" />
</object>
<!--> <![endif]-->
</object></p>
				</li>
				
				<li>
					<h2>Sitios de Inter&eacute;s</h2>
					<ul>
						<li><img src="images/icons/clientes.png"/>&nbsp;&nbsp;&nbsp;<a href="clientes.html">Clientes</a></li>
						<li><img src="images/icons/cart_full.png"/>&nbsp;&nbsp;&nbsp;<a href="solicitudSubasta.php">Formulario de Subastas</a></li>
						<li><img src="images/icons/herr.png"/>&nbsp;&nbsp;&nbsp;<a href="repuestos.php">Solicitud de Repuesto</a></li>
						<li><img src="images/icons/car_red.png"/>&nbsp;&nbsp;&nbsp;<a href="vehiculos_reparados.html">Autolote</a></li>
						<li><img src="images/icons/star.png"/>&nbsp;&nbsp;&nbsp;<a href="contactanos.php">Contacto</a></li>
					</ul>
				</li>
	
			</ul>
		</div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	</div>
	</div>
	<!-- end #page -->
</div>
<div id="footer-wrapper">
	<div id="footer">
		<p>Copyright (c) 2010 IMPORTA. Derechos Reservados.</p>
	</div>
	<!-- end #footer -->
</div>
<div id="correoEnviado" style="display:none" title="Importaciones">
	<img src="images/mail_send.jpg" />
</div>

</body>
</html>
