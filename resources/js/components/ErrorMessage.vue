<template>
<span>
    <div class="con-text-validation span-text-validation-danger vs-input--text-validation-span v-enter-to"
         style="height: 21px;">
        <span class="span-text-validation">{{message}} </span>
    </div>
</span>
</template>

<script>
    export default {
        name: "ErrorMessage",
        props: {message: {type: String, default: "", required: false},},
    }
</script>
