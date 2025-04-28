<template>

    <label class="font-bold " :class="text_status[0]">{{text_status[1]}}</label>

</template>

<script>

    export default{
        name: "TextSituacao",
        props:{
            valor_situacao: Number
        },
        computed:{
            text_status(){
                switch (this.valor_situacao) {
                    case 0: return ["text-red-500", "Aberto"]; break;
                    case 1: return ["text-yellow-500", "Encaminhado"]; break;
                    case 2: return ["text-green-500", "Execução"]; break;
                    case 3: return ["text-red-500", "Pendente"]; break;
                    case 4: return ["text-blue-500", "Resolvido"]; break;
                    case 5: return ["text-red-500", "Não Resolvido"]; break;
                    case 6: return ["text-blue-500", "Sem Retorno"]; break;
                }
            }
        }
    }

</script>