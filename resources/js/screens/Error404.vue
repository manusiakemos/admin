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
                <h1 class="text-white">Error 404</h1>
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
                config: {
                    headers: {
                        'X-Requested-With': 'XmlHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                }
            }
        },
        methods: {
            login() {
                this.errors = [];
                this.axios.get('/sanctum/csrf-cookie').then(()=>{
                    this.axios.post('/login', this.data, this.config).then(()=>{
                        this.axios.get('/api/user').then(res=>{
                            var user = res.data;
                            this.$store.commit("SET_AUTH",true);
                            this.$store.commit("SET_USER",user);
                            this.$vs.notify({
                                text: 'Login Success',
                                color: 'primary',
                            });
                            this.$router.push({name:'Home'});
                        });
                    }).catch(error=>{
                        this.$vs.notify({
                            text: 'Terjadi Kesalahan',
                            color: 'danger',
                        });
                        this.errors = error.response.data.errors;
                    });
                });
            },
        },
    }
</script>
