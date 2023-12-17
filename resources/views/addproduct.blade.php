<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Products</title>
</head>
<body>
    <div class="container">
        <div class="title">
            <h2>Add Product</h2>
        </div>

        <div class="form">
            <form action="/api/add-product" method="post">
                <input type="text" name="productName" placeholder="Product name">
                <input type="text" name="description" placeholder="product description">
                <input type="text" name="price" placeholder="prices">
                <input type="text" name="qty" placeholder="qty">
                <input type="submit" value="Add Product" name="addproduct">
            </form>
        </div>
    </div>
</body>
</html>
