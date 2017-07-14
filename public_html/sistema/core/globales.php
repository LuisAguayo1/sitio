<?php
	
/**
 * GLOBALES
 * Funciones globales de apoyo.
 **/
	
	/**
	 * ENVIO_CURL
	 * Envía una peticion por metodo curl y regresa el texto respuesta.
	 * @param string $url
	 * @param string $metodo
	 * @param string $variables
	 * @return string
	 */
	function envio_curl($url,$metodo="GET",$variables=""){
		
		$ch=curl_init($url);
		if($metodo=="POST"){
			curl_setopt($ch,CURLOPT_POST,TRUE);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$variables);
		}
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		
		$resp=curl_exec($ch);
		return $resp;
	}
	
	/**
	 * MES_TEXTO
	 * Regresa el valor en texto del mes actual en español o inglés.
	 * @param string $mes
	 * @param string $idioma
	 * @return string
	 */
	function mes_texto($mes,$idioma="es"){
		switch($mes*1){
			case 1: $idioma=="es"?$resp="Enero":"January"; break;
			case 2: $idioma=="es"?$resp="Febrero":"February"; break;
			case 3: $idioma=="es"?$resp="Marzo":"March"; break;
			case 4: $idioma=="es"?$resp="Abril":"April"; break;
			case 5: $idioma=="es"?$resp="Mayo":"May"; break;
			case 6: $idioma=="es"?$resp="Junio":"June"; break;
			case 7: $idioma=="es"?$resp="Julio":"July"; break;
			case 8: $idioma=="es"?$resp="Agosto":"August"; break;
			case 9: $idioma=="es"?$resp="Septiembre":"September"; break;
			case 10: $idioma=="es"?$resp="Octubre":"October"; break;
			case 11: $idioma=="es"?$resp="Noviembre":"November"; break;
			case 12: $idioma=="es"?$resp="Diciembre":"December"; break;
		}
		return $resp;
	}
	
?>