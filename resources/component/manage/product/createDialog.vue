<template>
    <v-dialog v-model="dialog" width="600">
        <template v-slot:activator="{ props }">
            <v-btn color="primary" v-bind="props">新增商品</v-btn>
        </template>
        <v-card>
            <v-card-title>新增商品</v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-row>
                        <v-col cols="4">
                            <v-text-field v-model="product.name" label="商品名稱" :rules="[rules.required]" />
                        </v-col>
                        <v-col cols="4">
                            <v-text-field v-model="product.price" label="商品價格" type="number" :rules="[rules.required]" />
                        </v-col>
                        <v-col cols="4">
                            <v-switch v-model="product.sellable" label="上架狀態" color="primary" />
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
            <v-card-actions class="justify-end">
                <v-btn color="primary" @click="submit">送出</v-btn>
                <v-btn @click="dialog = false" class="ml-3">取消</v-btn>
            </v-card-actions>
        </v-card>
        <v-overlay v-model="loading" class="align-center justify-center">
            <v-progress-circular indeterminate color="primary" width="5" />
        </v-overlay>
    </v-dialog>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            dialog: false,
            product: {
                sellable: false
            },
            rules: {
                required: (v) => !!v || '必填'
            },
            loading: false
        }
    },
    watch: {
        dialog(val) {
            !val && (this.product = this.$options.data().product);
        }
    },
    methods: {
        async submit() {
            const { valid } = await this.$refs.form.validate();

            if (valid) {
                this.loading = true;
                axios.post('manage/product', this.product)
                    .then((response) => {
                        if (!!response.data.product) {
                            this.dialog = false;
                        }
                    })
                    .finally(() => { this.loading = false });
            }
        }
    }
}
</script>