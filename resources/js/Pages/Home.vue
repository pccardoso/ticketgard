<template>

  <Head>
    <title>Home - Ticket Gard</title>
  </Head>

  <TitlePage titulo="Home">Seja Bem-Vindo</TitlePage>


</template>

<script>

    import TitlePage from './Components/TitlePage.vue';
    import { usePage } from '@inertiajs/vue3';
    import {Head} from '@inertiajs/vue3';
    import ButtonPrimary from "./Components/ButtonPrimary.vue"
    import SelectGenericSearch from './Components/SelectGenericSearch.vue';
    import TableDefault from './Components/TableDefault.vue';

    export default{
        name:"Home",
        data(){
          return{
            temp_table:Object,
            page: false
          }
        },
        components:{
          TitlePage, ButtonPrimary, Head, SelectGenericSearch, TableDefault
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