<template>
    <v-container>
        <v-form ref="form">
            <v-row>
                <v-col cols="12">
                    <v-text-field v-model="value.name" label="Name" prepend-icon="mdi-account" :rules="[rules.required]" :error-messages="error.name" />
                </v-col>
                <v-col cols="12">
                    <v-text-field v-model="value.email" label="Email" prepend-icon="mdi-account" :rules="[rules.required, rules.email]" :error-messages="error.email" />
                </v-col>
                <v-col cols="12">
                    <v-text-field type="password" v-model="value.password" label="Password" prepend-icon="mdi-lock" :rules="[rules.required, rules.password]" :error-messages="error.password" />
                </v-col>
                <v-col cols="12">
                    <v-btn color="primary" @click="register" width="100%">註冊</v-btn>
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
            error: {},
            rules: {
                required: (v) => !!v || '必填',
                email: (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Email 不符合格式',
                password: (v) => /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(v) || 'Password 不符合格式'
            }
        }
    },
    methods: {
        ...mapActions([
            'setLoading'
        ]),
        async register() {
            this.error = '';
            const { valid } = await this.$refs.form.validate();

            if (valid) {
                this.setLoading(true);
                axios.post('/register', this.value)
                    .then(() => {
                        this.$router.go();
                    })
                    .catch((error) => {
                        this.setLoading(false);
                        this.error = error.response.data.errors;
                    });
            }
        }
    }
}
</script>