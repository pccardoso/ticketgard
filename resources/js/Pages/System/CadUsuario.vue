<template>

    <Head>
        <title>Novo Usuário - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Cadastrar Usuário"/>

    <div class="p-4 rounded-2xl mb-4 shadow-lg border-1 border-gray-200">

        <form @submit.prevent="cadastrarUsuario()">

            <div class="grid gap-6 mb-2 md:grid-cols-3">

                <div class="border border-gray-300 p-3 rounded-sm hover:bg-gray-200 transform duration-700">

                    <p class="text-gray-500 text-2xl mb-2">Identificação do Usuário</p>

                    <div class="">
                        <div>
                            <Label>Nome do Usuário:</Label>
                            <input type="text" v-model="form.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação..." />
                        </div>
                        
                        <div>
                            <Label>E-mail do Usuário:</Label>
                            <input type="text" v-model="form.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação..." />
                        </div>

                        <div>
                            <Label>Senha do Usuário:</Label>
                            <input type="password" v-model="form.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação..." />
                        </div>
                    </div>

                </div>

                <div class="border border-gray-300 p-3 rounded-sm hover:bg-gray-200 transform duration-700">

                    <p class="text-gray-500 text-2xl mb-2">Parâmetros Importantes</p>

                    <div class="">

                        <div>
                            <Label>Departamento(s) do Usuário: {{ countDepSelected }}</Label>

                            <div class="h-50 overflow-x-auto pr-5 pl-5 border-1 rounded-sm border-gray-300 pt-3 pb-3">

                                <p class="bg-gray-300 mb-2 rounded-3xl p-3 hover:bg-gray-400 shadow-sm transform duration-700" v-for="(l, index) in dep_temp"> <input type="checkbox" name="eDep" :value="l.id_departamentos" v-model="form.lista_departamento_users" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500"> {{ l.nome_departamentos }} </p>

                            </div>

                        </div>

                        <div>
                            <Label>Grupo do Usuário:</Label>
                            <select v-model="form.tipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação...">
                                <option value="0">- selecione o grupo do usuário -</option>
                                <option value="1">LIDERADOS</option>
                                <option value="2">LÍDERES</option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="border border-gray-300 p-3 rounded-sm hover:bg-gray-200 transform duration-700">

                    <p class="text-gray-500 text-2xl mb-2">Parâmetros Adicionais</p>

                    <div class="">

                        <div>
                            <Label>Permissão do Usuário:</Label>
                            <select v-model="form.administrador" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação...">
                                <option value="0">Usuário comum</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>

                        <div>
                            <Label>Habilitado a aderir chamados:</Label>
                            <select v-model="form.res_chamados" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação...">
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>

                        <div>
                            <Label>Usuário VIP (Prioridade no Atendimento): </Label>
                            <select v-model="form.vip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação...">
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>

                    </div>

                </div>

            </div>

            <div class="mt-3">
                <ButtonPrimary type="submit" :disabled="form.processing">Cadastrar</ButtonPrimary>
                <ButtonDanger type="reset">Limpar</ButtonDanger>
            </div>

        </form>

    </div>

</template>

<script>

    import TitlePage from '../Components/TitlePage.vue';
    import ButtonPrimary from '../Components/ButtonPrimary.vue';
    import ButtonDanger from '../Components/ButtonDanger.vue';
    import { useForm } from '@inertiajs/vue3';
    import Label from '../Components/Label.vue';
    import {Head} from '@inertiajs/vue3';

    export default{
        name:"CadUsuario",
        data(){
            return{
                dep_temp:{},
                form: useForm({
                    name: "",
                    email: "",
                    password: "",
                    tipo: 0,
                    id_departamento_users: 0,
                    administrador: 0,
                    res_chamados: 0,
                    upload:"",
                    lista_departamento_users: [],
                    vip: 0
                }),
                status_vip: false
            }
        },
        components:{
            TitlePage, ButtonPrimary, ButtonDanger, Label, Head
        },
        mounted(){
            axios.post("/lis/departamento").
            then((response)=>{
                this.dep_temp = response.data.lista
            }).
            catch((erro)=>{

            })
        },
        methods:{
            testar(){

                axios.post("https://editor.dantlab.com/webhook-test/84cfc8bb-53b7-4eae-a21a-53d49f79da06",{
                    nome: "Paulo Cesar"
                }).
                then((response)=>{
                    console.log(response);
                }).
                catch((response) => {
                    console.log(response);
                })

            },
            cadastrarUsuario(){

                // VERIFICAR A LISTA DE DEPARTAMENTOS SELECIONADAS PARA O USUÁRIO EM QUESTÃO
                !this.form.lista_departamento_users.length ? Swal.fire("Atenção!", "Usuário está sem departamento, favor, selecione-o!", "error") : 

                this.form.post("/cad/usu", {
                    preserveScroll:true,
                    onSuccess:(result)=>{
                        Toast.fire({title:"Sucesso! Usuário cadastrado!", icon:"success"})
                        this.form.reset()

                        

                    },
                    onError:(erro) =>{
                        Swal.fire("Atenção!", "Erro ao cadastrar usuário!", "error")
                        console.log(erro);
                    }
                })
            },
            check1(){

                if(defaultcheckbox1.checked){
                    this.form.administrador = 1;
                }else{
                    this.form.administrador = 0;
                }

            },
            check2(){

                if(defaultcheckbox2.checked){
                    this.form.res_chamados = 1;
                }else{
                    this.form.res_chamados = 0;
                }

            }
        },
        computed:{
            countDepSelected(){

                let msg = ""

                this.form.lista_departamento_users.length ? msg = this.form.lista_departamento_users.length : msg = "nada selecionado"
                return msg
            }
        }
    }

</script>