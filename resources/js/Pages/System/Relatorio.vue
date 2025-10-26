<template>

    <Head>
        <title>Relatório - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Relatório"></TitlePage>

    <div class="p-4 rounded-2xl mb-4 shadow-lg border-1 border-gray-200">

        <div class="grid gap-6 mb-2 md:grid-cols-5 ">

            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Departamento: </label>
                <select
                    v-model="dataFilter.departamento" @change="updateDepartamento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">- selecione o departamento -</option>
                    <option v-for="(l, index) in departamento" :key="index" :value="l.id_departamentos">{{
                        l.nome_departamentos }}</option>
                </select>
            </div>

            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Solicitações</label>
                <select 
                    v-model="dataFilter.solicitacao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">- Todos as solicitações -</option>
                    <option v-for="(l, index) in solicitacao.solicitacoes" :key="index" :value="l.id_solicitacoes">{{
                        l.titulo_solicitacoes }}</option>
                </select>
            </div>

            <div>
                <label>Data Inicial:</label>
                <VueDatePicker v-model="dataFilter.data_inicial" @change="pesquisar()" :format="'dd/MM/yyyy'"></VueDatePicker>
            </div>

            <div>
                <label>Data Final:</label>
                <VueDatePicker v-model="dataFilter.data_final" @change="pesquisar()" :format="'dd/MM/yyyy'"></VueDatePicker>
            </div>

            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Funcionário do Departamento: </label>
                <select 
                    v-model="dataFilter.responsavel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">- selecione o funcionário -</option>
                    <option v-for="(l, index) in usuario" :key="index" :value="l.id_users">{{
                        l.name }}</option>
                </select>
            </div>

        </div>

        <ButtonPrimary @click="gerarPdf" class="inline-flex disabled:bg-blue-400" :disabled="loading">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                    clip-rule="evenodd" />
            </svg>
            {{ loading ? `Gerando PDF` : `Emitir PDF` }}
        </ButtonPrimary>

    </div>

</template>

<script>

import TitlePage from "../Components/TitlePage.vue";
import FormButton from "../Components/FormButton.vue";
import Table from "../Components/Table.vue";
import ThTable from "../Components/ThTable.vue";
import IconPrioridade from "../Components/IconPrioridade.vue";
import ButtonPrimary from "../Components/ButtonPrimary.vue";
import ButtonDanger from "../Components/ButtonDanger.vue";
import { usePage } from "@inertiajs/vue3";
import Label from "../Components/Label.vue";
import { Head } from "@inertiajs/vue3";
import VueDatePicker from '@vuepic/vue-datepicker';
import { exportPdf, getAllDepartament, getAllUsers } from "../../../helpers/utils";
import Swal from "sweetalert2";

export default {
    name: "Relatorio",
    components: {
        TitlePage, FormButton, Table, ThTable, IconPrioridade, ButtonPrimary, ButtonDanger, Label, Head, VueDatePicker
    },
    data() {
        return {
            listaDepartameto: [
                { id_departamentos: 1, nome_departamentos: "Paulo"},
                { id_departamentos: 1, nome_departamentos: "Paulo"},
                { id_departamentos: 1, nome_departamentos: "Paulo"},
                { id_departamentos: 1, nome_departamentos: "Paulo"}
            ],
            dataFilter: {
                departamento: 0,
                solicitacao: 0,
                data_inicial: "",
                data_final: "",
                responsavel: 0,
            },
            user: {},
            departamento: [],
            solicitacao: [],
            usuario: [],
            listaUsuario: [],
            loading: false
        }
    },
    props: {
        listaSolicitacoes: Object
    },
    async mounted() {
        this.user = usePage().props.auth.user;
        await this.init();
    },
    methods: {
        async gerarPdf(){

            try{
                this.loading = true;
                if(this.dataFilter.departamento && this.dataFilter.data_final && this.dataFilter.data_final){
                    await exportPdf(this.dataFilter);

                }else{
                    Swal.fire("Atenção!", "Departamento e período inicial/final são obrigatórios!", "warning");
                }
            }catch(error){
                Swal.fire("Atenção!", "Erro ao emitir o relatório, favor contatar o departamento de Tecnologia.", "error")
            }finally{
                this.loading = false;
            }

        },
        async init(){

            try{

                const [responseDepartamento, responseUsuario] = await Promise.all([getAllDepartament(), getAllUsers()]);
                this.departamento = responseDepartamento?.lista?.filter(departamento => this.user?.department?.includes(departamento?.id_departamentos)) ?? [];
                this.listaUsuario = responseUsuario.lista;

            }catch(error){
                console.log(error);
            }

        },
        updateDepartamento(){
            this.solicitacao = this.departamento.find(departam => departam.id_departamentos === this.dataFilter.departamento);
            this.usuario = this.listaUsuario.filter(user => JSON.parse(user.lista_departamento_users).includes(this.dataFilter.departamento));
        }
    }

}

</script>