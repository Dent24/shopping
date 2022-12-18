<template>
    <v-dialog v-model="dialog" width="400">
        <template v-slot:activator="{ props }">
            <v-btn size="x-small" icon="mdi-cart-plus" v-bind="props" variant="text" color="primary" />
        </template>
        <v-card>
            <v-card-title>加入購物車</v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols="6">商品名稱: {{ product.name }}</v-col>
                    <v-col cols="6">單價: {{ product.price }}</v-col>
                    <v-col cols="3" class="text-right">
                        <v-btn size="small" icon="mdi-minus" variant="text" color="error" @click="(quantity > 1) && quantity--" :disabled="(quantity <= 1)" />
                    </v-col>
                    <v-col cols="6" class="text-center text-h4">{{ quantity }}</v-col>
                    <v-col cols="3">
                        <v-btn size="small" icon="mdi-plus" variant="text" color="success" @click="quantity++" />
                    </v-col>
                    <v-col cols="12" class="text-h6">總價: {{ product.price * quantity }}</v-col>
                </v-row>
            </v-card-text>
            <v-card-actions class="justify-end">
                <v-btn color="primary" @click="submit">送出</v-btn>
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
        product: {
            type: Object,
            required: true,
            default: () => {}
        }
    },
    emits: ['update:order'],
    data() {
        return {
            dialog: false,
            quantity: 1
        }
    },
    watch: {
        dialog() {
            this.quantity = 1;
        }
    },
    methods: {
        ...mapActions([
            'setLoading'
        ]),
        async submit() {
            this.setLoading(true);
            axios.post('customer/product/' + this.product.id, { quantity: this.quantity })
                .then((response) => {
                    this.$emit('update:order', response.data.order);
                    this.dialog = false;
                })
                .finally(() => { this.setLoading(false) });
        }
    }
}
</script>