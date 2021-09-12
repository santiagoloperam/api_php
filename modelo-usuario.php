<?php 	


class Usuario{
	private $name;
	private $last_name;
	
	public function __construct($name,$last_name){
		$this->name = $name;
		$this->last_name = $last_name;
	}

	public function guardarUsuario(){		
		include 'conection.php';
		$sentencia = $db->prepare("INSERT INTO usuarios (name,last_name) VALUES (?,?);");
		$res = $sentencia->execute([$this->name,$this->last_name]);
		if ($res) {
				return true;
			}else{
				return false;
			}
		}

	public static function obtenerUsuarios(){
		include 'conection.php';
		$sentencia = $db->query('SELECT * FROM usuarios');
		$usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $usuarios;
	}

	public static function obtenerUsuario($id){
		include 'conection.php';
		$sentencia = $db->prepare("SELECT * FROM usuarios WHERE id = ?;");
		$sentencia->execute([$id]);
		$res = $sentencia->fetch(PDO::FETCH_OBJ);
		return $res;
	}

	public function actualizarUsuario($id){
		include 'conection.php';
		$sentencia = $db->prepare("UPDATE usuarios SET name = ?, last_name = ? WHERE id= ?;");
		$res = $sentencia->execute([$this->name,$this->last_name,$id]);
		if ($res) {
				return true;
			}else{
				return false;
			}
	}

	public static function deleteUsuario($id){	
		include 'conection.php';	
		$sentencia = $db->prepare("DELETE FROM usuarios WHERE id = ?;");
		$res = $sentencia->execute([$id]);

		if ($res) {
			return true;
		}else{
			return false;
		}
	}

}
?>