<script setup>

    import { onMounted } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import ButtonPrimary from '../Components/ButtonPrimary.vue';
    import ButtonDanger from '../Components/ButtonDanger.vue';
    import TitlePage from '../Components/TitlePage.vue';
    import {Head} from '@inertiajs/vue3';

    const formulario = useForm({
        nome_departamentos: "",
        descricao_departamentos: ""
    })

    function enviar_form(){
        formulario.post("/cad/dep",{
            preserveScroll:true,
            onSuccess:(e)=>{
                formulario.reset();
                Toast.fire({
                    icon: "success",
                    title: "Cadastrado com sucesso!"
                });
            },
            onError:(erro)=>{
                console.log(erro)
            }
        });
    }

</script>

<template>
    
    <Head>
        <title>Novo Departamento - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Cadastrar Departamento"></TitlePage>

    <div class="bg-gray-100 p-4 rounded-2xl mb-4 shadow-sm">
        <form @submit.prevent="enviar_form">

            <div class="grid gap-6 mb-6 md:grid-cols-3">
                
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Nome do Departamento:</label>
                    <input v-model="formulario.nome_departamentos" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nome do departamento..." required />
                    <label class="text-red text-red-700 font-bold" for="erro1" v-if="formulario.errors.nome">{{ formulario.errors.nome }}</label>
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Descrição do Departamento:</label>
                    <input v-model="formulario.descricao_departamentos" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Descrição do departamento..." required />
                    <label class="text-red text-red-700 font-bold" for="erro1" v-if="formulario.errors.descricao">{{ formulario.errors.nome }}</label>
                </div>

            </div>

            <ButtonPrimary type="submit">Salvar</ButtonPrimary>
            <ButtonDanger type="reset">Limpar</ButtonDanger>


        </form>
    </div>
</template>
