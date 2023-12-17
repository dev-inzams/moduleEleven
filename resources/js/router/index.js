import { createRouter, createWebHistory } from "vue-router";
import invoiceIndex from '../components/invoices/index.vue';
import invoiceNew from '../components/invoices/new.vue';
import addproduct from '../components/invoices/addproduct.vue'
import allproduct from '../components/invoices/allproduct.vue'
import dashboard from '../components/invoices/dashboard.vue'
import notFound from '../components/notFound.vue';


const routes =[
    {
        path:'/',
        component: invoiceIndex
    },
    {
        path:'/invoices/new',
        component: invoiceNew
    },

    {
        path:'/invoices/addproduct',
        component: addproduct
    },
    {
        path:'/invoices/allproduct',
        component: allproduct
    },
    {
        path:'/invoices/dashboard',
        component: dashboard
    },

    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})
export default router
