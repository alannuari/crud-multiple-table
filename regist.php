<?php
session_start();

if (isset($_SESSION['login'])) {
	header('Location: index.php');
	exit;
}

include 'Model.php';

$model = new Model();
$conn = $model->getConnection();

if (isset($_POST["registrasi"])) {

    $user_name = strtolower(stripcslashes($_POST["user_name"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $passwordconfirm = mysqli_real_escape_string($conn, $_POST["password-confirm"]);

	$sql_cek_username = "SELECT user_name FROM users WHERE user_name = '$user_name'";
	if (mysqli_num_rows(mysqli_query($conn, $sql_cek_username))) {
		echo "<script>
				alert('Username sudah terdaftar!');
			</script>";
	} else {
		if ($password !== $passwordconfirm) {
			echo "<script>
					alert('Password tidak sama!');
				</script>";
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
	
			$sql = "INSERT INTO users VALUES('', '$user_name', '$password')";
			mysqli_query($conn, $sql);
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="./css/style.css">
		<title>Halaman Registrasi</title>
	</head>
	<body>
		<section class="regist_section">
			<div class="logo_regist">
				<h1>REGISTRASI</h1>
			</div>
			<form action="" method="POST">
				<div class="user_name">
					<label for="user_name">User Name :</label>
					<input type="text" name="user_name" value="" required/>
				</div>
				<div class="password">
					<label for="password">Password :</label>
					<input type="password" name="password" value="" required/>
				</div>
				<div class="password">
					<label for="password-confirm">Konfirmasi Password :</label>
					<input type="password" name="password-confirm" value="" required/>
				</div>
				<a href="login.php">Login di sini</a>
				<div class="btn_center">
					<button class="regist" type="submit" name="registrasi" value="regist" >Registrasi</button>
				</div>
			</form>
		</section>
	</body>
</html>