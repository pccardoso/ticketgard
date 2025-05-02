<template>

    <TitlePage titulo="Consultar Solicitações"></TitlePage>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <Table>
            <thead>
                <tr>
                    <ThTable>Cód</ThTable>
                    <ThTable>Assunto</ThTable>
                    <ThTable>Prioridade</ThTable>
                    <ThTable>Departamento</ThTable>
                    <ThTable>Tempo Médio</ThTable>
                    <ThTable>Ações</ThTable>
                </tr>
            </thead>
            <tbody class=" bg-gray-100">
                <tr class="text-center " v-for="(l, index) in listaSolicitacoes" v-bind:key="index">
                    <td>{{ l.id_solicitacoes }}</td>
                    <td>{{ l.titulo_solicitacoes }}</td>
                    <td class="font-bold">
                        <IconPrioridade :valor_prioridade="parseInt(l.prioridade_solicitacoes)"/>
                    </td>
                    <td>{{ l.nome_departamentos }}</td>
                    <td>{{ l.tempo_solicitacoes + "hora(s)" }}</td>
                    <td>
                        <button @click="abrirModal(l.id_solicitacoes)" data-modal-target="default-modal" data-modal-toggle="default-modal" class="m-1 p-1" tipo="submit">
                            <svg class="w-6 h-6 text-blue-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button @click="excluir(l.id_solicitacoes)" class="m-1 p-1">
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
                <div class="flex items-center justify-between p-5 bg-blue-700">
                    <h3 class="text-xl text-white">
                        Editar Solicitação
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

                    <div v-if="!this.form_temp.id_solicitacoes" class="text-center">

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
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Título da Solicitação:</label>
                            
                            <input v-model="this.form_temp.titulo_solicitacoes" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                            <label class="text-red text-red-700 font-bold" for="erro1" v-if="this.form_temp.errors.titulo_solicitacoes">{{ this.form_temp.errors.titulo_solicitacoes }}</label>
                        </div>

                        <div>

                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Prioridade da Solicitação:</label>
                            
                            <select v-model="this.form_temp.prioridade_solicitacoes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="1">Baixa</option>
                                <option value="2">Normal</option>
                                <option value="3">Alta</option>
                            </select>

                        </div>


                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Tempo médio da Solicitação (horas):</label>
                            
                            <input v-model="this.form_temp.tempo_solicitacoes" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                            <label class="text-red text-red-700 font-bold" for="erro1" v-if="this.form_temp.errors.tempo_solicitacoes">{{ this.form_temp.errors.tempo_solicitacoes }}</label>
                        </div>

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="flex items-center p-5 border-t border-gray-200 rounded-b">
                    <button v-show="this.form_temp.id_solicitacoes"  @click="atualizar" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Salvar</button>
                    <button  data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL VISUALIZAR PENDÊNCIAS -->

    <div v-if="showModalClose" class="relative z-40" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-blue-600 px-4 py-3 sm:flex sm:px-6">
                        <label for="forTitle" class="text-[14pt] text-white">Última Pendência</label>
                    </div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto" @click="saveInterruptCall()">Confirmar</button>
                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="showModalClose=false">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 

</template>

<script>

    import TitlePage from "../Components/TitlePage.vue";
    import FormButton from "../Components/FormButton.vue";
    import Table from "../Components/Table.vue";
    import ThTable from "../Components/ThTable.vue";
    import IconPrioridade from "../Components/IconPrioridade.vue";
    import { useForm } from "@inertiajs/vue3";
    import { initFlowbite } from "flowbite";

    export default{
        name:"ConSolicitacao",
        components:{
            TitlePage, FormButton, Table, ThTable, IconPrioridade
        },
        data(){
            return{
                form_temp:useForm({
                    id_solicitacoes: 0,
                    titulo_solicitacoes: "",
                    prioridade_solicitacoes: "",
                    tempo_solicitacoes: 0
                }),
                showModalClose: false
            }
        },
        props:{
            listaSolicitacoes:Object
        },
        mounted(){
            initFlowbite()
        },
        methods:{
            excluir(id){

                Swal.fire({
                title: "Deseja realmente excluir o registro?",
                showCancelButton: true,
                icon: "question",
                confirmButtonText: "Confirmar",
                cancelButtonText: `Cancelar`
                }).then((result) => {

                    if(result.isConfirmed){

                        useForm().delete("/del/sol/" + id,{
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

            },

            abrirModal(id_temp){

                this.form_temp.id_solicitacoes = 0
                this.form_temp.titulo_solicitacoes = ""
                this.prioridade_solicitacoes = ""
                this.tempo_solicitacoes = 0

                axios.post("/pes/solicitacao/" + id_temp)
                .then((response)=>{
                
                    this.form_temp.id_solicitacoes = response.data.lista.id_solicitacoes;
                    this.form_temp.titulo_solicitacoes = response.data.lista.titulo_solicitacoes;
                    this.form_temp.prioridade_solicitacoes = response.data.lista.prioridade_solicitacoes;
                    this.form_temp.tempo_solicitacoes = response.data.lista.tempo_solicitacoes;
                    
                })
                .catch(function (error){
                    console.log(error);
                })
            },

            atualizar(){

                this.form_temp.post("/upd/sol", {
                    preserveScroll: true,
                    onSuccess:(result) => {
                        Toast.fire({
                            icon: "success",
                            title: "Informações atualizadas com sucesso!"
                        });
                    }
                })

            }
        }

    }

</script>