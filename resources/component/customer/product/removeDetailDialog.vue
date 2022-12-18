<template>
    <v-dialog v-model="dialog" width="400">
        <template v-slot:activator="{ props }">
            <v-btn size="small" icon="mdi-cart-remove" v-bind="props" variant="text" color="error" />
        </template>
        <v-card>
            <v-card-title>移除購物車</v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols="12">商品名稱: {{ detail.product.name }}</v-col>
                    <v-col cols="6">單價: {{ detail.product.price }}</v-col>
                    <v-col cols="6">數量: {{ detail.quantity }}</v-col>
                    <v-col cols="12" class="text-h6">總價: {{ detail.product.price * detail.quantity }}</v-col>
                </v-row>
            </v-card-text>
            <v-card-actions class="justify-end">
                <v-btn color="primary" @click="submit">確認移除</v-btn>
                <v-btn @click="dialog = false" class="ml-3">取消</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import axios from 'axios'
import { mapActions } from 'vuex'

export default {
    props: {
        detail: {
            type: Object,
            required: true,
            default: () => {}
        }
    },
    emits: ['update:order'],
    data() {
        return {
            dialog: false
        }
    },
    methods: {
        ...mapActions([
            'setLoading'
        ]),
        async submit() {
            this.setLoading(true);
            axios.delete('customer/detail/' + this.detail.id)
                .then((response) => {
                    this.$emit('update:order', response.data.order);
                    this.dialog = false;
                })
                .finally(() => { this.setLoading(false) });
        }
    }
}
</script>