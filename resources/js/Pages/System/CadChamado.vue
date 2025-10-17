
<template>

    <Head>
        <title>Novo Ticket - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Novo Ticket"></TitlePage>

    <div class="p-4 rounded-2xl mb-4 shadow-lg border-1 border-gray-200">

        <form @submit.prevent="cadastrar()">

            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Assunto do Ticket:</label>
                    <input v-model="form_temp.assunto_chamados" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nome do departamento..." />
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Departamento Responsável:</label>
                    <select @change="selectSolicitacao()" v-model="form_temp.id_departamento_chamados" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="0">- selecione o departamento -</option>
                        <option v-for="(l, index) in listaDepartameto" :key="index" :value="l.id_departamentos">{{ l.nome_departamentos }}</option>  
                    </select>
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Tipo de Solicitação:</label>
                    <select id="sSelSol" v-model="form_temp.id_solicitacao_chamados" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="0">- selecione o tipo de solicitação -</option>
                        <option v-for="(l, index) in listaSolicitacao" :key="index" :value="l.id_solicitacoes">{{ l.titulo_solicitacoes }}</option>
                    </select>
                </div>

            </div>

            <div class="mt-2 mb-2">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Descrição do Chamado:</label>
                <!--<textarea v-model="form_temp.descricao_chamados" class="bg-gray-50 h-40 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>-->

                <editor-content :editor="editor" class="overflow-auto"/>
            </div>

            <div class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded-lg mb-4 flex items-center my-5" role="alert">
                <span>A <strong>edição do ticket</strong> está disponível <strong>apenas enquanto estiver aberto</strong>. Depois de atribuído a um atendente, não será mais possível alterar as informações.</span>
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-3">

                <div>
                    <input type="file" hidden multiple accept=".jpg,.png,.jpeg,.pdf,.xls" @change="handleFileChange" id="file" class="bg-gray-50 border border-gray-300 text-blue-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
                    <label for="file" class="inline-flex bg-gray-200 p-3 rounded-3xl hover:shadow-sm hover:bg-blue-500 hover:text-white mt-3">
                        
                        <svg class="w-5 h-5 mr-2 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                        </svg>

                        Anexar Arquivos

                    </label>
                </div>
            </div>

            <div v-if="form_temp.file.length" class="p-3 bg-gray-100 rounded-2xl w-110 shadow-inner">

    <div class="text-center mb-3">
        <span class="text-gray-700 font-medium">{{ atualizarQuanFiles }}</span>
    </div>

    <div v-for="(f, index) in form_temp.file" :key="index"
        class="flex items-center justify-between p-3 mb-2 bg-white rounded-xl shadow hover:shadow-lg transition-shadow duration-200">

        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-800 font-medium truncate max-w-[180px]">{{ f.name }}</span>
        </div>

        <div @click="excluirAnexo(index)" class="p-1 rounded-full hover:bg-red-100 cursor-pointer transition-colors">
            <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
            </svg>
        </div>

    </div>

</div>


            <br>

            <div v-if="form_temp.processing">

                <div role="status" class="inline-flex">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Um momento, cadastrando!</span>
                    <p class="font-bold p-1 text-blue-700">Um momento, cadastrando!</p>
                    
                </div>

            </div>

            <div v-else>

                <ButtonPrimary type="submit" class="inline-flex">
                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M11 16h2m6.707-9.293-2.414-2.414A1 1 0 0 0 16.586 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.414a1 1 0 0 0-.293-.707ZM16 20v-6a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v6h8ZM9 4h6v3a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V4Z"/>
                    </svg>
                    Cadastrar
                </ButtonPrimary>

                <ButtonDanger type="reset" class="inline-flex">
                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                    </svg>
                    Limpar
                </ButtonDanger>

            </div>

        </form>

    </div>

</template>

<script>

    import TitlePage from '../Components/TitlePage.vue';
    import ButtonPrimary from '../Components/ButtonPrimary.vue';
    import ButtonSuccess from '../Components/ButtonSuccess.vue';
    import ButtonDanger from '../Components/ButtonDanger.vue';
    import { useForm, usePage } from '@inertiajs/vue3';
    import axios from 'axios';
    import InputText from '../Components/InputText.vue';
    import {Head} from '@inertiajs/vue3';
    import { Editor, EditorContent } from '@tiptap/vue-3'
    import StarterKit from '@tiptap/starter-kit'
    import { useExampleStore } from '../../../store/store.js';

    export default{
        name:"CadChamado",
        components:{
            TitlePage, ButtonDanger, ButtonPrimary, ButtonSuccess, InputText, Head, EditorContent
        },
        data(){
            return{
                listaDepartameto:Object,
                listaSolicitacao:Object,
                usuario:Object,
                form_temp:useForm({
                    assunto_chamados:"",
                    id_departamento_chamados:0,
                    id_solicitacao_chamados:0,
                    descricao_chamados:"",
                    id_criador_chamados: 0,
                    nome_criador_chamados: "",
                    file: "",
                    vip_criador_chamados: 0
                }),
                conteudo: '',
                editor: null,
                exemple: false
            }
        },
        computed:{
            atualizarQuanFiles(){
                return "Arquivo(s) selecionado(s): " + this.form_temp.file.length + " arquivo(s)"
            }
        },
        methods:{

            handleFileChange(event) {
                // Aqui estamos manipulando a mudança do input do tipo "file"
                let file = event.target.files;
                this.form_temp.file = file; // Definimos o arquivo no form

                console.log(file)
            },
            selectSolicitacao(){
                //a cada alteração no select 'departamento'

                //criando uma requisição para a rota do Laravel
                axios.post("/lis/solicitacao").
                then((response)=>{  

                    //variável temporária
                    const temp = [];

                    //vasculhando a lista de solicitacoes encontradas
                    response.data.lista.forEach(element => {
                        //filtrando as listas de solicitacoes para cada departamento
                        element.id_departamento_solicitacoes == this.form_temp.id_departamento_chamados ? temp.push(element) : 0
                    });
                    //atualizando a lista de solicitacoes (reatividade)
                    this.listaSolicitacao = temp

                    sSelSol.value = "0"
                }).
                catch((erro)=>{
                    console.log(erro);
                })

            
            },
            cadastrar(){
                try{
                    if(this.form_temp.assunto_chamados && this.form_temp.id_departamento_chamados && this.form_temp.id_solicitacao_chamados){
                        this.form_temp.descricao_chamados = this.conteudo                    
                        this.form_temp.post("/cad/cha", {
                            preserveScroll:true,
                            onSuccess:()=>{
                                Toast.fire({
                                    icon: "success",
                                    title: "Cadastrado com sucesso!"
                                });
                                this.form_temp.reset("assunto_chamados")
                                this.form_temp.reset("id_departamento_chamados")
                                this.form_temp.reset("id_solicitacao_chamados")
                                this.form_temp.reset("descricao_chamados")
                                this.form_temp.reset("file")
                                file.value = ""

                            },
                            onError:(erro)=>{
                                alert(`Erro: ${erro}`);
                            }
                        })
                    }else{
                        Swal.fire("Atenção", "Todos os campos são obrigatórios!", "error");
                    }
                }catch(error){
                    alert(`Erro: ${error}`);
                }

            },
            async uploadFile() {

                // Criando o FormData para enviar o arquivo
                const formData = new FormData();
                const file = this.$refs.file.files[0]; // Pega o arquivo do input
                formData.append('file', file);

                console.log(formData)

                    try {
                    // Fazendo a requisição POST para enviar o arquivo
                    const response = await axios.post('/upload', formData, {
                        headers: {
                        'Content-Type': 'multipart/form-data', // Tipo de conteúdo para envio de arquivos
                        },
                    });

                    // Armazenar o caminho do arquivo retornado na resposta
                    console.log(response)
                    } catch (err) {
                        // Em caso de erro, exibir a mensagem
                        if (err.response && err.response.data) {
                            this.error = err.response.data.error || 'Erro desconhecido';
                        } else {
                            this.error = 'Erro de rede ou servidor';
                        }
                    }
            },
            excluirAnexo(fil){

                let tem = [...this.form_temp.file]

                tem.splice(fil, 1)

                this.form_temp.file = tem
            }
        },
        //após a montagem do componente
        mounted(){

            this.exemple = useExampleStore();

            //criando uma nova requisição para as rotas do Laravel
            axios.post("/lis/departamento").
            then((response)=>{  
                //atualizando variáveis reativas com a lista de departamentos
                this.listaDepartameto = response.data.lista
            }).
            catch((erro)=>{
                console.log(erro);
            })

            this.form_temp.id_criador_chamados = this.usuario.id
            this.form_temp.nome_criador_chamados = this.usuario.name
            this.form_temp.vip_criador_chamados = this.usuario.vip

            this.editor = new Editor({
                content: '',
                extensions: [StarterKit],
                onUpdate: ({ editor }) => {
                    this.conteudo = editor.getHTML()
                },
            })

        },
        beforeMount(){
            this.usuario = usePage().props.auth.user;
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