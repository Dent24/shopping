<template>
    <v-dialog v-model="dialog" width="600">
        <template v-slot:activator="{ props }">
            <slot name="activator" :props="props" />
        </template>
        <v-card>
            <v-card-title>{{ !product ? '新增' : '修改' }}商品</v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-row>
                        <v-col cols="4">
                            <v-text-field v-model="value.name" label="商品名稱" :rules="[rules.required]" />
                        </v-col>
                        <v-col cols="4">
                            <v-text-field v-model="value.price" label="商品價格" type="number" :rules="[rules.required]" />
                        </v-col>
                        <v-col cols="4">
                            <v-switch v-model="value.sellable" label="上架狀態" color="primary" />
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
import _ from 'lodash'

export default {
    props: {
        product: {
            type: Object,
            required: false,
            default: () => {}
        }
    },
    data() {
        return {
            dialog: false,
            value: {
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
            !!val && (this.value = _.merge(this.$options.data().value, this.product));
        }
    },
    methods: {
        async submit() {
            const { valid } = await this.$refs.form.validate();

            if (valid) {
                this.loading = true;
                axios.post('manage/product', this.value)
                    .then((response) => {
                        if (!!response.data.product) {
                            this.$emit('edited', response.data.product);
                            this.dialog = false;
                        }
                    })
                    .finally(() => { this.loading = false });
            }
        }
    }
}
</script>