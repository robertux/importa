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

							<p><b>Tipo de Repuesto:</b> '.$tipoRepuesto.'</p>
							
							<p><b>Marca:</b> '.$marcaRepuesto.'</p>
							
							<p><b>Modelo:</b> '.$modeloRepuesto.'</p>
							
							<p><b>A&ntilde;o:</b> '.$anioRepuesto.'</p>
							
							<p><b>Chasis:</b> '.$chasisRepuesto.'</p>
							
							<p><b>Chasis VIN;o:</b> '.$chasisVRepuesto.'</p>
							
							<p><b>Comentarios:</b> '.nl2br($comentarioRepuesto).'</p>';
							

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
<script type="text/javascript" src="js/floatbox/framebox.js"></script>									
<link rel="stylesheet" href="js/floatbox/floatbox.css" type="text/css" media="screen" />
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
			<li><a href="#">Cont&aacute;ctanos</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<h2 class="title"><strong>Repuestos</strong></h2>
				<div class="entry">
				
				<center><p style="font-weight:bold; font-size:15px; color:#000000;">IMPORTA te ofrece toda clase de respuestos</p></center>
				
<?php 

	if(!isset($_StatsMails['send']))

	{

?>

				
				<p>Solicita cualquier tipo de repuesto</p>

				<p>Ingresa la informaci&oacute;n requerida y solic&iacute;tala:</p>
				
				<form action="repuestos.php?wlock=WU9Q" method="post" target="_self">
				
				<div class="titletForm"><b>Tipo de repuesto:</b></div>
				<input class="txtForm" type="text" name="tipoRepuesto" id="tipoRepuesto">
				<div class="titletForm"><b>Marca:</b></div>
				<input class="txtForm" type="text" name="marcaRepuesto" id="marcaRepuesto">
				<div class="titletForm"><b>Modelo:</b></div>
				<input class="txtForm" type="text" name="modeloRepuesto" id="modeloRepuesto">
				<div class="titletForm"><b>A&ntilde;o:</b></div>
				<input class="txtForm" type="text" name="anioRepuesto" id="anioRepuesto">
				<div class="titletForm"><b>Chasis:</b></div>
				<input class="txtForm"  type="text" name="chasisRepuesto" id="chasisRepuesto">
				<div class="titletForm"><b>Chasis VIN:</b></div>
				<input class="txtForm" type="text" name="chasisVRepuesto" id="chasisVRepuesto">
				<div class="titletForm"><b>Comentarios:</b></div>
				<textarea class="txtForm" name="comentarioRepuesto" id="comentarioRepuesto"  rows="5"></textarea>
				<div class="titleForm">
				<input type="submit" value="Enviar" class="accept-button" name="enviarRepuesto">
				</div>
				</form>
				
<?php 

	}

	elseif($_StatsMails['send'] == '2')

	{
		echo '<br><br><br><div align="center"><img src="images/mail_send.jpg" /></div>';
	}

?>

				<br><br><br>
				<div class="hlinks">
					<span >|</span>
					<a href="servicios.html">Atr&aacute;s</a>
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
						<li><img src="images/icons/bullet_tick.png"/>&nbsp;&nbsp;&nbsp;<a href="#">Subastas Online</a></li>
						<li><img src="images/icons/imgBusqueda.png"/>&nbsp;&nbsp;&nbsp;<a href="#">Sitio 1</a></li>
						<li><img src="images/icons/imgEnReparacion.png"/>&nbsp;&nbsp;&nbsp;<a href="#">Subastas Online</a></li>
						<li><img src="images/icons/car_red.png"/>&nbsp;&nbsp;&nbsp;<a href="#">Sitio 2</a></li>
						<li><img src="images/icons/eyes.png"/>&nbsp;&nbsp;&nbsp;<a href="#">Otros Links</a></li>
						<li><img src="images/icons/flag_checked.png"/>&nbsp;&nbsp;&nbsp;<a href="#">Subastas en L&iacute;nea</a></li>
						<li><img src="images/icons/cart_full.png"/>&nbsp;&nbsp;&nbsp;<a href="#">Clasificados</a></li>
						
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
