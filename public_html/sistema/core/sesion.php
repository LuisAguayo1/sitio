<?php
	
	/**
	* Definición de la clase Sesion, que controla la sesión de usuario en el sistema.
	* @package core
	* @version 1.0
	*/
	class Sesion{
		
		public static $ERROR_SESSION=NULL;
		
		/**
		* Valida los datos y mantiene la sesión de usuario.
		* @param mixed $conn Objeto Database.
		* @return bool Regresa TRUE si la sesión ha caducado o FALSE si es válida.
		*/
		function validar($conn){
			if($_POST["accion"]=="cerrar sesion"){
				session_unset();
				session_destroy();
				session_start();
			}
			
			if(isset($_POST['usr_name']) && isset($_POST['usr_pass'])){
				$nusr=$conn->db_cont($conn->query("SELECT id_usuario FROM usuario 
													WHERE acceso_usuario='".$_POST['usr_name']."' 
													AND pass_usuario='".md5($_POST['usr_pass'])."'"));
													
				if($nusr==1){
					$usr=$conn->db_row($conn->query("SELECT * FROM usuario 
													WHERE acceso_usuario='".$_POST['usr_name']."' 
													AND pass_usuario='".md5($_POST['usr_pass'])."'"));
													
					$_SESSION['sesion_usuario']['id']=$usr['id_usuario'];
					$_SESSION['sesion_usuario']['email']=$usr['email_usuario'];
					$_SESSION['sesion_usuario']['perfil']=$usr['id_perfil'];
					
					$conn->query("UPDATE usuario SET id_sesion='".session_id()."' WHERE id_usuario=".$usr["id_usuario"]);
					
					$_SESSION['id']=session_id();
					
					return TRUE;						
				}else{
					self::$ERROR_SESSION='ERROR EN DATOS DE ACCESO';
					return FALSE;
				}
			}
			
			if(isset($_SESSION['id']) && isset($_SESSION['sesion_usuario']['id'])){
				$us=$conn->db_row($conn->query("SELECT id_sesion,id_perfil FROM usuario WHERE id_usuario=".$_SESSION['sesion_usuario']['id']));
				$_SESSION['id']=$us["id_sesion"];
				
				$tipo=$conn->db_row($conn->query("SELECT tipo_permiso FROM permiso WHERE id_perfil=".$us["id_perfil"]." 
												AND id_modulo=".$_POST["id_modulo"]));
												
				$_SESSION['sesion_usuario']['permiso_modulo']=$tipo["tipo_permiso"];
			}
						
			if($_SESSION['id']!=session_id()){
				if(session_id()!=0 && $_SESSION['id']!=""){
					self::$ERROR_SESSION='SE HA INICIADO SESIÓN DESDE OTRA UBICACIÓN';
				}
				session_unset();
				session_destroy();
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}

?>