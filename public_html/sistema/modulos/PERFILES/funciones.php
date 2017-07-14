<?php
	
	class ElementoFnc{
		
		public static function listado_default($db){
			$perfils=$db->query("SELECT * FROM perfil WHERE estatus_perfil=1 ORDER BY id_perfil ASC");
			
			while($c=$db->db_row($perfils)){
				$rows.='<tr>
							<td>'.$c["nombre_perfil"].'</td>
							<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'<input type="button" value="Editar" 
								onclick="navegar('.$_POST["id_modulo"].',\'EDITAR\','.$c["id_perfil"].')" />':'<i>No disponible</i>').'</td>
							<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'<input type="button" value="Eliminar" 
								onclick="if(confirm(\'ELIMINAR ELEMENTO\')){navegar('.$_POST["id_modulo"].',\'ELIMINAR\','.$c["id_perfil"].')}" />':'<i>No disponible</i>').'</td>
						</tr>';
			}
			
			$resp='<input type="hidden" name="id_elemento" />
					<input type="button" value="+ NUEVO PERFIL" onclick="navegar('.$_POST["id_modulo"].',\'NUEVO\')" />
					<table>
						<tr class="encabezado">
							<td>PERFIL</td>
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
				$e["id_perfil"]=0;
			}else{
				$accion="ACTUALIZAR";
				
				$e=$db->db_row($db->query("SELECT * FROM perfil WHERE id_perfil=".$_POST["id_elemento"]));
			}
			
			$modulos=$db->query("SELECT * FROM modulo WHERE estatus_modulo=1 ORDER BY id_padre,id_modulo");
			
			while($m=$db->db_row($modulos)){
				
				$ch='';
				$permiso=$db->db_cont($db->query("SELECT * FROM permiso 
												WHERE id_perfil=".$e["id_perfil"]." AND id_modulo=".$m["id_modulo"]));
												
				if($permiso==1){
					$ch=' checked="checked" ';
				}
				
				$tipo=$db->db_row($db->query("SELECT tipo_permiso FROM permiso 
												WHERE id_perfil=".$e["id_perfil"]." AND id_modulo=".$m["id_modulo"]));
				
				$tp='';
				if($tipo["tipo_permiso"]!=""){						
					$tp[$tipo["tipo_permiso"]]=' selected="selected" ';
				}
				
				if($m["id_padre"]==0){
				$chks[$m["id_modulo"]].='<br /><input '.$ch.' type="checkbox" name="mod_'.$m["id_modulo"].'">'.$m["nombre_modulo"].'
				<select name="tipo_'.$m["id_modulo"].'">
					<option '.$tp[1].' value="1">Manipulación y Consulta</option>
					<option '.$tp[2].' value="2">Sólo Consulta</option>
				</select>
				<br />';
				}else{
				$chks[$m["id_padre"]].='<input '.$ch.' type="checkbox" name="mod_'.$m["id_modulo"].'">&mdash;'.$m["nombre_modulo"].'
				<select name="tipo_'.$m["id_modulo"].'">
					<option '.$tp[1].' value="1">Manipulación y Consulta</option>
					<option '.$tp[2].' value="2">Sólo Consulta</option>
				</select>
				<br />';
				}
			}
			
			$resp='<input type="hidden" name="id_elemento" />
					<span>Nombre</span>
					<input type="text" name="nombre" value="'.$e["nombre_perfil"].'" />
					<br /><br />
					<span>Permisos</span><br />
					'.implode($chks).'
					<br /><br />
					<input type="button" value="GUARDAR" onclick="validar_perfil('.$_POST["id_modulo"].',\''.$accion.'\','.$e["id_perfil"].')" />';
			
			return $resp;
		}
		
		public static function insertar($db){
			$sql="INSERT INTO perfil VALUES (NULL,'".$_POST["nombre"]."',now(),1)";
			
			if($db->query($sql)){
				
				$idp=$db->db_id();
				$i=0;
				$modulos=$db->query("SELECT * FROM modulo ORDER BY id_padre,id_modulo");
			
				while($m=$db->db_row($modulos)){
					if($_POST["mod_".$m["id_modulo"]]=="on" || 
						$_POST["mod_".$m["id_modulo"]]=="true" || 
						$_POST["mod_".$m["id_modulo"]]=="checked"){
							$sqlm="INSERT INTO permiso VALUES (NULL,".$idp.",".$m["id_modulo"].",".$_POST["tipo_".$m["id_modulo"]].")";
							$db->query($sqlm);
							$i++;
						}
				}
				
				return 'SE HA CREADO EL NUEVO ELEMENTO CON '.$i.' PERMISOS<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
		
		public static function actualizar($db){
			$sql="UPDATE perfil SET nombre_perfil='".$_POST["nombre"]."' WHERE 
					id_perfil=".$_POST["id_elemento"];
			
			if($db->query($sql)){
				
				$idp=$_POST["id_elemento"];
				$i=0;
				$db->query("DELETE FROM permiso WHERE id_perfil=".$idp);
				$modulos=$db->query("SELECT * FROM modulo ORDER BY id_padre,id_modulo");
			
				while($m=$db->db_row($modulos)){
					if($_POST["mod_".$m["id_modulo"]]=="on" || 
						$_POST["mod_".$m["id_modulo"]]=="true" || 
						$_POST["mod_".$m["id_modulo"]]=="checked"){
							$sqlm="INSERT INTO permiso VALUES (NULL,".$idp.",".$m["id_modulo"].",".$_POST["tipo_".$m["id_modulo"]].")";
							$db->query($sqlm);
							$i++;
						}
				}
				
				return 'SE HA ACTUALIZADO EL ELEMENTO CON '.$i.' PERMISOS<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
		
		public static function eliminar($db){
			$sql="UPDATE perfil SET estatus_perfil=0 WHERE 
					id_perfil=".$_POST["id_elemento"]." OR id_perfil=".$_POST["id_elemento"];
			
			if($db->query($sql)){
				return 'SE HA ELIMINADO EL ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
	}
	
?>