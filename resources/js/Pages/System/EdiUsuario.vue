<template>    
    <TitlePage titulo="Editar Usuário">Seja Bem-vindo</TitlePage>

    <div class="">

        <div class="border border-gray-200 p-3 rounded-sm">

            <p class="text-gray-500 text-2xl mb-2">Informações Básicas</p>

            <div class="grid gap-6 mb-2 md:grid-cols-3 ">
                <div>
                    <Label>Nome completo:</Label>
                    <input type="text"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação..." />
                </div>
                
                <div>
                    <Label>E-mail do Usuário:</Label>
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação..." />
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
                    prioridade_solicitacoes: ""
                })
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

                axios.post("/pes/solicitacao/" + id_temp)
                .then((response)=>{
                
                    this.form_temp.id_solicitacoes = response.data.lista.id_solicitacoes;
                    this.form_temp.titulo_solicitacoes = response.data.lista.titulo_solicitacoes;
                    this.form_temp.prioridade_solicitacoes = response.data.lista.prioridade_solicitacoes;
                    
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