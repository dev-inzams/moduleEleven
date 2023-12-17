<template>
        <div class="container">
                <div class="title">
                    <h2>Add Product</h2>
                </div>

                <div class="form">
                    <form action="/api/add-product" method="post">
                        <input type="text" class="input" name="productName" placeholder="Product name">
                        <input type="text" class="input" name="description" placeholder="product description">
                        <input type="text" class="input" name="price" placeholder="prices">
                        <input type="text" class="input" name="itemCode" placeholder="itemCode">
                        <input type="text" class="input" name="qty" placeholder="qty">
                        <input type="submit" class="btn btn-secondary" value="Add Product" name="addproduct">
                    </form>
                </div>
            </div>
</template>



