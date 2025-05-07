<template>

  <Head>
    <title>Home - Ticket Gard</title>
  </Head>

  <TitlePage titulo="Home">Seja Bem-Vindo</TitlePage>

  <apexchart
      width="500"
      type="line"
      :options="chartOptions"
      :series="series"
    ></apexchart>


</template>

<script>

    import TitlePage from './Components/TitlePage.vue';
    import { usePage } from '@inertiajs/vue3';
    import {Head} from '@inertiajs/vue3';
    import ButtonPrimary from "./Components/ButtonPrimary.vue"
    import SelectGenericSearch from './Components/SelectGenericSearch.vue';
    import TableDefault from './Components/TableDefault.vue';

    import ApexCharts from 'apexcharts';

    export default{
        name:"Home",
        data(){
          return{
            temp_table:Object,
            page: false,

            series: [
        {
          name: 'Vendas',
          data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
        },
      ],
      chartOptions: {
        chart: {
          id: 'vuechart-example',
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        },
      }
          }
        },
        components:{
          TitlePage, ButtonPrimary, Head, SelectGenericSearch, TableDefault,  apexchart: ApexCharts,
        },
        mounted(){
            const page = usePage()
            this.teste = page
        },
        methods:{
        },
        computed:{
        },
        watch:{

        }
    }
</script>