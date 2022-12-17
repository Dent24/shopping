<template>
    <v-container>
        <v-table>
            <thead>
                <tr>
                    <th>產品名稱</th>
                    <th>產品價格</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                </tr>
            </tbody>
        </v-table>
    </v-container>
</template>

<script>
import axios from 'axios'
import { mapActions } from 'vuex'

export default {
    data() {
        return {
            products: []
        }
    },
    created() {
        this.setLoading(true);
        axios.get('customer/products')
            .then((response) => { this.products = response.data.products })
            .finally(() => { this.setLoading(false) });
    },
    methods: {
        ...mapActions([
            'setLoading'
        ])
    }
}
</script>