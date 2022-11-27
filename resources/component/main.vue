<template>
    <v-app>
        <v-app-bar elevation="3" absolute color="orange">
            <v-toolbar-title>FFXIV 購物管理中心</v-toolbar-title>
            <v-spacer />
            <v-btn icon="mdi-logout" @click="logout"></v-btn>
        </v-app-bar>
        <router-view class="mt-16"></router-view>
    </v-app>
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