<script setup>
    defineProps({
        titulo:String
    })
</script>

<template>
    <h3 class="text-3xl text-blue-700">{{ titulo }}</h3>
    <p class="mb-5 text-gray-500"><slot></slot></p>
</template>