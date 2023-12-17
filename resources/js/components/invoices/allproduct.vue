<!-- resources/views/your-component.blade.php -->

<template>
    <div class="container">
        <div class="invoices">
        <h1>All Products</h1>

        <div class="table--heading" style="background-color: black;">
                <p>itemCode</p>
                <p>productName</p>
                <p>description</p>
                <p>qty</p>
                <p>prices</p>
            </div>

            <!-- item 1 -->
            <div class="table--items" v-for="product in products" :key="product.id" >
                <p>#{{ product.itemCode }}</p>
                <p>{{ product.productName }}</p>
                <p>{{ product.description }}</p>
                <p>{{ product.qty }}</p>
                <p> $ {{ product.prices }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
            };
        },
        mounted() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts() {
                axios.get('/api/show_products')
                    .then(response => {
                        this.products = response.data.products;
                    })
                    .catch(error => {
                        console.error('Error fetching products inzams', error);
                    });
            },
        },
    };
</script>
