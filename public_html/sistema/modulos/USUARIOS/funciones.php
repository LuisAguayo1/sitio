<?php
	
	class ElementoFnc{
		
		public static function listado_default($db){			
			$usuarios=$db->query("SELECT * FROM usuario INNER JOIN perfil ON usuario.id_perfil=perfil.id_perfil 
								WHERE usuario.estatus_usuario=1 ORDER BY usuario.id_usuario DESC");
								
			if($_POST["buscar"]!=""){
				$usuarios=$db->query("SELECT * FROM usuario INNER JOIN perfil ON usuario.id_perfil=perfil.id_perfil 
								AND (usuario.acceso_usuario LIKE '%".$_POST["buscar"]."%' OR 
								usuario.email_usuario LIKE '%".$_POST["buscar"]."%' OR 
								perfil.nombre_perfil LIKE '%".$_POST["buscar"]."%') 
								WHERE usuario.estatus_usuario=1 ORDER BY usuario.id_usuario DESC");
			}
			
			while($e=$db->db_row($usuarios)){
				$rows.='<tr>
							<td>
								<b>'.$e["acceso_usuario"].'</b> &mdash; '.$e["nombre_perfil"].'<br />
								'.$e["email_usuario"].'
							</td>
							<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'<input type="button" value="Editar" 
									onclick="navegar('.$_POST["id_modulo"].',\'EDITAR\','.$e["id_usuario"].')" />':'<i>No disponible</i>').'</td>
							<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'<input type="button" value="Eliminar" 
									onclick="if(confirm(\'ELIMINAR ELEMENTO\')){navegar('.$_POST["id_modulo"].',\'ELIMINAR\','.$e["id_usuario"].')}" />':'<i>No disponible</i>').'</td>
						</tr>';
			}
			
			$resp='<input type="hidden" name="id_elemento" />
					<input type="button" value="+ NUEVO USUARIO" onclick="navegar('.$_POST["id_modulo"].',\'NUEVO\')" />
					<br /><br />
					<input type="text" name="buscar" placeholder="Buscar por nombre o email..." />
					<input type="button" value="BUSCAR" 
					onclick="validar(document.frm_sistema.buscar); navegar('.$_POST["id_modulo"].',\'BUSCAR\')" />
					<table>
						<tr class="encabezado">
							<td>USUARIO</td>
							<td>EDITAR</td>
							<td>ELIMINAR</td>
						</tr>
						'.$rows.'
					</table>';
					
			return $resp;
		}
		
		public static function frm($db,$t){
			
			if($t=='n'){
				$accion="INSERTAR";
				$e["id_usuario"]=0;
			}else{
				$accion="ACTUALIZAR";
				
				$e=$db->db_row($db->query("SELECT * FROM usuario WHERE id_usuario=".$_POST["id_elemento"]));
			}
			
			$perfils=$db->query("SELECT * FROM perfil WHERE estatus_perfil=1");
			
			while($p=$db->db_row($perfils)){
				$s='';
				if($p["id_perfil"]==$e["id_perfil"]){ $s=' selected="selected" '; }
				
				$opt.='<option '.$s.' value="'.$p["id_perfil"].'">'.$p["nombre_perfil"].'</option>';
			}
			
			$resp='<input type="hidden" name="id_elemento" />
					<span>Nombre de Acceso</span>
					<input type="text" name="nombre" value="'.$e["acceso_usuario"].'" />
					<br /><br />
					<span>Email</span>
					<input type="text" name="email" value="'.$e["email_usuario"].'" />
					<br /><br />
					<span>Contraseña</span>
					<input type="password" name="pass" />
					<br />
					<span>Confirmar Contraseña</span>
					<input type="password" name="passc" />
					<br /><br />
					<span>Perfil</span>
					<select name="perfil">
						'.$opt.'
					</select>
					<br /><br />
					<input type="button" value="GUARDAR" onclick="validar_usuario('.$_POST["id_modulo"].',\''.$accion.'\','.$e["id_usuario"].')" />';
			
			return $resp;
		}
		
		public static function insertar($db){
			$sql="INSERT INTO usuario VALUES (NULL,'".$_POST["nombre"]."','".md5($_POST["pass"])."',".$_POST["perfil"].",MD5(now()),'".$_POST["email"]."',now(),now(),1)";
			
			if($db->query($sql)){
				return 'SE HA CREADO EL NUEVO ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
		
		public static function actualizar($db){
			
			if($_POST["pass"]!=""){
				$pass=",pass_usuario='".md5($_POST["pass"])."' ";
			}
			
			$sql="UPDATE usuario SET id_perfil=".$_POST["perfil"].",acceso_usuario='".$_POST["nombre"]."' ".$pass." WHERE 
					id_usuario=".$_POST["id_elemento"];
			
			if($db->query($sql)){
				return 'SE HA ACTUALIZADO EL ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
		
		public static function eliminar($db){
			$sql="UPDATE usuario SET estatus_usuario=0 WHERE id_usuario=".$_POST["id_elemento"];
			
			if($db->query($sql)){
				return 'SE HA ELIMINADO EL ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
	}
	
?>