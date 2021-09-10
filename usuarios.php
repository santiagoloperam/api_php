<?php 

	header("Content-Type: application/json");
	include_once("modelo-usuario.php");
	switch($_SERVER['REQUEST_METHOD']){
		case 'POST':
			$_POST = json_decode(file_get_contents('php://input'),true);
			$usuario = new Usuario($_POST["name"],$_POST['last_name']);
			$res = $usuario->guardarUsuario();
			if ($res) {
				$resultado["mensaje"] = $res;
				$resultado["registro"] = json_encode($_POST);
			}else{
				$resultado["mensaje"] = $res;
			}
			
			echo json_encode($resultado);
		break;
		case 'GET':
			if (isset($_GET['id'])) {				
				$resultado["mensaje"] = "Retornar el registro con el id: ".$_GET['id'];
				$resultado["usuario"] = Usuario::obtenerUsuario($_GET['id']);
				echo json_encode($resultado);
			}else{
				$resultado["mensaje"] = "Retornar todos los registros";
				$resultado["usuarios"] = Usuario::obtenerUsuarios();
				echo json_encode($resultado);
			}
		break;
		case 'PUT':
			$_PUT = json_decode(file_get_contents('php://input'),true);
			$usuario = new Usuario($_PUT['name'],$_PUT['last_name']);
			$res = $usuario->actualizarUsuario($_GET['id']);
			if ($res) {
				$resultado["mensaje"] = $res;
				$resultado["registro"] = json_encode($_PUT);
			}else{
				$resultado["mensaje"] = $res;
			}
			echo json_encode($resultado);
		break;
		case 'DELETE':
			$res = Usuario::deleteUsuario($_GET['id']);
			if ($res) {
				$resultado["mensaje"] = "Registro Eliminado";
			}else{
				$resultado["mensaje"] = "Registro no Eliminado";
			}
			echo json_encode($resultado);
		break;

	}


 ?>