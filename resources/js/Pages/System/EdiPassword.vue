<template>

    <Head>
        <title>Nova Senha - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Alterar Senha"></TitlePage>

    <div class="p-4 rounded-2xl mb-4 shadow-lg border-1 border-gray-200">

        <div class="border border-gray-200 p-3 rounded-sm mb-3">

            <p class="text-gray-500 text-2xl mb-2">Formulário de Senha</p>

            <div class="grid gap-6 mb-2 md:grid-cols-3 ">
                <div>
                    <Label>Nova Senha:</Label>
                    <input id="senha1" v-model="this.form_temp.senha1" type="password"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação..." />
                </div>
                
                <div>
                    <Label>Confirme a nova senha:</Label>
                    <input id="senha2" v-model="this.form_temp.senha2" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação..." />
                </div>

            </div>
        </div>

        <ButtonPrimary @click="validar()" class="inline-flex">
            
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
            </svg>

            Salvar
        
        </ButtonPrimary>

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
    import ButtonPrimary from "../Components/ButtonPrimary.vue";
    import ButtonDanger from "../Components/ButtonDanger.vue";
    import { usePage } from "@inertiajs/vue3";
    import Label from "../Components/Label.vue";
    import {Head} from "@inertiajs/vue3";

    export default{
        name:"ConSolicitacao",
        components:{
            TitlePage, FormButton, Table, ThTable, IconPrioridade, ButtonPrimary, ButtonDanger, Label, Head
        },
        data(){
            return{
                form_temp:useForm({
                    senha1: "",
                    senha2: "",
                    id_users: 0
                }),
                user: Object
            }
        },
        props:{
            listaSolicitacoes:Object
        },
        mounted(){
            this.user = usePage().props.auth.user;
        },
        methods:{

            validar(){

                if(!senha1.value || !senha2.value){
                    Swal.fire("Atenção!", "Todos os campos são obrigatórios!", "error");
                }else if(senha1.value != senha2.value){
                    Swal.fire("Atenção!", "As senhas não coferem!", "warning");
                }else{

                    Swal.fire({
                        title: "Deseja realmente atualizar sua senha?",
                        text: "Ao prosseguir será necessário uma nova autenticação, portanto, anote-a em local seguro e confidencial.",
                        showCancelButton: true,
                        icon: "question",
                        confirmButtonText: "Confirmar",
                        cancelButtonText: `Cancelar`
                    }).then((result) => {

                        if(result.isConfirmed){

                            this.form_temp.id_users = this.user.id
                            console.log(this.id_users)

                            this.form_temp.post("/salvar/senha",{
                                preserveScroll:true,
                                onSuccess:(result)=>{
                                    console.log(result)
                                }
                            })

                        }

                    })

                }
            }
        }

    }

</script>