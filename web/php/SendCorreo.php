<?php
//::::::: Clase SendCorreo con esta clase se pueden enviar correos de forma simple y rapido
class SendCorreo{

// Funcion para poder enviar los correos
// Destinos pueden enviarse un arreglo de destinatarios con el siguiente formato $destinos = Usuario <usuario@example.com> . '*,*' . Usuario <usuario@example.com> . '*,*' . Usuario <usuario@example.com>;
// El Asunto por default es WebMaster - RastaGeek
// Cuerpo del Mensaje soporta HTML y el mensaje por default es <h1><br>Mail de Prueba</br></h1>
// El remitente por default es RastaGeeK <WebMaster@RastaGeek.com>
// Las Copias ocultas y las Copias de Carbon solo funcionan cuando el destino es solo solo uno
// El retraso de envio de cada correo es en segundos por default es 1 segundo
function Correo($destinos='wichox@gmail.com',$asunto='WebMaster - RastaGeek',$cuerpo='<h1><br>Mail de Prueba</br></h1>',$remitente='RastaGeeK <WebMaster@RastaGeek.com>',$retraso='0',$ReplyTo='',$Cc='nada',$Bcc='nada')                                   
{	
		$destinos = explode('*,*',$destinos);
   		$total = count($destinos) - 1;
   
   		foreach($destinos as $id => $destino)
		{
			//para el envío en formato HTML 
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			
			//dirección del remitente 
			$headers .= "From: ".$remitente."\r\n"; 
			
			//dirección de respuesta, si queremos que sea distinta que la del remitente 
			if($ReplyTo == '')
				$ReplyTo = $remitente;
				
			$headers .= "Reply-To:".$ReplyTo; 
			
			//direcciones que recibián copia 
			if(($Cc != 'nada') && ($total == 0))
				$headers .= "Cc: ".$Cc."\r\n"; 
			
			//direcciones que recibirán copia oculta 
			if(($Bcc != 'nada') && ($total == 0))
				$headers .= "Bcc: ".$Bcc."\r\n"; 	
				
			//Enviando Correo
			if(mail($destino,$asunto,$cuerpo,$headers) == True)
				{
					$_sendMails_OK = $_sendMails_OK + 1;
				}
			else
				{
					$_sendMails_Error = $_sendMails_Error + 1;
				}
				
			// Tiempo de Retardo de envio por cada correo
			sleep($retraso);
   		} 
		
		$_sendMails = array('send' => $_sendMails_OK,
						    'error' => $_sendMails_Error);
							
		return ($_sendMails);
}

/*******************************************************************************/

}
//::::::: Fin clase SendCorreo
?>