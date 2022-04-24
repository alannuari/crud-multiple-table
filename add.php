<?php

@session_start();

include 'Model.php';

$model = new Model();

if (isset($_POST['submit'])) {
	$conn = $model->getConnection();

	$product_name = htmlspecialchars($_POST['product_name']);
	$cg_id = htmlspecialchars($_POST['cg_id']);
	$price = htmlspecialchars($_POST['price']);

	$check_sql = "SELECT product_name, cg_id FROM products INNER JOIN price
					ON price.product_id = products.product_id
					WHERE product_name = '$product_name' AND cg_id = '$cg_id'";

	if (mysqli_num_rows(mysqli_query($conn, $check_sql))) {
		$_SESSION['error'] = "<script language='javascript'>alert('Maaf terdapat data yang sama')</script>";
	} else {
		$check_product_name_sql = "SELECT * FROM products WHERE product_name = '$product_name'";

		if (mysqli_num_rows(mysqli_query($conn, $check_product_name_sql))) {
			$data_product_name = $model->getData($check_product_name_sql)[0];
			
			$product_id = $data_product_name["product_id"];

			$sql = "INSERT INTO price VALUES('', '$product_id', '$cg_id', '$price')";
			mysqli_query($conn, $sql);
		} else {
			$sql = "INSERT INTO products VALUES('', '$product_name')";
			mysqli_query($conn, $sql);
			$product_id = mysqli_insert_id( $conn );

			$sql = "INSERT INTO price VALUES('', '$product_id', '$cg_id', '$price')";
			mysqli_query($conn, $sql);
		}
	}

	header('Location: index.php');

}

?>