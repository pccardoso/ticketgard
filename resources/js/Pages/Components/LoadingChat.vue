<template>

    <div class="p-4 space-y-4 w-full h-150 overflow-x-auto w-s animate-pulse">

        <!-- Mensagem da esquerda -->
        <div class="flex justify-start">
            <div class="bg-gray-200  text-gray-800 p-3 rounded-lg max-w-xs transition hover:ml-2 shadow-sm">
                <div class="p-2 bg-gray-500 rounded-sm w-3xs mb-2"></div>
                <div class="p-2 bg-gray-500 rounded-sm w-3xs mb-2"></div>
                <div class="p-2 bg-gray-500 rounded-sm w-2xs mb-2"></div>
                <div class="p-2 bg-gray-500 rounded-sm w-2xs mb-2"></div>
            </div>
        </div>

        <!-- Mensagem da direita -->
        <div class="flex justify-end">
            <div class="bg-gray-200 text-gray-800 p-3 rounded-lg max-w-xs transition hover:mr-2 shadow-sm ">
                <div class="p-2 bg-gray-500 rounded-sm w-3xs mb-2"></div>
                <div class="p-2 bg-gray-500 rounded-sm w-2xs mb-2"></div>
                <div class="p-2 bg-gray-500 rounded-sm w-2xs mb-2"></div>
            </div>
        </div>

        <!-- Mensagem da esquerda -->
        <div class="flex justify-start">
            <div class="bg-gray-200  text-gray-800 p-3 rounded-lg max-w-xs transition hover:ml-2 shadow-sm">
                <div class="p-2 bg-gray-500 rounded-sm w-3xs mb-2"></div>
                <div class="p-2 bg-gray-500 rounded-sm w-2xs mb-2"></div>
                <div class="p-2 bg-gray-500 rounded-sm w-3xs mb-2"></div>
                <div class="p-2 bg-gray-500 rounded-sm w-2xs mb-2"></div>
                <div class="p-2 bg-gray-500 rounded-sm w-2xs mb-2"></div>
            </div>
        </div>

        <!-- Mensagem do sistema -->
        <div class="flex justify-center">
            <div class="bg-gray-300 text-gray-900 p-3 rounded-lg max-w-xs text-center">
                <div class="p-2 bg-gray-500 rounded-sm w-2xs mb-2"></div>
            </div>
        </div>

    </div>

</template>

<script>

    export default{
        name:"LoadingChat"
    }

</script>