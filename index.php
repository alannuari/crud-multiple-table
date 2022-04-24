<?php

@session_start();

include 'Model.php';

$model = new Model();

$sql = "SELECT product_name, customer_group, price, price_id
		FROM price, products, customer_group
		WHERE price.product_id = products.product_id AND price.cg_id = customer_group.cg_id
		ORDER BY product_name";

$data = $model->getData($sql);

if (isset($_POST['search'])) {
	$keyword = $_POST['keyword'];

	if ($keyword) {
		$sql = "SELECT product_name, customer_group, price, price_id
				FROM price, products, customer_group
				WHERE price.product_id = products.product_id AND price.cg_id = customer_group.cg_id AND (product_name LIKE '%$keyword%' OR customer_group LIKE '%$keyword%')
				ORDER BY product_name";

		$data = $model->getData($sql);
	} else {
		$sql = "SELECT product_name, customer_group, price, price_id
				FROM price, products, customer_group
				WHERE price.product_id = products.product_id AND price.cg_id = customer_group.cg_id
				ORDER BY product_name";

		$data = $model->getData($sql);
	}
	

}

if (isset($_SESSION['error'])) {
	echo $_SESSION['error'];
	unset($_SESSION['error']);
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
		<section class="input_section shadow">
			<div class="logo">
				<img src="img/logo.png" alt="icube"/>
			</div>
			<form action="add.php" method="POST">
				<div class="product_name">
					<label for="product_name">Product Name :</label>
					<input type="text" name="product_name" value="" required/>
				</div>
				<div class="customer_group">
					<label for="customer_group">Customer Group :</label>
					<div class="radio_input">
						<div>
							<input type="radio" name="cg_id" value="1" required/> Retail
						</div>
						<div>
							<input type="radio" name="cg_id" value="2" required/> Wholesale
						</div>
					</div>
				</div>
				<div class="price">
					<label for="price">Price :</label>
					<input type="number" name="price" value="" required/>
				</div>
				<div class="btn_center">
					<button class="submit" type="submit" name="submit" value="submit" >Save</button>
				</div>
			</form>
		</section>

		<section class="search_section shadow">
			<form action="" method="POST">
				<label for="search">Search Product :</label>
				<input type="text" name='keyword' placeholder='Masukkan keyword...' autocomplete="off">
				<div class="btn_center">
					<button type="submit" name='search' class="search" value="search">Search</button>
				</div>
			</form>
		</section>

		<section class="display_section shadow">
			<table>
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Customer Group</th>
						<th>Price</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $item) : ?>
						<tr>
							<td class="product-name"><?php echo $item['product_name'] ?></td>
							<td class="customer-group"><?php echo $item['customer_group'] ?></td>
							<td class="price"><?php echo $item['price'] ?></td>
							<td class="action">
								<form action="edit.php?id=<?php echo $item['price_id'] ?>&product_name=<?php echo $item['product_name'] ?>" method="POST">
									<button type="submit" name="edit" value="edit" class="edit">Edit</button>
								</form>
								<form action="delete.php?id=<?php echo $item['price_id'] ?>&product_name=<?php echo $item['product_name'] ?>" method="POST">
									<button type="submit" name="delete" value="delete" class="delete" onclick="return confirm('Yakin ingin menghapus data ?')">Delete</button>
								</form>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</section>
	</body>
</html>