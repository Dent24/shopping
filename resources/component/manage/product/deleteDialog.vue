<template>
    <v-dialog v-model="dialog" width="400">
        <template v-slot:activator="{ props }">
            <v-btn size="x-small" icon="mdi-delete" v-bind="props" variant="outlined" color="error" class="ml-2" />
        </template>
        <v-card>
            <v-card-title>刪除商品</v-card-title>
            <v-card-text>
                確認刪除
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
            axios.delete('manage/product/' + this.product.id)
                .then((response) => {
                    if (!!response.data.deleted) {
                        this.$emit('deleted');
                        this.dialog = false;
                    }
                })
                .finally(() => { this.setLoading(false) });
        }
    }
}
</script>