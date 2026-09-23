<?php
class Login {
	public function LoginSystem() {
		session_start(); // Starting Session
		$error = ''; // Variable To Store Error Message
		if (!isset($_POST['submit'])) {
			if (empty($_POST['login']) || empty($_POST['password'])) {
				$error = "Usuario o contraseña incorrecto 0";
				session_destroy();
			}
		} else {
			
			include 'connect.php';
			// Define $username and $password
			$username = $_POST['login'];
			$password = trim($_POST['password']);
			// SQL query to fetch information of registerd users and finds user match.
			$query = "SELECT login, password FROM users WHERE login=?   AND activo = 1 LIMIT 1";
			// To protect MySQL injection for Security purpose
			$stmt = $conn->prepare($query);
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$stmt->bind_result($username, $guardada);
			$stmt->store_result();
			if($stmt->fetch()) { //fetching the contents of the row
				session_start(); // Starting Session
				$_SESSION['login'] = $username; // Initializing Session
				if (password_verify($password, $guardada)) {	
					"Guardada: <br>".$guardada;
					session_start(); // Starting Session
					$_SESSION['login'] = $username; // Initializing Session
					$_SESSION['password'] = $password; // Initializing Session
				} else {
					header("Location: ../index.php?response=" . urlencode(json_encode(["status" => "error", "message" => "Revise sus credenciales o verifique que su cuenta esté activa"])));
					session_destroy();
				}
			} else {
				
					header("Location: ../index.php?response=" . urlencode(json_encode(["status" => "warning", "message" => "Esta cuenta no existe o no está activa"])));				
					session_destroy();
			}
			mysqli_close($conn); // Closing Connection
		}
	}
	public function SessionVerify() {
		if(isset($_SESSION['login'])){
			header("location: includes/checkuser.php"); // Check user session and role
		}
	}
	public function SessionCheck() {
		global $conn;
		session_start();// Starting Session
		// Storing Session
		$user_check = $_SESSION['login'];
		// SQL Query To Fetch Complete Information Of User
		$query = "
		SELECT 
		p.*,
		u.role,
		u.activo,
		u.name
		FROM users u
		INNER JOIN personal p
		ON u.correo = p.correo	
		WHERE u.login = '$user_check'";
		$ses_sql = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($ses_sql);

		if($ses_sql -> num_rows > 0){ 
			$_SESSION["id"] = $row["id_personal"];
			$_SESSION["name"] = $row["name"];
			$_SESSION["mail"] = $row["correo"];
			$_SESSION["role"] = intval($row["role"]);

		} else { session_destroy();}

	}
	public function UserType() {
		//if user role is 1, redirect to admin page
		if ($_SESSION["role"] === intval(0)) {
			//  header("Location:../user/superuser/");
				header("Location: ../user/user/index.php?response=" . urlencode(json_encode(["status" => "success", "message" => "Bienvenido"])));
		}
		//if user role is 0, redirect to user page
		if ($_SESSION["role"] == 1) {
			header("Location: ../user/admin/index.php?response=" . urlencode(json_encode(["status" => "success", "message" => "Bienvenido"])));

		}
	



	}

}
class UserFunctions{
	public function UserName() {
		$username = $_SESSION["name"];
		echo $username;
	}	
}

class UserFunctionsid{
	public function id() {
		$id = $_SESSION["id"];
		echo $id;
	}
}