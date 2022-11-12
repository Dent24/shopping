<template>
    <div>
        <van-form @submit="login">
            <van-cell-group inset>
                <van-field
                    v-model="value.email"
                    name="Email"
                    label="Email"
                    placeholder="Email"
                    :rules="[{ required: true, message: 'Email is required' }]"
                />
                <van-field
                    v-model="value.password"
                    type="password"
                    name="Password"
                    label="Password"
                    placeholder="Password"
                    :rules="[{ required: true, message: 'Password is required' }]"
                />
            </van-cell-group>
            <div v-if="!!error" style="margin: 16px 24px">
                <van-tag type="danger" large>{{ error }}</van-tag>
            </div>
            <div style="margin: 16px;">
                <van-button round block type="primary" native-type="submit" :loading="loading">Login</van-button>
            </div>
        </van-form>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            value: {
                email: '',
                password: ''
            },
            loading: false,
            error: ''
        }
    },
    methods: {
        login() {
            this.loading = true;
            axios.post('/login', this.value)
                .then(() => { this.$router.push({ name: 'manage' }) })
                .catch((error) => {
                    this.error = error.response.data;
                })
                .finally(() => { this.loading = false });
        }
    }
}
</script>