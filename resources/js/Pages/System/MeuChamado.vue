<template>

    <Head>
        <title>Histórico do Chamado - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Histórico dos Tickets">Minhas Solicitações.</TitlePage>

    <div class="p-4 rounded-2xl mb-4 shadow-lg border-1 border-gray-200">
        
        <div class="grid gap-6 mb-2 md:grid-cols-3">

            <div>
                <label for="">Buscar por Código:</label>
                <input id="eCodPes" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <div>
                <label for="">Buscar por Assunto:</label>
                <input id="eAssPes" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <div>
                <label for="">Situação</label>
                <select name="" id="sSitPes" @change="pesquisar()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="5">Todos</option>
                    <option value="0">Aberto</option>
                    <option value="1">Encaminhado</option>
                    <option value="2">Execução</option>
                    <option value="3">Pendente</option>
                    <option value="4">Finalizado</option>
                </select>
            </div>

        </div>

        <ButtonPrimary @click="pesquisar()" class="inline-flex">
            
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M5.05 3C3.291 3 2.352 5.024 3.51 6.317l5.422 6.059v4.874c0 .472.227.917.613 1.2l3.069 2.25c1.01.742 2.454.036 2.454-1.2v-7.124l5.422-6.059C21.647 5.024 20.708 3 18.95 3H5.05Z"/>
            </svg>
            Filtrar

        </ButtonPrimary>

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <Table>
            <thead>
                <tr>
                    <ThTable>Cód</ThTable>
                    <ThTable>Assunto</ThTable>
                    <ThTable>Solicitação</ThTable>
                    <ThTable>Departamento</ThTable>
                    <ThTable>Situação</ThTable>
                    <ThTable>Tempo Médio</ThTable>
                    <ThTable>Abertura</ThTable>
                    <ThTable>Fechamento</ThTable>
                    <ThTable>Horas</ThTable>
                    <ThTable>Responsável</ThTable>
                    <ThTable>Ações</ThTable>
                </tr>
            </thead>
            <tbody class="text-center bg-gray-100">

                <template v-if="!list_temp">

                    <tr>
                        <td colspan="11" class="animate-pulse">
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                        </td>
                    </tr>

                </template>

                <template v-else>

                    <tr v-for="(l, index) in exemplo" :key="index" class="border-b-1 p-2 border-gray-300" >
                        <template v-if="l">
                                <td class="p-2">{{ l.id_chamados }}</td>
                                <td>{{ l.assunto_chamados }}</td>
                                <td>{{ l.titulo_solicitacoes}}</td>
                                <td>{{ l.nome_departamentos }}</td>
                                <td>
                                    <TextSituacao :valor_situacao="l.status_chamados"/>
                                </td>
                                <td>{{ l.tempo_solicitacoes + " hora(s)" }}</td>
                                <td>{{ textDataPt(l.data_cadastro_chamados) }}</td>
                                <td>
                                    <label v-if="l.data_finalizar_chamados">{{ textDataPt(l.data_finalizar_chamados) }}</label>
                                    <label v-else class="inline-flex" title="Atendimento ainda não finalizado!">
                                        <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                        </svg>
                                    </label>
                                </td>
                                <td>
                                    <template v-if="l.status_chamados != 4">
                                        <label title="Hora(s) em aberto.">{{ parseInt(calcularDias(l.data_cadastro_chamados)) + " hora(s)" }}</label>
                                    </template>
                                </td>
                                <td>
                                    <label class="font-bold text-green-500" v-if="l.id_user_chamados">{{ l.id_user_chamados == user.id ? l.name + " (eu)" : l.name }}</label>
                                    <label class="font-bold text-yellow-500" v-else>Aguardando</label>
                                </td>
                                
                                <td class="inline-flex">
                                    <button class="p-1 m-1" @click="abrirModal(l.id_chamados)">
                                        <svg class="w-6 h-6 text-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>

                                    <Link class="inline-flex p-1 m-1" :href="'/history/' + l.id_chamados">
                                        <svg class="w-6 h-6 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z" clip-rule="evenodd"/>
                                        </svg>
                                    </Link>

                                    <button v-if="l.status_chamados == 0" class="p-1 m-1" @click="excluir(l.id_chamados)">
                                        <svg class="w-6 h-6 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    
                                </td>
                        </template>
                    </tr>

                </template>
            </tbody>
        </Table>
    </div>

    <PaginationTableDefault v-if="list_temp" :list="list_temp" v-model="exemplo"/>

    <div
    id="modalEl"
    tabindex="-1"
    aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0"
>
    <div class="relative max-h-full w-full max-w-2xl">
        <!-- Modal content -->
        <div class="relative bg-white shadow-sm">
            <!-- Modal header -->
            <div
                class="flex items-start justify-between p-5 bg-blue-600"
            >
                <h3
                    class="text-xl text-white  lg:text-2xl"
                >
                    Editar Atendimento
                </h3>
                <button
                    @click="fecharModal()"
                    type="button"
                    class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-white hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                >
                    <svg
                        class="h-3 w-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-6 p-6">

                <div v-if="!this.form_temp.id_chamados">
                
                    <div class="animate-pulse">

                        <div class="mb-3">
                            <div class="p-2 mb-2 bg-gray-400 rounded-3xl w-40"></div>
                            <div class="p-2 mb-2 bg-gray-400 rounded-sm h-9"></div>
                        </div>

                        <div class="">
                            <div class="p-2 mb-2 bg-gray-400 rounded-3xl w-60"></div>
                            <div class="p-2 mb-2 bg-gray-400 h-40 rounded-sm"></div>
                        </div>

                    </div>

                </div>

                <div v-else>

                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Assunto do Atendimento:</label>
                        
                        <input v-model="this.form_temp.assunto_chamados" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" :placeholder="form_temp.nome" />
                        <label class="text-red text-red-700 font-bold" for="erro1" v-if="this.form_temp.errors.titulo_solicitacoes">{{ this.form_temp.errors.titulo_solicitacoes }}</label>
                    </div>

                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Descricao do Atendimento:</label>

                        <editor-content :editor="editor" class="overflow-auto"/>
                        
                        <!--<textarea v-model="this.form_temp.descricao_chamados" class="bg-gray-50 border h-40 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>-->
                    </div>

                </div>

            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center space-x-2 rtl:space-x-reverse rounded-b border-t border-gray-200 p-6 dark:border-gray-600"
            >
                <button
                    v-if="this.form_temp.id_chamados"
                    @click="atualizar()"
                    type="button"
                    class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300   dark:focus:ring-blue-800"
                >
                    Salvar
                </button>
                <button
                    @click="fecharModal()"
                    type="button"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-300"
                >
                    Cancelar
                </button>
            </div>
        </div>
    </div>
    </div>

</template>

<script>

    import TitlePage from '../Components/TitlePage.vue';
    import Table from "../Components/Table.vue";
    import ThTable from "../Components/ThTable.vue";
    import { usePage } from '@inertiajs/vue3';
    import {Link} from '@inertiajs/vue3';
    import IconPrioridade from '../Components/IconPrioridade.vue';
    import TextSituacao from '../Components/TextSituacao.vue';
    import {useForm} from '@inertiajs/vue3';
    import { initFlowbite } from 'flowbite';
    import {Modal} from 'flowbite';
    import ButtonPrimary from '../Components/ButtonPrimary.vue';
    import {Head} from '@inertiajs/vue3';
    import {formatDateTexPtHelpers} from "../../../helpers/format.js"
    import {formatDateTextUsHelpers} from "../../../helpers/format.js"
    import {calcDifHouUtils} from "../../../helpers/utils.js"
    import PaginationTableDefault from '../Components/PaginationTableDefault.vue';

    import { Editor, EditorContent } from '@tiptap/vue-3'
    import StarterKit from '@tiptap/starter-kit'

    export default{
        name:"MeuChamado",
        components:{
            EditorContent, TitlePage, Table, ThTable, Link, IconPrioridade, TextSituacao, ButtonPrimary, Head,PaginationTableDefault
        }, 
        data(){
            return{
                exemplo: [],
                user:Object,
                form_temp: useForm({
                    id_chamados:0,
                    assunto_chamados: "",
                    descricao_chamados: ""
                }),
                mod:Modal,
                list_temp:0,
                conteudo: '',
                editor: null,
            }
        },
        mounted(){

            this.user = usePage().props.auth.user

            //Montando o modal para edição/visualização
            const $targetEl = document.getElementById('modalEl');
            const options = {
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 fixed inset-0 z-40',
                closable: false
            };
            const instanceOptions = {
            id: 'modalEl',
            override: true
            };

            this.mod = new Modal($targetEl, options, instanceOptions);

            this.pesquisar();

            this.editor = new Editor({
                content: '',
                extensions: [StarterKit],
                onUpdate: ({ editor }) => {
                    this.conteudo = editor.getHTML()
                },
            })

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

                        useForm().delete("/del/cha/" + id,{
                            preserveScroll:true,
                            onSuccess:()=>{
                                Toast.fire({
                                    icon: "success",
                                    title: "Registro deletado com sucesso!"
                                });

                                this.pesquisar();
                            }
                        })

                    }

                });

            },
            abrirModal(id){

                this.form_temp.id_chamados = 0;

                this.mod.show()

                axios.get("/lis/chamado/" + id).
                then((response)=>{
                    this.form_temp = useForm(response.data.lista)
                    this.editor.commands.setContent(response.data.lista.descricao_chamados)
                    console.log(response)
                }).
                catch((erro)=>{
                    console.log(erro)
                })

            },
            fecharModal(){
                this.mod.hide()
            },
            atualizar(){

                if(this.form_temp.assunto_chamados){

                    this.form_temp.descricao_chamados = this.conteudo

                    this.form_temp.post("/upd/cha", {
                        preserveScroll:true,
                        onSuccess:(response)=>{
                            Toast.fire({
                                icon: "success",
                                title: "Informações atualizadas com sucesso!"
                            });
                            this.pesquisar();
                        }
                    })

                }else{
                    Swal.fire("Atenção!", "Todos os campos são obrigatórios!", "error");
                }

            },
            pesquisar(){

                this.list_temp = 0

                axios.post("/teste",{
                    assunto: eAssPes.value,
                    codigo: eCodPes.value,
                    prioridade: "",
                    situacao: sSitPes.value,
                    departamento: "",
                    inicio: "",
                    fim: "",
                    deps:[],
                    prio:[],
                    sits:[],
                    resp:[],
                    lis_dep: [],
                    id_user: this.user.id,
                    aber:[]
                }).
                then((response) =>{
                    console.log(response)
                    this.list_temp = response.data.lista
                }).
                catch((erro) => {
                    console.log(erro)
                })
            },
            textDataPt(dat){
                return formatDateTexPtHelpers(dat)
            },
            calcularDias(dat){
                return calcDifHouUtils(dat, formatDateTextUsHelpers())
            }
        },
        watch:{
            list_temp(){
                this.exemplo = []
            }
        }
    }

</script>

<style>

    /* TipTap precisa de estilos básicos */
    .ProseMirror {
    min-height: 200px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    background-color: white;
    }

</style>