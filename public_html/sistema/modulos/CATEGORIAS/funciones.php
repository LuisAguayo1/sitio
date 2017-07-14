<?php
	
	class ElementoFnc{
		
		public static function listado_default($db){
			$categorias=$db->query("SELECT * FROM categoria WHERE estatus_categoria=1 ORDER BY id_padre ASC");
			
			while($c=$db->db_row($categorias)){
				if($c["id_padre"]==0){
					$rows[$c["id_categoria"]].='<tr>
								<td><b>'.$c["nombre_categoria"].'</b></td>
								<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'
								<input type="button" value="Editar" 
									onclick="navegar('.$_POST["id_modulo"].',\'EDITAR\','.$c["id_categoria"].')" />':'<i>No disponible</i>').'</td>
								<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'
								<input type="button" value="Eliminar" 
									onclick="if(confirm(\'ELIMINAR ELEMENTO\')){navegar('.$_POST["id_modulo"].',\'ELIMINAR\','.$c["id_categoria"].')}" />':'<i>No disponible</i>').'</td>
							</tr>';
				}else{
					$rows[$c["id_padre"]].='<tr>
								<td>&mdash; '.$c["nombre_categoria"].'</td>
								<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'
								<input type="button" value="Editar" 
									onclick="navegar('.$_POST["id_modulo"].',\'EDITAR\','.$c["id_categoria"].')" />':'<i>No disponible</i>').'</td>
								<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'
								<input type="button" value="Eliminar" 
									onclick="if(confirm(\'ELIMINAR ELEMENTO\')){navegar('.$_POST["id_modulo"].',\'ELIMINAR\','.$c["id_categoria"].')}" />':'<i>No disponible</i>').'</td>
							</tr>';
				}
			}
			
			$resp='<input type="hidden" name="id_elemento" />
					'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'<input type="button" value="+ NUEVA CATEGORÍA" onclick="navegar('.$_POST["id_modulo"].',\'NUEVO\')" />':'').'
					<table>
						<tr class="encabezado">
							<td>CATEGORIA</td>
							<td>EDITAR</td>
							<td>ELIMINAR</td>
						</tr>
						'.implode($rows).'
					</table>';
					
			return $resp;
		}
		
		public static function frm($db,$t){
			
			if($t=='n'){
				$accion="INSERTAR";
				$e["id_categoria"]=0;
			}else{
				$accion="ACTUALIZAR";
				
				$e=$db->db_row($db->query("SELECT * FROM categoria WHERE id_categoria=".$_POST["id_elemento"]));
			}
			
			$padres=$db->query("SELECT * FROM categoria WHERE id_padre=0 AND estatus_categoria=1");
			
			while($p=$db->db_row($padres)){
				$s='';
				if($p["id_categoria"]==$e["id_padre"]){ $s=' selected="selected" '; }
				
				$opt.='<option '.$s.' value="'.$p["id_categoria"].'">'.$p["nombre_categoria"].'</option>';
			}
			
			$resp='<input type="hidden" name="id_elemento" />
					<span>Nombre</span>
					<input type="text" name="nombre" value="'.$e["nombre_categoria"].'" />
					<br /><br />
					<span>Padre</span>
					<select name="padre">
						<option value="0">NINGUNA</option>
						'.$opt.'
					</select>
					<br /><br />
					<input type="button" value="GUARDAR" onclick="validar_categoria('.$_POST["id_modulo"].',\''.$accion.'\','.$e["id_categoria"].')" />';
			
			return $resp;
		}
		
		public static function insertar($db){
			$sql="INSERT INTO categoria VALUES (NULL,".$_POST["padre"].",'".$_POST["nombre"]."',NULL,now(),1)";
			
			if($db->query($sql)){
				return 'SE HA CREADO EL NUEVO ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
		
		public static function actualizar($db){
			$sql="UPDATE categoria SET id_padre=".$_POST["padre"].",nombre_categoria='".$_POST["nombre"]."' WHERE 
					id_categoria=".$_POST["id_elemento"];
			
			if($db->query($sql)){
				return 'SE HA ACTUALIZADO EL ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
		
		public static function eliminar($db){
			$sql="UPDATE categoria SET estatus_categoria=0 WHERE 
					id_categoria=".$_POST["id_elemento"]." OR id_padre=".$_POST["id_elemento"];
			
			if($db->query($sql)){
				return 'SE HA ELIMINADO EL ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
	}
	
?>