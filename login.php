<?php
session_start();

if (isset($_SESSION['login'])) {
	header('Location: index.php');
    exit;
}

include 'Model.php';

$model = new Model();
$conn = $model->getConnection();

if (isset($_POST["login"])) {

    $user_name = $_POST["user_name"];
    $password = $_POST["password"];

	$sql = "SELECT * FROM users WHERE user_name = '$user_name'";
    $result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result)) {
		$row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            $_SESSION['login'] = true;
            header("Location: index.php");
        } else {
            echo "<script>
                        alert('Maaf, username atau password salah!');
                </script>";
        }
	} else {
		echo "<script>
					alert('Maaf, username atau password salah!');
			</script>";
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
		<title>Halaman Login</title>
	</head>
	<body>
		<section class="login_section">
			<div class="logo_login">
				<h1>LOGIN</h1>
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
                <a href="regist.php">Registrasi di sini</a>
				<div class="btn_center">
					<button class="login" type="submit" name="login" value="login" >Login</button>
				</div>
			</form>
		</section>
	</body>
</html>