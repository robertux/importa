<?php

/***********************************************************************

  Copyright (C) 2007-2008  Mauricio Zarceño (wichox@gmail.com)

  This file is part of Wclass.

  Wclass is free software; you can redistribute it and/or modify it
  under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 2 of the License,
  or (at your option) any later version.

  Wclass is distributed in the hope that it will be useful, but
  WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston,
  MA  02111-1307  USA


//////////////////////////////////////////////////////////////////////////
//																		//
//           Estos script te facilitaran el desarrollo web              //
//				 son muy simples de usar e implementar.					//
//																		//
//		Wclass v0.23	04/04/2008	  								    //
//		Scripts desarrollados por :  								    //
//		Mauricio Zarceño (Wichox) wichox@gmail.com						//
//		"El Mundo es Binario... nadies es Dueño Todos Propietarios."	//
//																		//
//			----------		HECHO EN EL SALVADOR	---------- 			//	
//                         Copyright (C) 2007-2008						//																					//
//////////////////////////////////////////////////////////////////////////

************************************************************************/

// $WPath -> es la ruta para que leea el direcctorio para poder usarlo desde varios destinos

$dir=opendir($Path."php");
while ($archivo=readdir($dir))
if ($archivo!="." && $archivo!=".." && $archivo!="clases.php" && $archivo!="Wconfig")
include_once($archivo);
closedir($dir);
?>
