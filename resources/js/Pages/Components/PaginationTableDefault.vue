<template>
  
  <div>

    <div class="mt-3">

      <label for="forTotalEncontrado">Total encontrado: {{ list.length }} registro(s).</label>

    </div>

    <div v-if="this.paginador" class="">
      <button title="Ir ao início" class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm shadow-sm" @click="pagin(1)" >Início</button>
      <button title="Avançar" class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm shadow-sm" @click="anterior()" ><</button>
      <button v-for="(pag, index) in paginador" class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm w-12 shadow-sm" @click="pagin(pag)" :class="select_temp == pag ? 'bg-blue-700' : ''">{{ pag }}</button>
      <button title="Voltar" class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm shadow-sm" @click="proximo()">></button>
      <button title="Ir ao Fim" class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm shadow-sm" @click="pagin(lista.length)">Fim</button>
    </div>
  </div>

</template>

<script>

    export default{
        name:"PaginationTableDefault",
        data(){
          return{
            lista:[],
            paginaAtual: 1,
            itensPagina: 10,
            paginador: false,
            //temp_table: [],
            select_temp: 0,
            temp_paginator: []
          }
        },
        emits:['update:modelValue'],
        props:{
            list:{
                type:Array
            }
        },
        mounted(){
            this.fatorar()
        },
        methods:{

          fatorar(){

            this.lista = this.list

            //quantidade de agrupamentos
            let pagin = Math.ceil(this.lista.length / this.itensPagina)

            this.paginador = pagin

            //contador
            let count_temp = 0

            //armazena um array agrupado por paginador
            let temp = []

            //percorre a quantidade de paginadores
            for (let index = 0; index < pagin; index++) {

              //armazena a contagem atual do objeto
              let a = count_temp
              
              //array de subgrupos
              let b = []

              //percorre o objeto principal com intuito de formar os subgrupos
              for (let index2 = count_temp; index2 < (a + (this.itensPagina)); index2++) {

                //atualiza a contagem geral
                count_temp++

                //adiciona o item do objeto pricipal ao array de subgrupos
                b.push(this.lista[count_temp - 1])
                
              }

              //finalizando, adiciona o subgrupo no array principal o novo indice formado vira um paginador
              temp.push(b)

            }

            //armazena em lista o novo array agrupado
            this.lista = temp

            console.log(this.lista)

            //define a visualização inicial para o primeiro grupo formado
            //this.temp_table = 
            
            this.atualizarModel(this.lista[0])
            
            this.select_temp = 1;

          },
          atualizarModel(tem){
            if (tem) {
              this.$emit('update:modelValue', tem)
            }
          },
          
          //altera a visualização da tabela para o subgrupo desejado
          pagin(temp){
            
            //this.temp_table = this.lista[temp-1]
            this.atualizarModel(this.lista[temp-1])

            this.select_temp = temp

          },
          proximo(){
            
            if(this.select_temp + 1 <= this.lista.length){

              this.select_temp++;
              //this.temp_table = 
              this.atualizarModel(this.lista[this.select_temp - 1])

            }

          },
          anterior(){
            if(this.select_temp - 1 > 0){
              this.select_temp--;
              //this.temp_table = this.lista[this.select_temp - 1]

              this.atualizarModel(this.lista[this.select_temp - 1])
            }
          }
        },
        computed:{
          status(){
            return "Total: " + this.lista.length
          }
        },
        watch:{
          select_temp(){
            
            if(this.lista.length > 10){
              
              let tem  = this.select_temp
              let temp_pag = []

              for (let index = this.select_temp; index < tem + 10; index++) {

                if(this.lista[index-1]){
                  temp_pag.push(index);
                }

              }
              this.paginador = temp_pag
              
            }

          },
          list(){
            this.fatorar()
          }
        }
    }
</script>