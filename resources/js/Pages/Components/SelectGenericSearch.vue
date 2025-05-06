<template>

    <div class="relative" ref="dropdown">
        
        <div @click="teste()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            <div class="">
                <label>{{ textSelect }}</label>

                <svg v-if="show" class="w-6 h-6 text-gray-800 float-right" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                </svg>

                <svg v-else class="w-6 h-6 text-gray-800 float-right" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

            </div>

        </div>

        <div v-if="show" class="bg-white/30 backdrop-blur-lg p-2 rounded-2xl mt-2 shadow-lg absolute w-full ">

            <input type="text" v-model="eSearch" class="w-full mt-2 mb-3 rounded-3xl border-blue-600 border-2 bg-white/70" placeholder="Digite algo..." @keyup="al()">

            <p class="bg-blue-600 mb-3 rounded-2xl p-1 text-white text-center">{{ encontrados }}</p>

            <div class="overflow-x-auto h-70">
                <div v-for="(l, index) in copia">
                    <div class="bg-white/70 p-2 mb-2 border-gray-300 rounded-2xl">
                        <input type="checkbox" class="w-6 h-6 mr-2" v-model="select" :value="l[config.id]">
                        <label class="text-black">{{ l[config.name] }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    export default{
        name:"SelectGenericSearch",
        data(){
            return{
                show: false,
                select:[],
                copia: "",
                eSearch: ""
            }
        },
        props:{
            lista: Object,
            config: Object
        },
        mounted(){
            this.copia = this.lista

            document.addEventListener("click", this.handleClickOutside)
        },
        methods:{
            teste(){
                this.show = !this.show
            },
            al(){

                let t = []
               
                this.lista.forEach(element => {

                    if(element[this.config.name].toLowerCase().search(this.eSearch.toLowerCase()) >= 0){
                        t.push(element)
                    }
                });

                this.copia = t
                
            },
            handleClickOutside(event) {
                if (!this.$refs.dropdown.contains(event.target)) {
                    this.show = false;
                }
            }
        },
        emits: ['update:modelValue'],
        computed:{
            textSelect(){
                if(this.select.length){
                    return this.select.length + " selecionado(s)"
                }else{
                    return "Selecione"
                }
            },
            encontrados(){
                if(this.copia.length){
                    return this.copia.length + " listado(s)"
                }else{
                    return "Nada encontrado..."
                }
            }
        },
        watch:{
            select(){
                this.$emit('update:modelValue', this.select)
            }
        }
    }

</script>