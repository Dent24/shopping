<template>
    <div class="manage">
        <van-row class="header" justify="space-between">
            <van-col span="6">FFXIV 購物管理中心</van-col>
            <van-row justify="space-between" align="center" v-if="$route.name != 'manage.login'">
                <van-button plain @click="logout()">登出</van-button>
            </van-row>
        </van-row>
        <router-view class="view" />
    </div>
</template>

<script>
import axios from 'axios'

export default {
    methods: {
        logout() {
            axios.post('/logout', { route: 'manage.login' })
                .then(() => { this.$router.push({ name: 'manage.login' }) });
        }
    }
}
</script>

<style scoped>
.header {
    padding: 12px 24px;
    height: 50px;
    line-height: 50px;
    background-color: #D9B300;
}

.view {
    margin: 20px auto;
    width: 1240px;
}

@media screen and (max-width: 1240px) {
    .view {
        width: 960px;
    }
}

@media screen and (max-width: 960px) {
    .view {
        width: 720px;
    }
}

@media screen and (max-width: 720px) {
    .view {
        width: 90%;
    }
}
</style>