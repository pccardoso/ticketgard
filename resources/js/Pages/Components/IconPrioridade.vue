<template>  

    <label class="text-center inline-flex" :title="icon[1]">
        <svg class="w-6 h-6 " :class="icon[0]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
        </svg>
    </label>

</template>

<script>

    export default{

        name:"IconPrioridade",
        props:{
            valor_prioridade:Number
        },
        computed:{

            icon(){
                switch (this.valor_prioridade) {
                    case 1: return ["text-green-500", "Prioridade Baixa"]; break;
                    case 2: return ["text-yellow-500", "Prioridade Normal"]; break;
                    case 3: return ["text-red-500", "Alta Prioridade"]; break;
                }
            }

        }

    }

</script>