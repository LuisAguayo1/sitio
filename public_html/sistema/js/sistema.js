var _LANG="es"
var _VALDAR_ERROR;

function ajax_simple(ruta,contenedor,metodo,datos,alertar,refresh,callback){
	try{
		document.getElementById(contenedor).innerHTML='<img src="imagenes/loader.gif" width="40px" style="opacity:0.8; display:block;margin:12px auto 12px auto;" alt="..." onclick="try{document.body.removeChild(_MODAL);}catch(e){}" />';
	}catch(err){}
	
	if(window.XMLHttpRequest){
	  xmlhttp=new XMLHttpRequest();
	}else{
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open(metodo,ruta,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(datos);
	
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			if(alertar==true){
				alert(xmlhttp.responseText);
			}else{
				document.getElementById(contenedor).innerHTML=xmlhttp.responseText;
			}
			if(refresh==true){
				setTimeout('location.reload();',500);
			}
			try{
				callback();
			}catch(err){}
		}
	}
}

function validar(campo,tipo){
	_VALIDAR_ERROR='';
	if(campo.type=="text" || campo.type=="password" || campo.type=="hidden" || 
		campo.type=="tel" || campo.type=="number"  || campo.tagName == "TEXTAREA" ){
		
		campo.value = unescape(campo.value);
		campo.value=campo.value.replace(/'/gi,"&lsquo;");
		campo.value=campo.value.replace(/"/gi,"&quot;");
		campo.value=campo.value.replace(/</gi,"&lt;");
		campo.value=campo.value.replace(/>/gi,"&gt;");
	}
	if(campo.type=="number" || tipo=="numero"){
		var regn = /^([0-9_\.\-]{6,14})/;
		if(!regn.test(campo.value)){
			campo.value="";
			if(_LANG=="es"){
				_VALIDAR_ERROR="Debe escribir sólamente números (se admite guión y punto)";
			}else{
				_VALIDAR_ERROR="Only numbers are allowed";
			}
		}
	}
	
	if(tipo=="email" || campo.type=="email"){
		var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!reg.test(campo.value)){
			campo.value="";
			if(_LANG=="es"){
				_VALIDAR_ERROR="Formato de email no válido";
			}else{
				_VALIDAR_ERROR="Invalid email format";
			}
		}
	}
	
	if(campo.value!=""){
		return true;
	}else{
		campo.focus();
		return false;
	}
}

function cerrar_sesion(){
	document.frm_sistema.accion.value="cerrar sesion";
	document.frm_sistema.submit();
}

function navegar(modulo,accion,elemento){
	try{
		document.frm_sistema.id_elemento.value=elemento;
	}catch(err){}
	document.frm_sistema.id_modulo.value=modulo;
	document.frm_sistema.accion.value=accion;
	document.frm_sistema.submit();
}

function validar_categoria(modulo,accion,elemento){
	if(validar(document.frm_sistema.nombre)){
		navegar(modulo,accion,elemento);
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

function validar_usuario(modulo,accion,elemento){
	if(validar(document.frm_sistema.nombre) && 
	validar(document.frm_sistema.email)){
		if(accion=="INSERTAR" && validar(document.frm_sistema.pass) && 
		document.frm_sistema.pass.value==document.frm_sistema.passc.value){
			navegar(modulo,accion,elemento);
		}else if(accion=="ACTUALIZAR" && document.frm_sistema.pass.value==document.frm_sistema.passc.value){
			navegar(modulo,accion,elemento);
		}else{
			alert("CONTRASEÑAS NO VALIDAS");
		}
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

function validar_perfil(modulo,accion,elemento){
	if(validar(document.frm_sistema.nombre)){
		navegar(modulo,accion,elemento);
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

var _IMAGENES=1;

function agregar_imagen(){
	_IMAGENES++;
	var contenedor=document.createElement("div");
	contenedor.innerHTML='Imagen '+_IMAGENES+' <input type="file" name="img_'+_IMAGENES+'" /> Pie de Foto <input type="text" name="imgtxt_'+_IMAGENES+'" />';
	document.getElementById("imagenes").appendChild(contenedor);
}

function validar_producto(modulo,accion,elemento){
	if(validar(document.frm_sistema.nombre) && validar(document.frm_sistema.descripcion) && validar(document.frm_sistema.clave)){
		navegar(modulo,accion,elemento);
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

function validar_articulo(modulo,accion,elemento){
	if(validar(document.frm_sistema.titulo) && validar(document.frm_sistema.resumen)){
		navegar(modulo,accion,elemento);
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

function validar_noticia(modulo,accion,elemento){
	if(validar(document.frm_sistema.titulo) && validar(document.frm_sistema.resumen)){
		navegar(modulo,accion,elemento);
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

function validar_galeria(modulo,accion,elemento){
	if(validar(document.frm_sistema.titulo) && validar(document.frm_sistema.descripcion)){
		navegar(modulo,accion,elemento);
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

function detalles_pedido(idp){
	if(document.getElementById("detalle_"+idp).style.display=="none"){
		document.getElementById("detalle_"+idp).style.display="table";
	}else{
		document.getElementById("detalle_"+idp).style.display="none";
	}
}

function validar_tema(modulo,accion,elemento){
	if(validar(document.frm_sistema.nombre)){
		navegar(modulo,accion,elemento);
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

function validar_concepto(modulo,accion,elemento){
	if(validar(document.frm_sistema.nombre)){
		navegar(modulo,accion,elemento);
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

function validar_clienteagenda(modulo,accion,elemento){
	if(validar(document.frm_sistema.nombre) && validar(document.frm_sistema.email) && validar(document.frm_sistema.telefono) && validar(document.frm_sistema.direccion) && validar(document.frm_sistema.descripcion)){
		navegar(modulo,accion,elemento);
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}

var _LIMITE_MES=new Array(31,28,31,30,31,30,31,31,30,31,30,31);

function validar_cita(modulo,accion,elemento){
	if(validar(document.frm_sistema.asunto) && validar(document.frm_sistema.descripcion) && 
		validar(document.frm_sistema.dia) && validar(document.frm_sistema.mes) && 
		validar(document.frm_sistema.anio)){
			var exp=/[0-9]/;
			if(exp.test(document.frm_sistema.dia.value) && exp.test(document.frm_sistema.mes.value) && 
				exp.test(document.frm_sistema.anio.value) && exp.test(document.frm_sistema.hora.value) && 
				exp.test(document.frm_sistema.minuto.value)){
					
					var fecha=new Date();
					if(document.frm_sistema.anio.value<fecha.getFullYear()){
						alert("EL AÑO ESPECIFICADO NO PUEDE SER MENOR AL AÑO ACTUAL");
						return
					}
					if(document.frm_sistema.mes.value>12 || document.frm_sistema.mes.value<1){
						alert("EL MES ESPECIFICADO NO PUEDE SER MAYOR A 12 NI MENOR A 1");
						return
					}
					if(document.frm_sistema.dia.value>_LIMITE_MES[document.frm_sistema.mes.value] || document.frm_sistema.dia.value<1){
						alert("EL DIA ESPECIFICADO NO PUEDE SER MAYOR A "+_LIMITE_MES[document.frm_sistema.mes.value]+" NI MENOR A 1");
						return
					}
				
					navegar(modulo,accion,elemento);
			}else{
				alert("EL FORMATO DE HORA Y FECHA DEBE SER NUMÉRICO");
			}
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS")
	}
}


function validar_proyecto_nuevo(modulo,accion,elemento){
	if(validar(document.frm_sistema.titulo) && 
		validar(document.frm_sistema.dia_ini) && validar(document.frm_sistema.mes_ini) && 
		validar(document.frm_sistema.anio_ini) && validar(document.frm_sistema.dia_fin) && 
		validar(document.frm_sistema.mes_fin) && validar(document.frm_sistema.anio_fin)){
			if(document.frm_sistema.cliente_tipo.value=="nuevo"){
				if(validar(document.frm_sistema.nombre_cliente) && validar(document.frm_sistema.email_cliente) && 
					validar(document.frm_sistema.direccion_cliente) && validar(document.frm_sistema.telefono_cliente) && 
					validar(document.frm_sistema.descripcion_cliente)){}else{
						alert("FAVOR DE LLENAR TODOS LOS CAMPOS PARA EL NUEVO CLIENTE");
						return
				}
			}
			
			var exp=/[0-9]/;
			if(exp.test(document.frm_sistema.dia_ini.value) && exp.test(document.frm_sistema.mes_ini.value) && 
				exp.test(document.frm_sistema.anio_ini.value) && exp.test(document.frm_sistema.dia_fin.value) && 
				exp.test(document.frm_sistema.mes_fin.value) && exp.test(document.frm_sistema.anio_fin.value)){
					
					var fecha=new Date();
					if(document.frm_sistema.anio_ini.value<fecha.getFullYear()){
						alert("EL AÑO DE INICIO ESPECIFICADO NO PUEDE SER MENOR AL AÑO ACTUAL");
						return
					}
					if(document.frm_sistema.anio_fin.value<fecha.getFullYear()){
						alert("EL AÑO DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MENOR AL AÑO ACTUAL");
						return
					}
					if(document.frm_sistema.mes_ini.value>12 || document.frm_sistema.mes_ini.value<1){
						alert("EL MES DE INICIO ESPECIFICADO NO PUEDE SER MAYOR A 12 NI MENOR A 1");
						return
					}
					if(document.frm_sistema.mes_fin.value>12 || document.frm_sistema.mes_fin.value<1){
						alert("EL MES DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MAYOR A 12 NI MENOR A 1");
						return
					}
					if(document.frm_sistema.dia_ini.value>_LIMITE_MES[document.frm_sistema.mes_ini.value] || 
						document.frm_sistema.dia_ini.value<1){
							
						alert("EL DIA DE INICIO ESPECIFICADO NO PUEDE SER MAYOR A "+_LIMITE_MES[document.frm_sistema.mes_ini.value]+" NI MENOR A 1");
						return
					
					}
					if(document.frm_sistema.dia_fin.value>_LIMITE_MES[document.frm_sistema.mes_fin.value] || 
						document.frm_sistema.dia_fin.value<1){
							
						alert("EL DIA DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MAYOR A "+_LIMITE_MES[document.frm_sistema.mes_ini.value]+" NI MENOR A 1");
						return
					}
					
					if(document.frm_sistema.anio_fin.value<document.frm_sistema.anio_ini.value){
						alert("LA FECHA DE FINALIZACIÓN NO PUEDE SER MENOR A LA FECHA DE INICIO");
						return
					}
					if(document.frm_sistema.mes_fin.value<document.frm_sistema.mes_ini.value && 
					document.frm_sistema.anio_fin.value==document.frm_sistema.anio_ini.value){
						alert("LA FECHA DE FINALIZACIÓN NO PUEDE SER MENOR A LA FECHA DE INICIO");
						return
					}
					if(document.frm_sistema.dia_fin.value<document.frm_sistema.dia_ini.value && 
					document.frm_sistema.mes_fin.value==document.frm_sistema.mes_ini.value && 
					document.frm_sistema.anio_fin.value==document.frm_sistema.anio_ini.value){
						alert("LA FECHA DE FINALIZACIÓN NO PUEDE SER MENOR A LA FECHA DE INICIO");
						return
					}
				
					navegar(modulo,accion,elemento);
			}else{
				alert("EL FORMATO DE HORA Y FECHA DEBE SER NUMÉRICO");
			}
			
		}else{
			alert("FAVOR DE LLENAR TODOS LOS CAMPOS");
		}
}

function validar_proyecto(modulo,accion,elemento){
	if(validar(document.frm_sistema.titulo) && 
		validar(document.frm_sistema.dia_ini) && validar(document.frm_sistema.mes_ini) && 
		validar(document.frm_sistema.anio_ini) && validar(document.frm_sistema.dia_fin) && 
		validar(document.frm_sistema.mes_fin) && validar(document.frm_sistema.anio_fin)){
						
			var exp=/[0-9]/;
			if(exp.test(document.frm_sistema.dia_ini.value) && exp.test(document.frm_sistema.mes_ini.value) && 
				exp.test(document.frm_sistema.anio_ini.value) && exp.test(document.frm_sistema.dia_fin.value) && 
				exp.test(document.frm_sistema.mes_fin.value) && exp.test(document.frm_sistema.anio_fin.value)){
					
					var fecha=new Date();
					if(document.frm_sistema.anio_ini.value<fecha.getFullYear()){
						alert("EL AÑO DE INICIO ESPECIFICADO NO PUEDE SER MENOR AL AÑO ACTUAL");
						return
					}
					if(document.frm_sistema.anio_fin.value<fecha.getFullYear()){
						alert("EL AÑO DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MENOR AL AÑO ACTUAL");
						return
					}
					if(document.frm_sistema.mes_ini.value>12 || document.frm_sistema.mes_ini.value<1){
						alert("EL MES DE INICIO ESPECIFICADO NO PUEDE SER MAYOR A 12 NI MENOR A 1");
						return
					}
					if(document.frm_sistema.mes_fin.value>12 || document.frm_sistema.mes_fin.value<1){
						alert("EL MES DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MAYOR A 12 NI MENOR A 1");
						return
					}
					if(document.frm_sistema.dia_ini.value>_LIMITE_MES[document.frm_sistema.mes_ini.value] || 
						document.frm_sistema.dia_ini.value<1){
							
						alert("EL DIA DE INICIO ESPECIFICADO NO PUEDE SER MAYOR A "+_LIMITE_MES[document.frm_sistema.mes_ini.value]+" NI MENOR A 1");
						return
					
					}
					if(document.frm_sistema.dia_fin.value>_LIMITE_MES[document.frm_sistema.mes_fin.value] || 
						document.frm_sistema.dia_fin.value<1){
							
						alert("EL DIA DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MAYOR A "+_LIMITE_MES[document.frm_sistema.mes_ini.value]+" NI MENOR A 1");
						return
					}
					
					if(document.frm_sistema.anio_fin.value<document.frm_sistema.anio_ini.value){
						alert("LA FECHA DE FINALIZACIÓN NO PUEDE SER MENOR A LA FECHA DE INICIO");
						return
					}
					if(document.frm_sistema.mes_fin.value<document.frm_sistema.mes_ini.value && 
					document.frm_sistema.anio_fin.value==document.frm_sistema.anio_ini.value){
						alert("LA FECHA DE FINALIZACIÓN NO PUEDE SER MENOR A LA FECHA DE INICIO");
						return
					}
					if(document.frm_sistema.dia_fin.value<document.frm_sistema.dia_ini.value && 
					document.frm_sistema.mes_fin.value==document.frm_sistema.mes_ini.value && 
					document.frm_sistema.anio_fin.value==document.frm_sistema.anio_ini.value){
						alert("LA FECHA DE FINALIZACIÓN NO PUEDE SER MENOR A LA FECHA DE INICIO");
						return
					}
				
					navegar(modulo,accion,elemento);
			}else{
				alert("EL FORMATO DE HORA Y FECHA DEBE SER NUMÉRICO");
			}
			
		}else{
			alert("FAVOR DE LLENAR TODOS LOS CAMPOS");
		}
}

function validar_objetivo(modulo,accion,elemento){
	if(validar(document.frm_sistema.titulo) && validar(document.frm_sistema.descripcion) && 
		validar(document.frm_sistema.dia_ini) && validar(document.frm_sistema.mes_ini) && 
		validar(document.frm_sistema.anio_ini) && validar(document.frm_sistema.dia_fin) && 
		validar(document.frm_sistema.mes_fin) && validar(document.frm_sistema.anio_fin)){
						
			var exp=/[0-9]/;
			if(exp.test(document.frm_sistema.dia_ini.value) && exp.test(document.frm_sistema.mes_ini.value) && 
				exp.test(document.frm_sistema.anio_ini.value) && exp.test(document.frm_sistema.dia_fin.value) && 
				exp.test(document.frm_sistema.mes_fin.value) && exp.test(document.frm_sistema.anio_fin.value)){
					
					var fecha=new Date();
					if(document.frm_sistema.anio_ini.value<fecha.getFullYear()){
						alert("EL AÑO DE INICIO ESPECIFICADO NO PUEDE SER MENOR AL AÑO ACTUAL");
						return
					}
					if(document.frm_sistema.anio_fin.value<fecha.getFullYear()){
						alert("EL AÑO DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MENOR AL AÑO ACTUAL");
						return
					}
					if(document.frm_sistema.mes_ini.value>12 || document.frm_sistema.mes_ini.value<1){
						alert("EL MES DE INICIO ESPECIFICADO NO PUEDE SER MAYOR A 12 NI MENOR A 1");
						return
					}
					if(document.frm_sistema.mes_fin.value>12 || document.frm_sistema.mes_fin.value<1){
						alert("EL MES DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MAYOR A 12 NI MENOR A 1");
						return
					}
					if(document.frm_sistema.dia_ini.value>_LIMITE_MES[document.frm_sistema.mes_ini.value] || 
						document.frm_sistema.dia_ini.value<1){
							
						alert("EL DIA DE INICIO ESPECIFICADO NO PUEDE SER MAYOR A "+_LIMITE_MES[document.frm_sistema.mes_ini.value]+" NI MENOR A 1");
						return
					
					}
					if(document.frm_sistema.dia_fin.value>_LIMITE_MES[document.frm_sistema.mes_fin.value] || 
						document.frm_sistema.dia_fin.value<1){
							
						alert("EL DIA DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MAYOR A "+_LIMITE_MES[document.frm_sistema.mes_ini.value]+" NI MENOR A 1");
						return
					}
					
					if(document.frm_sistema.anio_fin.value<document.frm_sistema.anio_ini.value){
						alert("LA FECHA DE FINALIZACIÓN NO PUEDE SER MENOR A LA FECHA DE INICIO");
						return
					}
					if(document.frm_sistema.mes_fin.value<document.frm_sistema.mes_ini.value && 
					document.frm_sistema.anio_fin.value==document.frm_sistema.anio_ini.value){
						alert("LA FECHA DE FINALIZACIÓN NO PUEDE SER MENOR A LA FECHA DE INICIO");
						return
					}
					if(document.frm_sistema.dia_fin.value<document.frm_sistema.dia_ini.value && 
					document.frm_sistema.mes_fin.value==document.frm_sistema.mes_ini.value && 
					document.frm_sistema.anio_fin.value==document.frm_sistema.anio_ini.value){
						alert("LA FECHA DE FINALIZACIÓN NO PUEDE SER MENOR A LA FECHA DE INICIO");
						return
					}
					
					var fecha_partes=new Array();
					fechas_partes=_FECHAS_P.split("|");
					
					if(document.frm_sistema.anio_ini.value<fechas_partes[0]){
						alert("EL AÑO DE INICIO ESPECIFICADO NO PUEDE SER MENOR AL AÑO INICIAL DEL PROYECTO");
						return
					}
					if(document.frm_sistema.anio_fin.value>fechas_partes[3]){
						alert("EL AÑO DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MAYOR AL FINAL DEL PROYECTO");
						return
					}
					if(document.frm_sistema.mes_ini.value<fechas_partes[1] && document.frm_sistema.anio_ini.value==fechas_partes[0]){
						alert("EL MES DE INICIO ESPECIFICADO NO PUEDE SER MENOR AL MES INICIAL DEL PROYECTO");
						return
					}
					if(document.frm_sistema.mes_fin.value>fechas_partes[4] && document.frm_sistema.anio_fin.value==fechas_partes[3]){
						alert("EL MES DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MAYOR A MES FINAL DEL PROYECTO");
						return
					}
					if(document.frm_sistema.dia_ini.value<fechas_partes[2] && document.frm_sistema.mes_ini.value==fechas_partes[1] && document.frm_sistema.anio_ini.value==fechas_partes[0]){
						alert("EL DIA DE INICIO ESPECIFICADO NO PUEDE SER MENOR AL DIA INICIAL DEL PROYECTO");
						return
					}
					if(document.frm_sistema.dia_fin.value>fechas_partes[5] && document.frm_sistema.mes_fin.value==fechas_partes[4] && document.frm_sistema.anio_fin.value==fechas_partes[3]){
						alert("EL DIA DE FINALIZACIÓN ESPECIFICADO NO PUEDE SER MAYOR A DIA FINAL DEL PROYECTO");
						return
					}
				
					navegar(modulo,accion,elemento);
			}else{
				alert("EL FORMATO DE HORA Y FECHA DEBE SER NUMÉRICO");
			}
			
		}else{
			alert("FAVOR DE LLENAR TODOS LOS CAMPOS");
		}
}

function validar_observacion(modulo,accion,elemento){
	if(validar(document.getElementById("asunto_"+elemento)) && validar(document.getElementById("observacion_"+elemento))){
		if(confirm("AGREGAR OBSERVACION")){
			navegar(modulo,accion,elemento);
		}
	}else{
		alert("FAVOR DE LLENAR TODOS LOS CAMPOS");
	}
}