<template>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">username</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <vs-card class="mt-1">
                    <h4 class="mb-3">Profile</h4>

                    <vs-row vs-type="flex" vs-justify="start" vs-align="flex-center" class="mb-3">
                        <vs-input
                            type="text"
                            class="w-100"
                            :danger="errors.name != undefined"
                            :danger-text="errors.name != undefined ? errors.name[0] : ''"
                            label="name"
                            v-model="user.name"/>
                    </vs-row>

                    <vs-row vs-type="flex" vs-justify="start" vs-align="flex-center" class="mb-3">
                        <vs-input
                            type="text"
                            class="w-100"
                            :danger="errors.username != undefined"
                            :danger-text="errors.username != undefined ? errors.username[0] : ''"
                            label="username"
                            v-model="user.username"/>
                    </vs-row>

                    <vs-row vs-type="flex" vs-justify="start" vs-align="flex-center" class="mb-3">
                        <vs-input
                            type="text"
                            class="w-100"
                            :danger="errors.email != undefined"
                            :danger-text="errors.email != undefined ? errors.email[0] : ''"
                            label="email"
                            v-model="user.email"/>
                    </vs-row>

                    <vs-row vs-type="flex" vs-justify="flex-end" vs-align="flex-end">
                        <vs-button type="relief" class="m-1"
                                   @click="updateusername">Simpan Perubahan
                        </vs-button>
                    </vs-row>
                </vs-card>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Profile",
        methods: {
            updateusername() {
                this.errors = [];
                let data = this.makeFormData(this.user);
                data.append('_method', 'PUT');
                this.axios.post('/api/myprofile', data).then(res => {
                    this.$vs.notify({
                        title: res.data.text,
                        text: res.data.message,
                    });
                    this.$store.commit("SET_USER", res.data.data);
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
            }
        },
    }
</script>
