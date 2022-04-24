<?php

include 'Model.php';

$model = new Model();

if (isset($_POST['delete'])) {
    $id = $_GET['id'];
	$product_name = $_GET['product_name'];
	$conn = $model->getConnection();

	$check_product_sql = "SELECT product_name, price FROM products INNER JOIN price
							ON products.product_id = price.product_id WHERE products.product_name = '$product_name'";
	
	if (mysqli_num_rows(mysqli_query($conn, $check_product_sql)) > 1) {
		$sql = "DELETE price FROM products INNER JOIN price
            ON products.product_id = price.product_id WHERE price.price_id = $id";

		mysqli_query($conn, $sql);
	} else {
		$sql = "DELETE products, price FROM products INNER JOIN price
            ON products.product_id = price.product_id WHERE price.price_id = $id";

		mysqli_query($conn, $sql);
	}

	header('Location: index.php');

}

?>