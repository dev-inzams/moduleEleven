
<template>
    <div class="container">

        <div class="card">
            <div class="card-title">{{ totalSell }}</div>
            <div class="card-subtitle">Today</div>
        </div>
        <div class="card">
            <div class="card-title">Card Title</div>
            <div class="card-subtitle">This Month</div>
        </div>
        <div class="card">
            <div class="card-title">Card Title</div>
            <div class="card-subtitle">This Year</div>
        </div>


    </div>
</template>


<script>
import axios from 'axios';
    export default {
        data() {
            return {
                totalSell: [],
            };
        },
        mounted() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts() {
                axios.get('/api/todaytotalsell')
                    .then(response => {
                        this.totalSell = response.data;
                    })
                    .catch(error => {
                        console.error('Error fetching products inzams', error);
                    });
            },
        },
    };
</script>
