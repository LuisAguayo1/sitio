<?php
	
	include_once("ext/image.class.php");
	
	class ElementoFnc{
		
		public static function listado_default($db){
			$productos=$db->query("SELECT * FROM producto INNER JOIN categoria ON producto.id_categoria=categoria.id_categoria 
								WHERE producto.estatus_producto=1 AND categoria.estatus_categoria=1 
								ORDER BY producto.clave_producto ASC");
								
			if($_POST["buscar"]!=""){
				$productos=$db->query("SELECT * FROM producto INNER JOIN categoria ON producto.id_categoria=categoria.id_categoria 
								WHERE producto.estatus_producto=1 AND categoria.estatus_categoria=1 
								AND (producto.nombre_producto LIKE '%".$_POST["buscar"]."%' OR 
								producto.clave_producto LIKE '%".$_POST["buscar"]."%' OR 
								categoria.nombre_categoria LIKE '%".$_POST["buscar"]."%') 
								ORDER BY producto.clave_producto ASC");
			}
			
			while($e=$db->db_row($productos)){
				$rows.='<tr>
							<td>
								<b>'.$e["clave_producto"].'</b> &mdash; '.$e["nombre_producto"].'<br />
								'.$e["nombre_categoria"].'
							</td>
							<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'
							<input type="button" value="Editar" 
									onclick="navegar('.$_POST["id_modulo"].',\'EDITAR\','.$e["id_producto"].')" />':'
							<input type="button" value="Consultar" 
									onclick="navegar('.$_POST["id_modulo"].',\'CONSULTAR\','.$e["id_producto"].')" />
									').'</td>
							<td>'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'
							<input type="button" value="Eliminar" 
									onclick="if(confirm(\'ELIMINAR ELEMENTO\')){navegar('.$_POST["id_modulo"].',\'ELIMINAR\','.$e["id_producto"].')}" />':'<i>No disponible</i>').'</td>
						</tr>';
			}
			
			$resp='<input type="hidden" name="id_elemento" />
					'.($_SESSION['sesion_usuario']['permiso_modulo']==1?'
					<input type="button" value="+ NUEVO PRODUCTO" onclick="navegar('.$_POST["id_modulo"].',\'NUEVO\')" />':'').'
					<br /><br />
					<input type="text" name="buscar" placeholder="Buscar producto..." />
					<input type="button" value="BUSCAR" 
					onclick="validar(document.frm_sistema.buscar); navegar('.$_POST["id_modulo"].',\'BUSCAR\')" />
					<table>
						<tr class="encabezado">
							<td>PRODUCTO</td>
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
				$e["id_producto"]=0;
			}else{
				$accion="ACTUALIZAR";
				
				$e=$db->db_row($db->query("SELECT * FROM producto WHERE id_producto=".$_POST["id_elemento"]));
				
				$imagenes=$db->query("SELECT * FROM producto_imagen WHERE estatus_imagen=1 AND id_producto=".$e["id_producto"]);
				
				$img_chk='<br /><br /><br /><span>Imágenes actuales</span><br />';
				while($im=$db->db_row($imagenes)){
					$img_chk.='<div class="galeria">
							<img height="120px" src="'.$im["ruta_imagen"].'" alt="" /><br />
							<b>'.$im["descripcion_imagen"].'</b><br />
							<input type="checkbox" name="img_'.$im["id_imagen"].'" /> MARCAR PARA ELIMINACIÓN
							</div>';
				}
			}
			
			$categorias=$db->query("SELECT * FROM categoria WHERE estatus_categoria=1");
			
			while($p=$db->db_row($categorias)){
				$s='';
				if($p["id_categoria"]==$e["id_categoria"]){ $s=' selected="selected" '; }
				
				if($p["id_padre"]==0){
					$opt[$p["id_categoria"]].='</optgroup><optgroup label="'.$p["nombre_categoria"].'">';
				}else{
					$opt[$p["id_padre"]].='<option '.$s.' value="'.$p["id_categoria"].'">'.$p["nombre_categoria"].'</option>';
				}
			}
			
			$resp='<input type="hidden" name="id_elemento" />
					<span>Nombre de Producto</span>
					<input type="text" name="nombre" value="'.$e["nombre_producto"].'" />
					<br /><br />
					<span>Clave de Producto</span>
					<input type="text" name="clave" value="'.$e["clave_producto"].'" />
					<br /><br />
					<span>Precio de Producto</span>
					<input type="text" name="precio" value="'.$e["precio_producto"].'" /> ($ MXN)
					<br /><br />
					<span>Existencia (Unidades)</span>
					<input type="text" name="existencia" value="'.$e["existencia_producto"].'" /> U.
					<br /><br />
					<span>Categoria</span>
					<select name="categoria">
						<optgroup>
						'.implode($opt).'
						</optgroup>
					</select>
					<br /><br />
					<span style="float:left;">Descripcion de Producto</span>
					<textarea rows="8" name="descripcion">'.$e["descripcion_producto"].'</textarea>
					<br /><br />
					<span>Imágenes</span>
					<br /><br />
					Imagen 1 <input type="file" name="img_1" /> Pie de Foto <input type="text" name="imgtxt_1" />
					<div id="imagenes">
					
					</div>
					<br />
					<input type="button" value="AGREGAR OTRA IMAGEN" onclick="agregar_imagen();" />
					'.$img_chk.'
					<div class="clr"></div>
					<br /><br />
					<input type="button" value="GUARDAR" onclick="validar_producto('.$_POST["id_modulo"].',\''.$accion.'\','.$e["id_producto"].')" />';
			
			return $resp;
		}
		
		public static function insertar($db){
			$sql="INSERT INTO producto VALUES (NULL,".$_POST["categoria"].",'".$_POST["nombre"]."','".$_POST["clave"]."','".$_POST["descripcion"]."',".$_POST["precio"].",".$_POST["existencia"].",0,now(),1)";
						
			if($db->query($sql)){
				$idp=$db->db_id();
				$i=1;
				foreach($_FILES as $file){
					if($file["name"]!="" && (stristr($file["name"],"png") || stristr($file["name"],"jpg"))){
						$ruta = "cargas/productos/".$file["name"];
					
						$img = new image;
						$img->source($file);
						$img->resize(800,NULL);
						$img->create($ruta,75);
						
						$db->query("INSERT INTO producto_imagen VALUES 
									(NULL,".$idp.",'".$ruta."','".$_POST["imgtxt_".$i]."',now(),1)");
						$i++;
					}
				}
				
				return 'SE HA CREADO EL NUEVO ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
		
		public static function actualizar($db){
			
			$sql="UPDATE producto SET id_categoria=".$_POST["categoria"].",nombre_producto='".$_POST["nombre"]."',
					clave_producto='".$_POST["clave"]."',precio_producto='".$_POST["precio"]."', 
					existencia_producto='".$_POST["existencia"]."', descripcion_producto='".$_POST["descripcion"]."' WHERE 
					id_producto=".$_POST["id_elemento"];
			
			if($db->query($sql)){
				$idp=$_POST["id_elemento"];
				$i=1;
				foreach($_FILES as $file){
					if($file["name"]!="" && (stristr($file["name"],"png") || stristr($file["name"],"jpg"))){
						$ruta = "cargas/productos/".$file["name"];
					
						$img = new image;
						$img->source($file);
						$img->resize(800,NULL);
						$img->create($ruta,75);
						
						$db->query("INSERT INTO producto_imagen VALUES 
									(NULL,".$idp.",'".$ruta."','".$_POST["imgtxt_".$i]."',now(),1)");
						$i++;
					}
				}
				
				$imagenes=$db->query("SELECT * FROM producto_imagen WHERE id_producto=".$_POST["id_elemento"]);
				
				while($im=$db->db_row($imagenes)){
					if($_POST["img_".$im["id_imagen"]]=="on" || 
					$_POST["img_".$im["id_imagen"]]=="true" || 
					$_POST["img_".$im["id_imagen"]]=="checked"){
						$db->query("UPDATE producto_imagen SET estatus_imagen=0 WHERE estatus_imagen=1 AND id_imagen=".$im["id_imagen"]);
					}
				}
				
				return 'SE HA ACTUALIZADO EL ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
		
		public static function eliminar($db){
			$sql="UPDATE producto SET estatus_producto=0 WHERE id_producto=".$_POST["id_elemento"];
			
			if($db->query($sql)){
				return 'SE HA ELIMINADO EL ELEMENTO<br />'.self::listado_default($db);
			}else{
				return 'HA OCURRIDO UN ERROR<br />'.self::listado_default($db);
			}
		}
		
		public static function consultar($db){
			
			$e=$db->db_row($db->query("SELECT * FROM producto WHERE id_producto=".$_POST["id_elemento"]));
				
			$imagenes=$db->query("SELECT * FROM producto_imagen WHERE estatus_imagen=1 AND id_producto=".$e["id_producto"]);
			
			$img_chk='<br /><br /><br /><span>Imágenes actuales</span><br />';
			while($im=$db->db_row($imagenes)){
				$img_chk.='<div class="galeria">
						<img height="120px" src="'.$im["ruta_imagen"].'" alt="" /><br />
						<b>'.$im["descripcion_imagen"].'</b><br />
						</div>';
			}
			
			$cat=$db->db_row($db->query("SELECT * FROM categoria WHERE id_categoria=".$e["id_categoria"]));
			
			$resp='<input type="hidden" name="id_elemento" />
					<span>Nombre de Producto</span>
					'.$e["nombre_producto"].'
					<br /><br />
					<span>Clave de Producto</span>
					'.$e["clave_producto"].'
					<br /><br />
					<span>Precio de Producto</span>
					$ '.$e["precio_producto"].' MXN
					<br /><br />
					<span>Existencia (Unidades)</span>
					'.$e["existencia_producto"].' Unidades
					<br /><br />
					<span>Categoria</span>
					'.$cat["nombre_categoria"].'
					<br /><br />
					<span style="float:left;">Descripcion de Producto</span><br />
					<p>'.$e["descripcion_producto"].'</p>
					<br /><br />
					'.$img_chk.'
					<div class="clr"></div>
					<br /><br />
					<input type="button" value="REGRESAR" onclick="navegar('.$_POST["id_modulo"].',\'DEFAULT\',0)" />';
			
			return $resp;
		}
	}
	
?>