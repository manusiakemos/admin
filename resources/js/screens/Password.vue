<template>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Password</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <vs-card class="mt-1">
                    <h4 class="mb-3">Password</h4>

                    <vs-row vs-type="flex" vs-justify="start" vs-align="flex-center" class="mb-3">
                        <vs-input
                            type="password"
                            class="w-100"
                            :danger="errors.password != undefined"
                            :danger-text="errors.password != undefined ? errors.password[0] : ''"
                            label="Password"
                            v-model="data.password"/>
                    </vs-row>
                    <vs-row vs-type="flex" vs-justify="start" vs-align="flex-center" class="mb-3">
                        <vs-input
                            type="password"
                            class="w-100"
                            :danger="errors.password_confirmation != undefined"
                            :danger-text="errors.password_confirmation != undefined ? errors.password_confirmation[0] : ''"
                            label="Ulangi Password"
                            v-model="data.password_confirmation"/>
                    </vs-row>

                    <vs-row vs-type="flex" vs-justify="flex-end" vs-align="flex-end">
                        <vs-button type="relief" class="m-1"
                                   @click="updatePassword">Simpan Perubahan
                        </vs-button>
                    </vs-row>
                </vs-card>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Password",
        methods: {
            updatePassword() {
                this.errors = [];
                let data = this.makeFormData(this.data);
                data.append('_method', 'PUT');
                this.axios.post('/api/password', data).then(res => {
                    this.$vs.notify({
                        title: res.data.text,
                        text: res.data.message,
                    })
                }).catch(error => {
                    if (error.response) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
        },
        data: function () {
            return {
                errors: [],
                data: {
                    password: "",
                    password_confirmation: "",
                },
            }
        },
    }
</script>
