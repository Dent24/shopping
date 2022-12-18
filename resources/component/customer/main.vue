<template>
    <v-container>
        <v-table>
            <thead>
                <tr>
                    <th>產品名稱</th>
                    <th>產品價格</th>
                    <th v-if="islogin" width="150px">加入購物車</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td v-if="islogin">
                        <add-cart-dialog :product="product" v-model:order="order" />
                    </td>
                </tr>
            </tbody>
        </v-table>
    </v-container>
</template>

<script>
import axios from 'axios'
import { mapGetters, mapActions } from 'vuex'
import addCartDialog from './product/addCartDialog.vue'

export default {
    components: {
        addCartDialog
    },
    data() {
        return {
            products: [],
            order: {}
        }
    },
    computed: {
        ...mapGetters({
            islogin: 'getIsLogin'
        })
    },
    created() {
        this.setLoading(true);
        axios.get('customer/products')
            .then((response) => {
                this.products = response.data.products;
                this.order = response.data.order;
            })
            .finally(() => { this.setLoading(false) });
    },
    methods: {
        ...mapActions([
            'setLoading'
        ])
    }
}
</script>