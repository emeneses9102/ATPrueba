<?php 
//inicio la session    
//session_start();
session_start([
	'cookie_lifetime' => 864000,
]);

//session_set_cookie_params(60*60*24);
//Validamos si el usuario ha iniciado sesión
if(isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok")
	{
		require_once 'views/modulos/header.php';
		//echo '<main class="app-content">';
		//-- Contenido --
			if(isset($_GET['ruta'])){
				
				if($_GET['ruta'] == "inicio" ||
					$_GET['ruta'] == "usuarios" ||
					$_GET['ruta'] == "ventas" ||
					$_GET['ruta'] == "salir"){
					include_once "views/modulos/".$_GET['ruta'].".php";
				}
				else{
					include_once "views/modulos/404.php";
				}
			}
			else{
				include_once "views/modulos/inicio.php";
			}

		//echo '</main>';
		require_once 'views/modulos/footer.php';
	}
	//Si no ha iniciado es redirigido al login
else{
	require_once "views/modulos/login.php";
}
