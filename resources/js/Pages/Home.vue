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
            lista2:[
              { "id": 1, "nome": "Paulo Silva" },
              { "id": 2, "nome": "Ana Souza" },
              { "id": 3, "nome": "Carlos Oliveira" },
              { "id": 4, "nome": "Mariana Lima" },
              { "id": 5, "nome": "João Costa" },
              { "id": 6, "nome": "Fernanda Almeida" },
              { "id": 7, "nome": "Roberto Martins" },
              { "id": 8, "nome": "Patrícia Rocha" },
              { "id": 9, "nome": "Lucas Ribeiro" },
              { "id": 10, "nome": "Camila Fernandes" },
              { "id": 11, "nome": "Gustavo Gomes" },
              { "id": 12, "nome": "Juliana Pinto" },
              { "id": 13, "nome": "Ricardo Carvalho" },
              { "id": 14, "nome": "Larissa Duarte" },
              { "id": 15, "nome": "Bruno Melo" },
              { "id": 16, "nome": "Gabriela Freitas" },
              { "id": 17, "nome": "Felipe Barros" },
              { "id": 18, "nome": "Isabela Pires" },
              { "id": 19, "nome": "Mateus Teixeira" },
              { "id": 20, "nome": "Sofia Farias" },
              { "id": 21, "nome": "André Moreira" },
              { "id": 22, "nome": "Beatriz Dias" },
              { "id": 23, "nome": "Rafael Almeida" },
              { "id": 24, "nome": "Tatiane Monteiro" },
              { "id": 25, "nome": "Thiago Moraes" },
              { "id": 26, "nome": "Bruna Castro" },
              { "id": 27, "nome": "Murilo Antunes" },
              { "id": 28, "nome": "Débora Santos" },
              { "id": 29, "nome": "Vinícius Souza" },
              { "id": 30, "nome": "Natália Correia" },
              { "id": 31, "nome": "Leonardo Batista" },
              { "id": 32, "nome": "Letícia Lopes" },
              { "id": 33, "nome": "Eduardo Cavalcanti" },
              { "id": 34, "nome": "Aline Macedo" },
              { "id": 35, "nome": "Danilo Andrade" },
              { "id": 36, "nome": "Tatiana Silveira" },
              { "id": 37, "nome": "Fábio Nogueira" },
              { "id": 38, "nome": "Amanda Ribeiro" },
              { "id": 39, "nome": "Henrique Lima" },
              { "id": 40, "nome": "Carla Castro" },
              { "id": 41, "nome": "Marcelo Barbosa" },
              { "id": 42, "nome": "Bianca Costa" },
              { "id": 43, "nome": "Antônio Rocha" },
              { "id": 44, "nome": "Marina Almeida" },
              { "id": 45, "nome": "Renan Martins" },
              { "id": 46, "nome": "Nicole Silva" },
              { "id": 47, "nome": "Alessandro Souza" },
              { "id": 48, "nome": "Talita Rocha" },
              { "id": 49, "nome": "Jonathan Freitas" },
              { "id": 50, "nome": "Helena Carvalho" },
              { "id": 51, "nome": "Pablo Barros" },
              { "id": 52, "nome": "Priscila Duarte" },
              { "id": 53, "nome": "Sérgio Mendes" },
              { "id": 54, "nome": "Kelly Pires" },
              { "id": 55, "nome": "Alex Teixeira" },
              { "id": 56, "nome": "Lívia Farias" },
              { "id": 57, "nome": "Diego Moreira" },
              { "id": 58, "nome": "Rafaela Dias" },
              { "id": 59, "nome": "Bruno Almeida" },
              { "id": 60, "nome": "Thais Monteiro" },
              { "id": 61, "nome": "Daniel Moraes" },
              { "id": 62, "nome": "Viviane Castro" },
              { "id": 63, "nome": "Caio Antunes" },
              { "id": 64, "nome": "Letícia Santos" },
              { "id": 65, "nome": "Murilo Souza" },
              { "id": 66, "nome": "Vanessa Correia" },
              { "id": 67, "nome": "Anderson Batista" },
              { "id": 68, "nome": "Camila Lopes" },
              { "id": 69, "nome": "Vinícius Cavalcanti" },
              { "id": 70, "nome": "Simone Macedo" },
              { "id": 71, "nome": "Adriano Andrade" },
              { "id": 72, "nome": "Carolina Silveira" },
              { "id": 73, "nome": "Rogério Nogueira" },
              { "id": 74, "nome": "Marina Ribeiro" },
              { "id": 75, "nome": "César Lima" },
              { "id": 76, "nome": "Tatiane Castro" },
              { "id": 77, "nome": "Rodrigo Barbosa" },
              { "id": 78, "nome": "Daniele Costa" },
              { "id": 79, "nome": "Márcio Rocha" },
              { "id": 80, "nome": "Paula Almeida" },
              { "id": 81, "nome": "André Martins" },
              { "id": 82, "nome": "Isabela Silva" },
              { "id": 83, "nome": "Renato Souza" },
              { "id": 84, "nome": "Bruna Rocha" },
              { "id": 85, "nome": "Pedro Freitas" },
              { "id": 86, "nome": "Érica Carvalho" },
              { "id": 87, "nome": "Eduardo Barros" },
              { "id": 88, "nome": "Nathalia Duarte" },
              { "id": 89, "nome": "Lucas Mendes" },
              { "id": 90, "nome": "Bianca Pires" },
              { "id": 91, "nome": "Thiago Teixeira" },
              { "id": 92, "nome": "Vanessa Farias" },
              { "id": 93, "nome": "Fernando Moreira" },
              { "id": 94, "nome": "Aline Dias" },
              { "id": 95, "nome": "Paulo Almeida" },
              { "id": 96, "nome": "Claudia Monteiro" },
              { "id": 97, "nome": "Victor Moraes" },
              { "id": 98, "nome": "Juliana Castro" },
              { "id": 99, "nome": "Gabriel Antunes" },
              { "id": 100, "nome": "Patrícia Santos" }
            ],
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