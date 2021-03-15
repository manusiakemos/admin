<template>
    <div class="center-page container-login100 bg-app">
        <vs-row
            vs-align="center"
            vs-type="flex" vs-justify="center" vs-w="12">
            <vs-col
                vs-type="flex"
                vs-justify="center"
                vs-align="center"
                vs-lg="2"
                vs-sm="4"
                vs-xs="12">
                <vs-card>
                    <form autocomplete="off" method="post" @submit="login()">

                        <vs-row vs-type="flex" vs-justify="center" vs-align="flex-center">
                            <vs-col vs-type="flex" vs-justify="center">
                                <img src="/images/vue.png" alt="vue" load="lazy" id="logo" class="mb-3">
                            </vs-col>
                        </vs-row>
                        <div>
                            <vs-row vs-type="flex" vs-justify="center" vs-align="flex-center">
                                <div class="form-group">
                                    <vs-input label="Username"
                                              autofocus="true"
                                              type="text"
                                              autocomplete="off"
                                              :danger="errors.username != undefined"
                                              :danger-text="errors.username != undefined ? errors.username[0] : ''"
                                              v-model="data.username"/>
                                </div>
                                <div class="form-group">
                                    <vs-input label="Password" type="password"
                                              autocomplete="off"
                                              v-model="data.password"/>
                                </div>
                            </vs-row>
                        </div>
                        <div slot="footer">
                            <vs-row vs-justify="center" vs-align="center">
                                <vs-button type="gradient" icon="vpn_key" @click="login()">Login</vs-button>
                            </vs-row>
                        </div>
                    </form>
                </vs-card>
            </vs-col>
        </vs-row>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            data: {
                username: "",
                password: "",
            },
            errors: [],
        }
    },
    methods: {
        async login() {
            this.errors = [];
            await this.axios.get('/sanctum/csrf-cookie');
            this.axios.post('/login', this.data).then(() => {
                this.axios.get('/api/user').then(res => {
                    let user = res.data;
                    this.$store.commit("SET_AUTH", true);
                    this.$store.commit("SET_USER", user);
                    this.$vs.notify({
                        text: 'Login Success',
                        color: 'primary',
                    });
                    this.$router.push({name: 'Home'});
                });
            }).catch(error => {
                this.$vs.notify({
                    text: 'Terjadi Kesalahan',
                    color: 'danger',
                });
                this.errors = error.response.data.errors;
            });
        },
    },
}
</script>
