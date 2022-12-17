<template>
    <v-app>
        <v-app-bar elevation="3" absolute color="orange">
            <v-toolbar-title>FFXIV 購物管理中心</v-toolbar-title>
            <v-spacer />
            <v-btn v-if="islogin" icon="mdi-logout" @click="logout"></v-btn>
        </v-app-bar>
        <router-view class="mt-16"></router-view>
        <v-overlay v-model="loading" class="align-center justify-center">
            <v-progress-circular indeterminate color="primary" width="5" />
        </v-overlay>
    </v-app>
</template>

<script>
import axios from 'axios'
import { mapGetters, mapActions } from 'vuex'

export default {
    computed: {
        ...mapGetters({
            islogin: 'getIsLogin',
            loading: 'getLoading'
        })
    },
    mounted() {
        this.setIsLogin(window.login);
    },
    methods: {
        ...mapActions([
            'setIsLogin',
            'setLoading'
        ]),
        logout() {
            this.setLoading(true);
            axios.post('/logout')
                .then(() => {
                    this.$router.go();
                });
        }
    }
}
</script>