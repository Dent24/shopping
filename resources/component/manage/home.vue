<template>
    <v-container>
        <div class="d-flex justify-end">
            <create-dialog />
        </div>
        <v-table>
            <thead>
                <tr>
                    <th>產品名稱</th>
                    <th>產品價格</th>
                    <th>上架狀況</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.sellable ? '上架中' : '已下架' }}</td>
                </tr>
            </tbody>
        </v-table>
        <v-overlay v-model="loading" class="align-center justify-center">
            <v-progress-circular indeterminate color="primary" width="5" />
        </v-overlay>
    </v-container>
</template>

<script>
import axios from 'axios'
import createDialog from './product/createDialog.vue'

export default {
    components: {
        createDialog
    },
    data() {
        return {
            products: [],
            loading: true
        }
    },
    created() {
        axios.get('manage/products')
            .then((response) => { this.products = response.data.products })
            .finally(() => { this.loading = false });
    }
}
</script>