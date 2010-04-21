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

							<p><b>Nombre Cliente:</b> '.$formNombre.'</p>
							
							<p><b>Direcci&oacute;n:</b> '.$formDireccion.'</p>
							
							<p><b>Tel&eacute;fono:</b> '.$formTelefono.'</p>
							
							<p><b>Tipo de Solicitud:</b> '.$formSolicitud.'</p>
						
							<p><b>Descripci&oacute;n:</b> '.nl2br($formDescipcion).'</p>';
							

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
			<li><a href="servicios.html">Servicios</a></li>
			<li><a href="clientes.html">Clientes</a></li>
			<li><a href="vehiculos_reparados.html">Autolote</a></li>
			<li class="current_page_item"><a href="contactanos.php">Cont&aacute;ctanos</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<h2 class="title"><strong>Cont&aacute;ctanos</strong></h2>
				<div class="entry">
				<p>No importa el dinero... Con <span style="color:#AABD0A; font-weight: bold;">IMPORTA</span> puedes tener el carro de tus sue&ntilde;os.</p>
				<br>
				<center><img src="images/contacto.jpg">
				<br><br>
				<p><span style="color:#AABD0A; font-weight: bold;">IMPORTA</span> puede ser tu gran aliado en tus importaciones y exportaciones.</p>
				</center>
				<br>
				<h3>Contacto</h3>
				<p>Direcci&oacute;n:
				<br>
				Tel&eacute;fonos: El Salvador, EE.UU.
				<br>
				Emails
				<br>
				Croquis
				<br>
				</p>
				<br><br><br>
<?php 

	if(!isset($_StatsMails['send']))

	{

?>
				<h3>Formulario de Solicitud</h3>
				<p>&iquest;Te interes&oacute; algo en espec&iacute;fico? Env&iacute;anos tu solicitud y nos pondremos en contacto contigo para que trabajemos juntos:</p>
				
				<form action="contactanos.php?wlock=WU9Q" method="post" target="_self">
				<div class="titletForm"><b>Nombre Completo:</b></div>
				<input class="txtForm" type="text" name="formNombre" id="formNombre">
				
				<div class="titletForm"><b>Direcci&oacute;n:</b></div>
				<input class="txtForm" type="text" name="formDireccion" id="formDireccion">
				
				<div class="titletForm"><b>Tel&eacute;fono:</b></div>
				<input class="txtForm" type="text" name="formTelefono" id="formTelefono">
				
				<div class="titletForm"><b>Tipo de solicitud:</b></div>
				<select class="txtForm" type="text" name="formSolicitud" id="formSolicitud">
				<option>Veh&iacute;culos</option>
				<option>Repuestos</option>
				<option>Importaciones</option>
				<option>Tr&aacute;mites Aduanales</option>
				</select>
				
				<div class="titletForm"><b>Descripci&oacute;n:</b></div>
				<textarea name="formDescripcion" id="formDescripcion" class="txtFormC" cols="50" rows="8"></textarea>
				
				<div class="txtFormC">
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
				
				</div>
	</div>
	<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<h2>Subastas</h2>
					<a href="subasta.html"><img src="images/sub.gif"></a>
				</li>
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
<div id="correoEnviado" style="display:none" title="Importaciones">
	<img src="images/mail_send.jpg" />
</div>
	<div id="footer">
		<p>Copyright (c) 2010 IMPORTA. Derechos Reservados.</p>
	</div>
	<!-- end #footer -->
</div>
</body>
</html>
