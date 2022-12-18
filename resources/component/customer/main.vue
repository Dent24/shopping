<template>
    <v-container>
        <div class="d-flex justify-end mb-3">
            <v-btn v-if="islogin" :disabled="!order.id" color="primary" @click.stop="drawer = !drawer">訂單清單</v-btn>
        </div>
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
        <v-navigation-drawer v-model="drawer" location="right" width="300" temporary>
            <v-list-item title="訂單清單" height="100" />
            <v-divider />
            <v-card v-for="detail in order.details" :key="detail.id" class="ma-3" variant="outlined">
                <v-card-title class="d-flex align-center">
                    {{ detail.product.name }}
                    <v-spacer />
                    <remove-detail-dialog :detail="detail" v-model:order="order" />
                </v-card-title>
                <v-card-subtitle>單價: {{ detail.product.price }}</v-card-subtitle>
                <v-card-text>
                    <v-row>
                        <v-col cols="6">數量: {{ detail.quantity }}</v-col>
                        <v-col cols="6" class="text-right">小計: {{ detail.product.price * detail.quantity }}</v-col>
                    </v-row>
                </v-card-text>
            </v-card>
            <div class="ma-3 text-right">總計: {{ orderTotal }}</div>
            <template v-slot:append>
                <v-divider />
                <div class="d-flex justify-space-between pa-2">
                    <v-btn variant="outlined" color="error" @click="deleteOrder">取消訂單</v-btn>
                    <v-btn variant="outlined" color="success" @click="sendOrder">送出訂單</v-btn>
                </div>
            </template>
        </v-navigation-drawer>
    </v-container>
</template>

<script>
import axios from 'axios'
import { mapGetters, mapActions } from 'vuex'
import addCartDialog from './product/addCartDialog.vue'
import removeDetailDialog from './product/removeDetailDialog.vue'

export default {
    components: {
        addCartDialog,
        removeDetailDialog
    },
    data() {
        return {
            drawer: false,
            products: [],
            order: {
                details: []
            }
        }
    },
    computed: {
        ...mapGetters({
            islogin: 'getIsLogin'
        }),
        orderTotal() {
            return this.order.details.reduce((result, detail) => {
                return result + (detail.product.price * detail.quantity);
            }, 0);
        }
    },
    created() {
        this.setLoading(true);
        axios.get('customer/products')
            .then((response) => {
                this.products = response.data.products;
                !!response.data.order && (this.order = response.data.order);
            })
            .finally(() => { this.setLoading(false) });
    },
    methods: {
        ...mapActions([
            'setLoading'
        ]),
        async sendOrder() {
            this.setLoading(true);
            axios.put('customer/order/' + this.order.id)
                .then(() => {
                    this.order = this.$options.data().order;
                    this.drawer = false;
                })
                .finally(() => { this.setLoading(false) });
        },
        async deleteOrder() {
            this.setLoading(true);
            axios.delete('customer/order/' + this.order.id)
                .then(() => {
                    this.order = this.$options.data().order;
                    this.drawer = false;
                })
                .finally(() => { this.setLoading(false) });
        }
    }
}
</script>