<template>
    <vs-select
        class="w-100 mb-3"
        :danger="errors.length > 0"
        :danger-text="errors"
        :label="label"
        autocomplete
        v-model="propModel">
        <vs-select-item :key="index" :value="item[optionValue]" :text="item[optionText]"
                        v-for="(item,index) in options" />

    </vs-select>
</template>

<script>
    export default {
        name: "SelectAjax",
        created(){
            this.axios.post(this.url).then(res=>{
                this.options = res.data;
            })
        },
        props:['url', 'optionText', 'optionValue', 'value','errors', 'label'],
        data: function () {
            return {options: [],}
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
    }
</script>

<style scoped>

</style>
