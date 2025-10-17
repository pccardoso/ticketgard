<template>

  <Head>
    <title>Home - Ticket Gard</title>
  </Head>

  <TitlePage titulo="Home">Visão dos meus Tickets</TitlePage>

  <ModalComponent v-model="showModal" />

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
    const page = usePage()
    this.teste = page

    try {
      const response = await axios.get("/charts/count");
      this.series[0].data = response.data.quantidade;
      console.log(response);

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