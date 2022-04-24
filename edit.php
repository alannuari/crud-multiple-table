<?php

@session_start();

include 'Model.php';

$model = new Model();

if (isset($_POST['edit'])) {
    $id = $_GET['id'];

	$sql = "SELECT product_name, customer_group, customer_group.cg_id, price
			FROM price, products, customer_group
			WHERE price.product_id = products.product_id AND price.cg_id = customer_group.cg_id AND price.price_id = $id";

	$product = $model->getData($sql)[0];

}

if (isset($_POST['submit'])) {
	$id = $_GET['id'];
	$product_name = $_GET['product_name'];
	$conn = $model->getConnection();

	$cg_id = $_POST['cg_id'];
	$price = $_POST['price'];

	$check_sql = "SELECT product_name, cg_id, price_id FROM products INNER JOIN price
					ON price.product_id = products.product_id
					WHERE NOT price_id = $id AND (product_name = '$product_name' AND cg_id = '$cg_id')";

	if (mysqli_num_rows(mysqli_query($conn, $check_sql))) {
		$_SESSION['error'] = "<script language='javascript'>alert('Maaf terdapat data yang sama')</script>";
	} else {
		$sql = "UPDATE products INNER JOIN price 
			ON products.product_id = price.product_id 
			SET 
			cg_id = '$cg_id',
			price = '$price'
			WHERE price.price_id = $id";
	
		mysqli_query($conn, $sql);
	}

	header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="./css/style.css">
		<title>Test ICUBE by SIRCLO</title>
	</head>
	<body>
		<section class="input_section">
			<div class="logo">
				<img src="img/logo.png" alt="icube"/>
			</div>
			<form action="" method="POST">
				<div class="product_name">
					<label for="product_name">Product Name :</label>
					<input type="text" name="product_name" value="<?php echo $product['product_name'] ?>" disabled/>
				</div>
				<div class="customer_group">
					<label for="customer_group">Customer Group :</label>
					<div class="radio_input">
						<div>
							<input type="radio" name="cg_id" value="1" required <?php echo $product['cg_id'] == 1 ? 'checked' : '' ?> /> Retail
						</div>
						<div>
							<input type="radio" name="cg_id" value="2" required <?php echo $product['cg_id'] == 2 ? 'checked' : '' ?> /> Wholesale
						</div>
					</div>
				</div>
				<div class="price">
					<label for="price">Price :</label>
					<input type="number" name="price" value="<?php echo $product['price'] ?>" required/>
				</div>
				<div class="btn_center">
					<button class="submit" type="submit" name="submit" value="submit" >Save Update</button>
				</div>
			</form>
		</section>
	</body>
</html>