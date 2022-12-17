<template>
    <v-container>
        <div class="d-flex justify-end">
            <edit-dialog @edited="edited($event)">
                <template #activator="{ props }">
                    <v-btn color="primary" v-bind="props">新增商品</v-btn>
                </template>
            </edit-dialog>
        </div>
        <v-table>
            <thead>
                <tr>
                    <th>產品名稱</th>
                    <th>產品價格</th>
                    <th>上架狀況</th>
                    <th width="200">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.sellable ? '上架中' : '已下架' }}</td>
                    <td>
                        <edit-dialog :product="product" @edited="edited($event, product)">
                            <template #activator="{ props }">
                                <v-btn size="x-small" icon="mdi-pencil" v-bind="props" variant="outlined" color="info" />
                            </template>
                        </edit-dialog>
                        <delete-dialog :product="product" @deleted="deleted(product)" />
                    </td>
                </tr>
            </tbody>
        </v-table>
    </v-container>
</template>

<script>
import axios from 'axios'
import { mapActions } from 'vuex'
import editDialog from './product/editDialog.vue'
import deleteDialog from './product/deleteDialog.vue'

export default {
    components: {
        editDialog,
        deleteDialog
    },
    data() {
        return {
            products: []
        }
    },
    created() {
        this.setLoading(true);
        axios.get('manage/products')
            .then((response) => { this.products = response.data.products })
            .finally(() => { this.setLoading(false) });
    },
    methods: {
        ...mapActions([
            'setLoading'
        ]),
        edited(product, origin = null ) {
            if (!!origin) {
                origin = _.merge(origin, product);
            } else {
                this.products.push(product);
            }
        },
        deleted(origin) {
            this.products.splice(this.products.indexOf(origin), 1);
        }
    }
}
</script>