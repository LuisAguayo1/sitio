<?php
	
	if(!include_once("./modulos/PRODUCTOS/funciones.php")){
		echo "ERROR";
	}

	class Elemento{
		
		public function contenido($db){
			
			switch($_POST["accion"]){
				case "NUEVO":
					return ElementoFnc::frm($db,'n');
				break;
				
				case "EDITAR":
					return ElementoFnc::frm($db,'e');
				break;
				
				case "INSERTAR":
					return ElementoFnc::insertar($db);
				break;
				
				case "ACTUALIZAR":
					return ElementoFnc::actualizar($db);
				break;
				
				case "ELIMINAR":
					return ElementoFnc::eliminar($db);
				break;
				
				case "CONSULTAR":
					return ElementoFnc::consultar($db);
				break;
				
				default:
					return ElementoFnc::listado_default($db);
				break;
			}
		}
	}
	
?>