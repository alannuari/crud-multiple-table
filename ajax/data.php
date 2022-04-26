<?php

include '../Model.php';

$model = new Model();

$keyword = $_GET['keyword'];

$sql = "SELECT product_name, customer_group, price, price_id
        FROM price, products, customer_group
        WHERE price.product_id = products.product_id AND price.cg_id = customer_group.cg_id AND (product_name LIKE '%$keyword%' OR customer_group LIKE '%$keyword%')
        ORDER BY product_name";

$data = $model->getData($sql);

?>

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