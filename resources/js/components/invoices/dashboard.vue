<template>
    <div class="container">
        <div class="card">
            <div class="card-title">{{ totalSell }}</div>
            <div class="card-subtitle">Today</div>
        </div>
        <div class="card">
            <div class="card-title">{{ monthlyTotalSell }}</div>
            <div class="card-subtitle">This Month</div>
        </div>
        <div class="card">
            <div class="card-title">{{ thisYearTotalSell }}</div>
            <div class="card-subtitle">This Year</div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            totalSell: null, // Change from array to null or initialize with a default value
            monthlyTotalSell: null, // Change from array to null or initialize with a default value
            thisYearTotalSell: null, // Change from array to null or initialize with a default value
        };
    },
    mounted() {
        this.fetchProducts();
        this.fetchMonthlyTotalSell();
        this.fetchthisYearTotalSell();
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

        fetchMonthlyTotalSell() {
            axios.get('/api/thisMonthTotalSell')
                .then(response => {
                    this.monthlyTotalSell = response.data;
                })
                .catch(error => {
                    console.error('Error fetching monthly total sell', error);
                });
        },

        fetchthisYearTotalSell() {
            axios.get('/api/thisYearTotalSell')
                .then(response => {
                    this.thisYearTotalSell = response.data;
                })
                .catch(error => {
                    console.error('Error fetching monthly total sell', error);
                });
        },
    },
};
</script>
