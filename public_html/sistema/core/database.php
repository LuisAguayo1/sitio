<?php

	// Constantes de la conexión a la base de datos.
	define('HOST','localhost');
	define('DB_USER','cotexca_syntagma');
	define('DB_PASS','ctxca0717');
	define('DB_SCHM','cotexca_sitio');
	
	/**
	* Definición de la clase Database, que controla las acciones de conexión, 
	* extracción y manipulación del contenido en la base de datos.
	* @package core
	* @version 1.0
	*/
	class Database{
		public static $conexion=NULL;
		
		/**
		* Conecta a la base de datos usando las constantes de conexión
		* @return bool Regresa TRUE si la conexión es exitosa y FALSE si ocurre un error. 
		*/
		public function conectar(){
			self::$conexion=mysqli_connect(HOST,DB_USER,DB_PASS,DB_SCHM);
			
			if(!self::$conexion){
				echo 'DATABASE ERROR: '.mysqli_connect_errno();
				return FALSE;
			}else{
				return TRUE;
			}
		}
		
		/**
		* Envía una consulta SQL a la base de datos.
		* @param string $sql Cadena de la consulta SQL.
		* @return mixed|bool Regresa el contenido de la consulta o FALSE si ocurre un error.
		*/
		public function query($sql){
			$query=mysqli_query(self::$conexion,$sql);
			
			if($query){
				return $query;
			}else{
				return FALSE;
			}
		}
		
		/**
		* Extrae la información de la fila en curso de una consulta a la base de datos.
		* @param mixed $q Datos de la consulta.
		* @return mixed|bool Regresa el arreglo de la fila en curso o FALSE si ocurre un error.
		*/
		public function db_row($q){
			$row=mysqli_fetch_assoc($q);
			
			if($row){
				return $row;
			}else{
				return FALSE;
			}
		}
		
		/**
		* Regresa el conteo de filas en una consulta a la base de datos.
		* @param mixed $q Datos de la consulta.
		* @return int|bool Regresa el valor numérico del conteo o FALSE si ocurre un error.
		*/
		public function db_cont($q){
			$val=mysqli_num_rows($q);
			
			if($val){
				return $val;
			}else{
				return FALSE;
			}
		}
		
		/**
		* Regresa el id del último elemento insertado en la base de datos.
		* @return mixed|bool Regresa el id del elemento o FALSE si ocurre un error.
		*/
		public function db_id(){
			$id=mysqli_insert_id(self::$conexion);
			
			if($id){
				return $id;
			}else{
				return FALSE;
			}
		}
		
		/**
		* Regresa el contador de filas de una consulta a la base de datos a 0.
		* @param mixed $q Datos de la consulta.
		* @return void
		*/
		public function db_reset($q){
			mysqli_data_seek($q,0);
		}
	}

?>