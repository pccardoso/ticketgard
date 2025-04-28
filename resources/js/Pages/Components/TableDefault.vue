<template>

  <div v-if="this.paginador" class="mt-3">
    <button class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm" @click="pagin(1)" >Início</button>
    <button class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm" @click="anterior()" ><</button>
    <button v-for="(pag, index) in paginador" class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm w-12" @click="pagin(pag)" :class="select_temp == pag ? 'bg-blue-700' : ''">{{ pag }}</button>
    <button class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm" @click="proximo()">></button>
    <button class="bg-blue-400 text-white mr-1 mt-2 pt-2 pb-2 pl-3 pr-3 rounded-sm" @click="pagin(lista.length)">Fim</button>
  </div>

</template>

<script>

    export default{
        name:"TableDefault",
        data(){
          return{
            lista:[],
            paginaAtual: 1,
            itensPagina: 7,
            paginador: false,
            //temp_table: [],
            select_temp: 0,
            temp_paginator: []
          }
        },
        emits:['update:modelValue'],
        props:{
            list:Object
        },
        mounted(){

            this.lista = this.list

            this.fatorar()

        },
        methods:{

          fatorar(){
            
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

            //define a visualização inicial para o primeiro grupo formado
            //this.temp_table = 
            
            this.atualizarModel(this.lista[0])
            
            this.select_temp = 1;

          },
          atualizarModel(tem){
            this.$emit('update:modelValue', tem)
          },
          
          //altera a visualização da tabela para o subgrupo desejado
          pagin(temp){
            
            //this.temp_table = this.lista[temp-1]
            this.atualizarModel(this.lista[temp-1])

            this.select_temp = temp

            console.log(this.lista[temp-1])

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
          },
          aler(msg){
            alert(msg)
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
              
            }else{
              console.log("não")
            }

          }
        }
    }
</script>