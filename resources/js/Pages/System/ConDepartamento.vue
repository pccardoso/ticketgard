<script setup>

    import TitlePage from '../Components/TitlePage.vue';
    import Table from "../Components/Table.vue";
    import ThTable from "../Components/ThTable.vue";
    import { onMounted } from 'vue';
    import { initFlowbite } from 'flowbite';
    import { useForm } from '@inertiajs/vue3';
    import axios from 'axios';
    import {Head} from '@inertiajs/vue3';

    const tes = defineProps({
        lista:Object
    })

    const form_temp = useForm({
        id_departamentos:0,
        nome_departamentos: "",
        descricao_departamentos: ""
    })

    function teste(id_temp){

        form_temp.id_departamentos = 0;
        form_temp.nome_departamentos = "";
        form_temp.descricao_departamentos = "";
        
        axios.post("/pes/departamento/" + id_temp)
        .then(function(response){
            form_temp.id_departamentos = response.data.lista.id_departamentos;
            form_temp.nome_departamentos = response.data.lista.nome_departamentos;
            form_temp.descricao_departamentos = response.data.lista.descricao_departamentos;
        })
        .catch(function (error){
            console.log(error);
        })
    }

    function atualizar(){

        form_temp.post("/upd/dep", {
            preserveScroll:true,
            onSuccess:(e)=>{
                Toast.fire({
                    icon: "success",
                    title: "Informações atualizadas com sucesso!"
                });
            }
        })

    }

    function excluir(id){

        Swal.fire({
        title: "Deseja realmente excluir o registro?",
        showCancelButton: true,
        icon: "question",
        confirmButtonText: "Confirmar",
        cancelButtonText: `Cancelar`
        }).then((result) => {

            if(result.isConfirmed){

                form_temp.delete("/del/dep/" + id,{
                    preserveScroll:true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon: "success",
                            title: "Registro deletado com sucesso!"
                        });
                    }
                })

            }

        });
    }

    onMounted(()=>{

        initFlowbite()
        
    })

</script>

<template>

    <Head>
        <title>Consultar Departamento - Ticket Gard</title>
    </Head>
    
    <TitlePage titulo="Consultar Departamento"/>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <Table>

            <thead>
                <tr>
                    <ThTable>Cód</ThTable>
                    <ThTable>Nome</ThTable>
                    <ThTable>Descrição</ThTable>
                    <ThTable>Ações</ThTable>
                </tr>
            </thead>
            <tbody class=" bg-gray-100">
                <tr class=" text-center" v-for="(l, index) in lista" v-bind:key="index">
                    <td>{{ l.id_departamentos }}</td>
                    <td>{{ l.nome_departamentos }}</td>
                    <td>{{ l.descricao_departamentos }}</td>
                    <td>
                        <button @click="teste(l.id_departamentos)" data-modal-target="default-modal" data-modal-toggle="default-modal" class="m-1 p-1" tipo="submit">
                            <svg class="w-6 h-6 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button @click="excluir(l.id_departamentos)" class="m-1 p-1">
                            <svg class="w-6 h-6 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>

        </Table>
    </div>

    <!-- Main modal -->
    <div id="default-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full  bg-gray-500/50 backdrop-blur-sm">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b  bg-blue-600">
                    <h3 class="text-xl text-white">
                        Editar Departamento
                    </h3>
                    <button type="button" class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-4 space-y-4">

                    <div v-if="!form_temp.id_departamentos" class="text-center">
                        <div class="animate-pulse">

                            <div class="mb-3">
                                <div class="p-2 mb-2 bg-gray-400 rounded-3xl w-40"></div>
                                <div class="p-2 mb-2 bg-gray-400 rounded-sm h-9"></div>
                            </div>

                            <div class="">
                                <div class="p-2 mb-2 bg-gray-400 rounded-3xl w-60"></div>
                                <div class="p-2 mb-2 bg-gray-400 rounded-sm h-9"></div>
                            </div>

                        </div>
                    </div>

                    <div v-else>

                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Nome do Departamento:</label>
                            
                            <input v-model="form_temp.nome_departamentos" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" :placeholder="form_temp.nome" required />
                            <label class="text-red text-red-700 font-bold" for="erro1" v-if="form_temp.errors.nome">{{ form_temp.errors.nome }}</label>
                        </div>

                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Descrição do Departamento:</label>
                            <input v-model="form_temp.descricao_departamentos" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" :placeholder="form_temp.descricao" required />
                            <label class="text-red text-red-700 font-bold" for="erro1" v-if="form_temp.errors.descricao">{{ form_temp.errors.nome }}</label>
                        </div>

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="flex items-center p-5 border-t border-gray-200 rounded-b">
                    <button v-show="form_temp.id_departamentos" @click="atualizar" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Salvar</button>
                    <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

</template>