<template>

    <Head>
        <title>Nova Solicitação - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Cadastrar Solicitacao"></TitlePage>

    <div @submit.prevent="cadastrar" class="bg-gray-100 p-4 rounded-2xl mb-4 shadow-sm">
        <form>
            <div class="grid gap-6 mb-6 md:grid-cols-4">

                <div>
                    <Label>Selecione o Departamento:</Label>
                    <select v-model="form_temp.id_departamento_solicitacoes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="0">- selecione o departamento -</option>
                        <option v-for="(dep, index) in dep_temp" v-bind:key="index" :value="dep.id_departamentos">{{ dep.nome_departamentos }}</option>
                    </select>
                </div>

                <div>
                    <Label>Selecione o título da solicitação:</Label>
                    <input v-model="form_temp.titulo_solicitacoes" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título da solicitação..." />
                </div>

                <div>
                    <Label>Selecione a Prioridade:</Label>
                    <select v-model="form_temp.prioridade_solicitacoes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="0">- selecione a prioridade -</option>
                        <option value="1">Baixa</option>
                        <option value="2">Normal</option>
                        <option value="3">Alta</option>
                    </select>
                </div>

                <div>
                    <Label>Tempo Médio (horas):</Label>
                    <input v-model="form_temp.tempo_solicitacoes" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Horas" />
                </div>

            </div>        

            <ButtonPrimary type="submit"> Salvar</ButtonPrimary>
            <ButtonDanger type="reset">Limpar</ButtonDanger>
        </form>

    </div>

</template>

<script>
    import axios from 'axios';
    import ButtonPrimary from '../Components/ButtonPrimary.vue';
    import ButtonDanger from '../Components/ButtonDanger.vue';
    import IconCheck from '../Icons/IconCheck.vue';
    import Label from '../Components/Label.vue';
    import { useForm } from '@inertiajs/vue3';
    import TitlePage from '../Components/TitlePage.vue';
    import {Head} from '@inertiajs/vue3';

    export default{
        components:{
            ButtonPrimary, ButtonDanger, IconCheck, Label, TitlePage, Head
        },
        name:"CadSolicitacao",
        data(){
            return{
                dep_temp: {},
                form_temp: useForm({
                    id_departamento_solicitacoes:0,
                    titulo_solicitacoes: "",
                    prioridade_solicitacoes: 0,
                    tempo_solicitacoes: 0
                })
            }
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
            cadastrar(){
                
                !this.form_temp.id_departamento_solicitacoes || !this.form_temp.titulo_solicitacoes || !this.form_temp.prioridade_solicitacoes ? Swal.fire("Atenção", "Os campos são obrigatórios!", "error") : 
                this.form_temp.post("/cad/sol",{
                    preserveScroll:true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon: "success",
                            title: "Cadastrado com sucesso!"
                        });
                        this.form_temp.reset();
                    }
                })

            }
        }
    }
</script>