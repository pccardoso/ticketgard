<template>

  <Head>
    <title>Home - Ticket Gard</title>
  </Head>

  <TitlePage titulo="Home">Visão dos meus Tickets</TitlePage>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6 mb-6">

    <div
      class="bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-2xl shadow-lg p-6 flex items-start gap-4 hover:scale-[1.02] transition-transform duration-300">
      <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-white/20 backdrop-blur-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 2a2 2 0 00-2 2v16a2 2 0 002 2h10a2 2 0 002-2V8l-6-6H7z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 3v6h6M9 13h6M9 17h3" />
        </svg>
      </div>
      <div>
        <h3 class="text-lg font-semibold mb-1">Relatórios em PDF</h3>
        <p class="text-sm text-white/90 leading-relaxed">
          Demorou mais chegou, líderes de departamento agora podem gerar relatórios em PDF dos tickets, com filtros por departamento, tipo de solicitação, datas e integrantes.
        </p>
      </div>
    </div>

    <div
      class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white rounded-2xl shadow-lg p-6 flex items-start gap-4 hover:scale-[1.02] transition-transform duration-300">
      <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-white/20 backdrop-blur-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>
      </div>
      <div>
        <h3 class="text-lg font-semibold mb-1">Personalização de Notificações</h3>
        <p class="text-sm text-white/90 leading-relaxed">
          É possível configurar notificações por e-mail e pop-up para o responsável pela abertura do ticket. Clique em
          Meu Usuário > Notificações.
        </p>
      </div>
    </div>

    <div
      class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-2xl shadow-lg p-6 flex items-start gap-4 hover:scale-[1.02] transition-transform duration-300">
      <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-white/20 backdrop-blur-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
        </svg>
      </div>
      <div>
        <h3 class="text-lg font-semibold mb-1">Integrantes de Departamentos</h3>
        <p class="text-sm text-white/90 leading-relaxed">
          Os responsáveis por responder tickets podem receber notificações pop-up de novos tickets, desde que tenham
          autorizado o navegador.
        </p>
      </div>
    </div>
  </div>


  <ModalComponent v-model="showModal" :idUser="idUserTemp" />

  <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-6">

    <div class="rounded-xl shadow-xl border-1 border-gray-200 p-3 mt-5">
      <p class="text-gray-500 text-[13pt] text-center">Total de Tickets por mês</p>
      <p class="text-gray-400 text-[10pt] text-center">Agrupado por meses no ano atual</p>
      <apexchart :options="chartOptions" :series="series" height="350" />
    </div>
  </div>

  <!--<div class="grid md:grid-cols-2 sm:grid-cols-1 gap-6" >
    
    <div class="rounded-xl shadow-xl border-1 border-gray-200 p-3 mt-5">
      <p class="text-gray-500 text-[13pt] text-center">Título do Gráfico</p>
      <apexchart :options="chartOptions2" :series="series2" height="350"/>
    </div>

    <div class="rounded-xl shadow-xl border-1 border-gray-200 p-3 mt-5">
      <p class="text-gray-500 text-[13pt] text-center">Título do Gráfico</p>
      <apexchart :options="chartOptions3" :series="series3" height="350"/>
    </div>
  </div>-->


</template>

<script>

import TitlePage from './Components/TitlePage.vue';
import { usePage } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import ButtonPrimary from "./Components/ButtonPrimary.vue"
import SelectGenericSearch from './Components/SelectGenericSearch.vue';
import TableDefault from './Components/TableDefault.vue';
import ModalComponent from './Components/ModalComponent.vue';
import axios from 'axios';

import VueApexCharts from 'vue3-apexcharts';


export default {
  name: "Home",
  data() {
    return {
      teste: "",
      idUserTemp: 0,
      mediaRecorder: null,
      audioChunks: [],
      audioUrl: null,
      showModal: false,
      isRecording: false,
      temp_table: Object,
      page: false,
      series: [{ name: "Total Aberto", data: [] }],
      chartOptions: {
        chart: { type: "bar", width: "auto" },
        xaxis: { categories: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"] }
      },
      series2: [10, 41, 35],
      chartOptions2: {
        labels: ['T1', 'T2', 'T3'],
        chart: { type: "donut" },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
      },
      series3: [{
        name: 'series1',
        data: [31, 40, 28, 51, 42, 109, 100]
      }, {
        name: 'series2',
        data: [11, 32, 45, 32, 34, 52, 41]
      }],
      chartOptions3: {
        chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: true
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'datetime',
          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
      },
    }
  },
  components: {
    TitlePage, ButtonPrimary, Head, SelectGenericSearch, TableDefault, apexchart: VueApexCharts, ModalComponent
  },
  async mounted() {

    const page = usePage();
    this.teste = page;
    this.idUserTemp = this.teste?.props?.auth?.user?.id;

    try {
      const response = await axios.get("/charts/count");
      this.series[0].data = response.data.quantidade;

      const searchResponse = await axios.get(`/val/pesquisa/${parseInt(this.idUserTemp)}`);

      console.log(searchResponse.data);

      this.showModal = searchResponse.data.data ? false : true;

    } catch (error) {
      console.log(error);
    }
  },
  methods: {
  },
  computed: {
  },
  watch: {

  }
}
</script>