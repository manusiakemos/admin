<template>
    <div>
        <b-form-checkbox-group v-model="propModel">
            <b-form-checkbox
                v-for="(v, index) in options"
                :key="index"
                :value="v[optionValue]">
                {{ v[optionText] }}
            </b-form-checkbox>
        </b-form-checkbox-group>
    </div>
</template>

<script>

export default {
    created() {
        this.axios.post(this.url).then(res => {
            this.options = res.data;
        });
    },
    data() {
        return {
            options: [],
        };
    },
    computed: {
        propModel: {
            get() {
                return this.value;
            },
            set(value) {
                this.$emit("input", value);
            }
        }
    },
    props: {
        value: {default: null, required: true},
        optionText: {default: "text", required: false},
        optionValue: {default: "value", required: false},
        placeholderText: {default: "Pilih Salah Satu", required: false},
        url: {type: String, default: "/api/select/status", required: false},
    },
}
</script>
