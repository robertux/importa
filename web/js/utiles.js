// Funciones Utilies y Comunes

//----------------------------------------------------------------------------//
//------------>> REDIRECCIONAMIENTOS
//----------------------------------------------------------------------------//
// Para ir a una pagina

function Irpagina(url)
{
	window.parent.document.location = url;
}
//----------------------------------------------------------------------------//



//----------------------------------------------------------------------------//
//------------>> EFECTOS DE TABLA
//----------------------------------------------------------------------------//

// Para Hacer el intercambio de color en las tablas
// onMouseOver="FXTabla_1(this,'FBE18C','pointer');" onMouseOut="FXTabla_2(this,'EFEFEF');"

function FXTabla_1(src,color_entrada, puntero)
{
	src.bgColor = "#" + color_entrada;
	src.style.cursor = puntero;
}

function FXTabla_2(src,color_default)
{
	src.bgColor = "#" + color_default;
	src.style.cursor= "default";
}


// Para Hacer el intercambio de color en los bordes
// onMouseOver="FXBorder_1(this,'FBE18C','pointer');" onMouseOut="FXBorder_2(this,'EFEFEF');"

function FXBorder_1(src,color_entrada, puntero)
{
	src.style.borderColor = "#" + color_entrada;
	src.style.cursor = puntero;
}

function FXBorder_2(src,color_default)
{
	src.style.borderColor = "#" + color_default;
	src.style.cursor = "default";
}

//----------------------------------------------------------------------------//


//----------------------------------------------------------------------------//
//------------>> USO DE IMAGENES
//----------------------------------------------------------------------------//

// Para Cambiar una imagen por otra
// Cambio_Img('MiPic','Wimg/lipoo.JPG');
function Cambio_Img(id,img){
	document.getElementById(id).src = img;
}

//----------------------------------------------------------------------------//


//----------------------------------------------------------------------------//
//------------>> MANEJAR EL VALOR DE CONTROLES/OBJETOS
//----------------------------------------------------------------------------//

// Obtiene el valor del objeto que corresponda el ID
function valorID(ObjID)
{
	return document.getElementById(ObjID).value;
}

//----------------------------------------------------------------------------//

// Pasa el foco al objeto que corresponda el ID
function focoID(ObjID)
{
	return document.getElementById(ObjID).focus();
}

//----------------------------------------------------------------------------//

// Asigna una valor a un objeto/control
// mode = false -> sobreescribir el valor que tenga
// mode = true -> concatenar al valor exsistente
function Save_valorID(ObjID,valor,mode)
{
	if(mode == '') // una especie de parametro opcional
	{
		mode = false;
	}
	
	
	if(mode == true) // concatena con el valor ya existente en el control
	{
		if(valorID(ObjID) != '')
			valor = valorID(ObjID) + '*,*' + valor ;
	}
	
	return document.getElementById(ObjID).value = valor;
}

//----------------------------------------------------------------------------//

// Pasa enviar un formulario
function SendForm(ObjID)
{
	return document.getElementById(ObjID).submit()
}

//----------------------------------------------------------------------------//

// Funcion Sleep 
// http://monjes.org/desarrollo-web/5396-funcion-sleep-en-javascript.html
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

//----------------------------------------------------------------------------//

//funcion para darle funcionamiento a la tecla Enter
//onKeyPress="PressT(event)"
function PressT(objeto)
{
    var charCode
  if (navigator.appName=="Netscape")
  	charCode = objeto.which
  else
  	charCode = objeto.keyCode
  
  if(charCode == 13)
  	SendForm('Flogin');
}

// -------------------------------------------------------------------------//

//----------------------------------------------------------------------------//
//------------>> EFECTOS DE DIV
//----------------------------------------------------------------------------//

// Para Hacer el intercambio de color en las tablas
// onMouseOver="FXDiv_1(this,'FBE18C','pointer');" onMouseOut="FXDiv_2(this,'EFEFEF');"

function FXDiv_1(src,color_entrada, puntero)
{
	src.backgroundColor = "#" + color_entrada;
	src.style.cursor = puntero;
}

function FXDiv_2(src,color_default)
{
	src.backgroundColor = "#" + color_default;
	src.style.cursor= "default";
}

//----------------------------------------------------------------------------//
//------------>> FUNCIONES EQUIVALENTES DE PHP
//----------------------------------------------------------------------------//

//function nl2br(str) {
   //return str.replace(/\n/g,"<br>");
//} 


//----------------------------------------------------------------------------//
//------------>> FUNCIONES PARA ENVIAR FORMULARIO POR WAJAX
//----------------------------------------------------------------------------//

// ESTA FUNCION REQUIERE DE LA LIBRERIA php.js (php.default.min.js)
// Sintaxis: FormWajax('guardar.php','cnombre,capellido,cemail');
// Resultado: guardar.php?cemail=Correo&capellido=Apellido&cnombre=Nombre

function FormWajax(url,formulario)
{
	//Variables de la Función
	var camposForm, campo, parametros='';
	
	//Parsear los campos del Formulario
	camposForm = explode(',',formulario);
	
	for(var i in camposForm)
	{
		//Construyendo los parametros de la URL
		campo = camposForm[i] + '=' + urlencode(htmlentities(nl2br(valorID(camposForm[i]))));
		
		if(i == 0)
			parametros = campo + parametros;
		else
			parametros = campo + '&' + parametros;
	}
	
	return url + '?' + parametros;
}
//----------------------------------------------------------------------------//

//----------------------------------------------------------------------------//
//------------>> CAMBIAR COLOR DE TEXTO A UN INPUT (FX ACTIVACI�N)
//----------------------------------------------------------------------------//

// Para hacer el efecto de texto activo y desactivo con texto por default
// onfocus="FXInpur_Activo('cUser','000000');"  onblur="FXInpur_Inactivo('cUser','CCCCCC');"

function FXInpur_Activo(id,color_activo){
	document.getElementById(id).style.color = "#" + color_activo;
	document.getElementById(id).value = '';
}

function FXInpur_Inactivo(id,color_inactivo){
	if(document.getElementById(id).value == '')
	{
		document.getElementById(id).style.color = "#" + color_inactivo;
		document.getElementById(id).value = document.getElementById(id).title;
	}
}

//----------------------------------------------------------------------------//

//----------------------------------------------------------------------------//
//------------>> replace all en Javascript
// http://vhspiceros.blogspot.com/2008/12/replace-all-en-javascript.html
//----------------------------------------------------------------------------//

function replaceAll( text, busca, reemplaza ){
   while (text.toString().indexOf(busca) != -1){
       text = text.toString().replace(busca,reemplaza);
   }
   return text;
}