<template>
    <v-container>
        <v-form ref="form">
            <v-row>
                <v-col cols="12">
                    <v-text-field v-model="value.email" label="Email" prepend-icon="mdi-account" :rules="[rules.required]" />
                </v-col>
                <v-col cols="12">
                    <v-text-field v-model="value.password" label="Password" prepend-icon="mdi-lock" :rules="[rules.required]" />
                </v-col>
                <v-col cols="12" v-if="!!error">
                    <v-alert type="error" variant="outlined">{{ error }}</v-alert>
                </v-col>
                <v-col cols="12">
                    <v-btn color="primary" @click="login" width="100%">登入</v-btn>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>

<script>
import axios from 'axios'
import { mapActions } from 'vuex'

export default {
    data() {
        return {
            value: {
                email: '',
                password: ''
            },
            error: '',
            rules: {
                required: (v) => !!v || '必填'
            }
        }
    },
    methods: {
        ...mapActions([
            'setLoading'
        ]),
        async login() {
            this.error = '';
            const { valid } = await this.$refs.form.validate();

            if (valid) {
                this.setLoading(true);
                axios.post('/login', this.value)
                    .then(() => {
                        this.$router.go();
                    })
                    .catch((error) => {
                        this.setLoading(false);
                        this.error = error.response.data;
                    });
            }
        }
    }
}
</script>