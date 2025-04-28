<script setup>

    defineProps({
        tipo:String
    })

</script>

<template>
    <button class="mr-2 border-2 font-bold hover:shadow-lg transition duration-300 rounded-sm p-1.5 border-gray-500 text-gray-500" v-bind:tipo="tipo"><slot></slot></button>
</template>