<template>

    <div class="relative" ref="dropdown">
        <div ref="tes" @click="teste()" @blur="show=false" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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

        <transition name="fade">
            <div v-if="show" class="bg-white/30 backdrop-blur-lg p-2 h-40 overflow-x-auto rounded-2xl mt-2 shadow-lg absolute w-full">
                <div v-for="(l, index) in lista">

                    <div class="bg-white/70 p-2 mb-2 rounded-sm border-gray-300">
                        <input type="checkbox" class="w-5 h-5 mr-2" v-model="select" :value="l.id_departamentos">
                        <label class="text-black">{{ l.nome_departamentos }}</label>
                    </div>
                </div>
            </div>
        </transition>
    </div>

</template>

<script>

    export default{
        name:"Select",
        data(){
            return{
                show: false,
                select:[]
            }
        },
        props:{
            lista: Object,
            modelValue:{
                type:Array,
                default:[]
            }
        },
        methods:{
            teste(){
                this.show = !this.show
                this.$refs.tes.focus()
            },
            handleClickOutside(event) {
                if (!this.$refs.dropdown.contains(event.target)) {
                    this.show = false;
                }
            }
        },
        mounted(){
            document.addEventListener("click", this.handleClickOutside)

            this.select = this.modelValue
        },
        beforeUnmount(){
            document.removeEventListener("click", this.handleClickOutside)
        },  
        emits: ['update:modelValue'],
        computed:{
            textSelect(){
                if(this.select.length){
                    return this.select.length + " selecionado(s)"
                }else{
                    return "Selecione"
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

<style>
    .fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s;
    }
    .fade-enter-from, .fade-leave-to {
    opacity: 0;
    }
</style>