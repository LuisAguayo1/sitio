<?php
	
	/**
	* Definición de la clase ContentManager, que controla el contenido HTML mostrado en el sistema.
	* @package core
	* @version 1.0
	*/
	class ContentManager{
		
		/**
		* Define el contenido a mostrar.
		* @param bool $p Permiso de la sesión para acceder al contenido, debe ser FALSE.
		* @param mixed $db Objeto Database.
		* @return string Contenido HTML.
		*/
		public function mostrar($p=FALSE,$db){
			
			if($p==FALSE){
				if(Sesion::$ERROR_SESSION){
					echo '<span class="error_sistema">'.Sesion::$ERROR_SESSION.'</span>';
				}
				return '<form method="post" action="./" name="frm_acceso" id="frm_acceso">
							<span>USUARIO</span>
							<input type="text" name="usr_name" onkeyup="if(event.keyCode==13){ validar(document.frm_acceso.usr_name); validar(document.frm_acceso.usr_pass); document.frm_acceso.submit(); }" />
							<br /><br />
							<span>CONTRASEÑA</span>
							<input type="password" name="usr_pass" onkeyup="if(event.keyCode==13){ validar(document.frm_acceso.usr_name); validar(document.frm_acceso.usr_pass); document.frm_acceso.submit(); }" />
							<br /><br />
							<input type="button" value="INICIAR SESIÓN" onclick="validar(document.frm_acceso.usr_name); validar(document.frm_acceso.usr_pass); document.frm_acceso.submit();" />
						</form>';
			}else{
				return '<form method="post" action="./" name="frm_sistema" id="frm_sistema" enctype="multipart/form-data">
							<input type="hidden" name="accion" />
							<input type="hidden" name="id_modulo" />
							'.$this->menu($db).$this->modulo($db).'
						</form>';
			}
		}
		
		/**
		* Define los elementos del menú.
		* @param mixed $db Objeto Database.
		* @return string Contenido HTML.
		*/
		public function menu($db){
			$modulos = $db->query("SELECT * FROM modulo INNER JOIN permiso 
						ON permiso.id_modulo = modulo.id_modulo 
						WHERE modulo.estatus_modulo = 1 AND permiso.id_perfil = ".$_SESSION['sesion_usuario']['perfil']." 
						ORDER BY modulo.id_modulo,modulo.id_padre");
			
			$submenus = array();
			
			while($m = $db->db_row($modulos)){
				if($m["id_padre"] == 0){
					$menus[$m["id_modulo"]] = '<div class="menu_padre"><span>'.$m["nombre_modulo"].'</span>';
				}else{
					if(file_exists("modulos/".$m["nombre_modulo"]."/main.php")){
						$submenus[$m["id_padre"]] .= '<input type="button" value="'.$m["nombre_modulo"].'" 
											onclick="document.frm_sistema.id_modulo.value=\''.$m["id_modulo"].'\'; document.frm_sistema.submit();" />';
					}
				}
			}
			$db->db_reset($modulos);
			
			while($m = $db->db_row($modulos)){
				if($m["id_padre"] == 0){
					$menus[$m["id_modulo"]] .= $submenus[$m["id_modulo"]].'</div>';
				}
			}
			return '<div id="menu_opener" onclick="toggle_menu();">MENÚ</div><div id="menu">'.implode($menus).'<input type="button" value="CERRAR SESIÓN" onclick="cerrar_sesion();" /></div><div class="clr"></div>';
		}
		
		/**
		* Define el contenido del módulo.
		* @param mixed $db Objeto Database.
		* @return string Contenido HTML.
		*/
		public function modulo($db){
			$_POST["id_modulo"]==''?$_POST["id_modulo"]=61:NULL;
			$_SESSION['sesion_usuario']['permiso_modulo']=1;
			if($_POST["id_modulo"] != ""){
				$modulo = $db->db_row($db->query("SELECT nombre_modulo FROM modulo WHERE id_modulo = '".$_POST["id_modulo"]."'"));
				$_SESSION["nombre_modulo"] = $modulo["nombre_modulo"];
				if(!$modulo){
					$modulo["nombre_modulo"] = ".";
				}
			}else{
				$modulo["nombre_modulo"] = ".";
			}
			
			if($_POST["accion"]==""){ $_POST["accion"]='DEFAULT'; }
			
			include_once('modulos/'.$modulo["nombre_modulo"].'/main.php');
			return '<h1>'.strtoupper($modulo["nombre_modulo"]).' : '.$_POST["accion"].'</h1>'.Elemento::contenido($db);
		}
	}

?>