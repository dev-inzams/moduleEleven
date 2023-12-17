<script setup>
import axios from "axios";
import { onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import router from "../../router";

let form = ref([])

let allcustomer = ref([])
let customer_id = ref([])
let item = ref ([])
let listcart = ref ([])

let listProducts = ref([])

const showModal = ref(false)
const hideModal = ref(true)

onMounted(async() => {
    indexForm()
    getAllCustomers()
    getProducts()
    })

const indexForm = async () => {
    let response = await axios.get("/api/create_invoice")
    // console.log ('form', response.data)
    form.value = response.data
}

const getAllCustomers = async () => {
    let response = await axios.get("/api/customers")
    // console.log('response', response)
    allcustomer.value = response.data.customers
}

const addCart = (item) => {
    const itemcart = {
        id: item.id,
        itemCode: item.itemCode,
        productName: item.productName,
        prices: item.prices,
        qty: item.qty
    }
    listcart.value.push(itemcart)
    closeModal()
}

const removeItems = (i) => {
    listcart.value.splice(i,1)
}

const openModel = () =>{
    showModal.value = !showModal.value
}

const closeModal = () =>{
    showModal.value = !hideModal.value
}

const getProducts = async () => {
    let response = await axios.get("/api/products")
    // console.log('products', response)
    listProducts.value = response.data.products
}

const subTotall = () => {
    let total = 0
    listcart.value.map((data)=>{
        total = total + (data.qty*data.prices)
    })
    return total
}

const grandTotal = () =>{
    return subTotall() - form.value.discount
}

const onSave = () =>{
    if(listcart.value.length >=1){
        let subtotal = 0
        subtotal = subTotall()

        let total = 0
        total = grandTotal()

        const formData = new FormData()
        formData.append('invoice_items',JSON.stringify(listcart.value))
        formData.append('customerName',form.value.customerName)
        formData.append('date',form.value.date)
        formData.append('dueDate',form.value.dueDate)
        formData.append('number',form.value.number)
        formData.append('reference',form.value.reference)
        formData.append('discount',form.value.discount)
        formData.append('subtotal',subtotal)
        formData.append('grandTotal',total)
        formData.append('tremsAndCondition',form.value.tremsAndCondition)

        // formData.append('itemCode',itemcart.itemCode)

        axios.post("/api/add_invoice", formData)
        listcart.value=[]
        // itemcart.itemCode=[]

        // router.push('/')
    }
}
</script>


<template>
   <div class="container">

    <div class="invoices">

        <div class="card__header">
            <div>
                <h2 class="invoice__title">New Invoice</h2>
            </div>
            <div>

            </div>
        </div>

        <div class="card__content">
            <div class="card__content--header">
                <div>
                    <p class="my-1">Customer Name</p>
                    <input v-model="form.customerName" type="text" class="input">
                    <!-- <select name="" id="" class="input" >
                        <option value="">cust 1</option>
                    </select> -->
                </div>
                <div>
                    <p class="my-1">Date</p>
                    <input v-model="form.date" id="date" placeholder="dd-mm-yyyy" type="date" class="input"> <!---->
                    <p class="my-1">Due Date</p>
                    <input v-model="form.dueDate" id="due_date" type="date" class="input">
                </div>
                <div>
                    <p class="my-1">Number</p>
                    <input v-model="form.number" type="text" class="input">
                    <p class="my-1">Reference(Optional)</p>
                    <input v-model="form.reference" type="text" class="input">
                </div>
            </div>
            <br><br>
            <div class="table">

                <div class="table--heading2">
                    <p>Item Description</p>
                    <p>Unit Price</p>
                    <p>Qty</p>
                    <p>Total</p>
                    <p></p>
                </div>

                <!-- item 1 -->
                <div class="table--items2" v-for="(itemcart, i) in listcart" :key="itemcart.id">
                    <p>#{{ itemcart.itemCode }} {{ itemcart.productName }}</p>
                    <input type="hidden" v-model="itemcart.itemCode">
                    <p>
                        <input type="text" class="input" v-model="itemcart.prices">
                    </p>
                    <p>
                        <input type="text" class="input" v-model="itemcart.qty">
                    </p>
                    <p v-if="itemcart.qty">
                        $ {{ itemcart.qty }} * {{ itemcart.prices }}
                    </p>
                    <p v-else> nothing </p>
                    <p style="color: red; font-size: 24px;cursor: pointer;" @click="removeItems(i)">
                        &times;
                    </p>
                </div>
                <div style="padding: 10px 30px !important;">
                    <button class="btn btn-sm btn__open--modal" @click="openModel()">Add New Line</button>
                </div>
            </div>

            <div class="table__footer">
                <div class="document-footer" >
                    <p>Terms and Conditions</p>
                    <textarea cols="50" rows="7" class="textarea" v-model="form.tremsAndCondition"></textarea>
                </div>
                <div>
                    <div class="table__footer--subtotal">
                        <p>Sub Total</p>
                        <span>$ {{ subTotall() }}</span>
                    </div>
                    <div class="table__footer--discount">
                        <p>Discount</p>
                        <input type="text" class="input" v-model="form.discount">
                    </div>
                    <div class="table__footer--total">
                        <p>Grand Total</p>
                        <span>$ {{ grandTotal() }}</span>
                    </div>
                </div>
            </div>


        </div>
        <div class="card__header" style="margin-top: 40px;">
            <div>

            </div>
            <div>
                <a class="btn btn-secondary" @click="onSave()">
                    Save
                </a>
            </div>
        </div>

    </div>


       <!--==================== add modal items ====================-->
       <div class="modal main__modal " :class="{show: showModal}">
        <div class="modal__content">
            <span class="modal__close btn__close--modal" @click="closeModal()">×</span>
            <h3 class="modal__title">Add Item</h3>
            <hr><br>
            <div class="modal__items">
                <ul style="list-style: none;">
                    <li v-for="(item, i) in listProducts" :key="item.id" style="display:grid; grid-template-colums:30px 350px 15px; align-items: center; padding-bottom: 5px;">
                        <p>{{ i+1 }}</p>
                        <a href="">{{ item.itemCode }} {{ item.productName }}</a>
                        <button @click="addCart(item)" style="border: 1px solid #ddd; width:35px; height:35px; cursor:pointer;">+</button>
                    </li>
                </ul>

            </div>
            <br><hr>
            <div class="model__footer">
                <button class="btn btn-light mr-2 btn__close--modal" @click="closeModal()">
                    Cancel
                </button>
                <button class="btn btn-light btn__close--modal ">Save</button>
            </div>
        </div>
    </div>

    <br><br><br>

   </div>
</template>
