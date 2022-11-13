<template>
    <div>
        <van-button plain @click="dialog = true">新增商品</van-button>
        <van-dialog :show.sync="dialog" title="新增商品" show-cancel-button confirm-button-text="送出" cancel-button-text="取消" width="450" @confirm="submit" @cancel="dialog = false">
            <van-form ref="form">
                <van-cell-group inset>
                    <van-field
                        v-model="product.name"
                        label="商品名稱"
                        placeholder="商品名稱"
                        :rules="[{ required: true, message: '必填' }]"
                    />
                    <van-field
                        v-model="product.price"
                        type="number"
                        label="商品價格"
                        placeholder="商品價格"
                        :rules="[{ required: true, message: '必填' }]"
                    />
                    <van-field label="上架狀態">
                        <template #input>
                            <van-switch v-model="product.sellable" size="20" />
                        </template>
                    </van-field>
                </van-cell-group>
            </van-form>
        </van-dialog>
        <van-overlay :show="loading" z-index="2002">
            <div class="wrapper">
                <van-loading color="#1989FA" />
            </div>
        </van-overlay>
    </div>
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
            loading: false
        }
    },
    watch: {
        dialog(val) {
            !val && (this.product = this.$options.data().product);
        }
    },
    methods: {
        submit() {
            const validate = this.$refs.form.validate();
            if (validate) {
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

<style scoped>
.wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}
</style>