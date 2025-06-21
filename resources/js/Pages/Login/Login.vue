<template>

    <Head>
        <title>Login - Ticket Gard</title>
        <link rel="icon" type="image/svg+xml" href="../../../img/icon.svg" />
    </Head>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">

            <div class="">
                <div class="mt-20 w-full p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8  ">
                    <form class="space-y-6" action="#" @submit.prevent="login()">

                        <div class="flex items-center justify-center mt-6">
                            <img src="../../../img/logo-azul.png" class="w-70" alt="Imagem Centralizada">
                        </div>

                        <h5 class="text-xl text-gray-900  text-center">Autenticação</h5>

                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">E-mail:</label>
                            <input type="text" v-model="form.email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="exemple@exemple.com" />
                            <label class="text-red-500 font-bold mb-5" v-if="form.errors.email">{{ form.errors.email }}</label>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Senha</label>
                            <input type="password" v-model="form.password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                            <label class="text-red-500 font-bold mb-5" v-if="form.errors.password">{{ form.errors.password }}</label>
                        </div>

                        <div for="tempalert" class="text-red-500 font-bold mb-5" v-if="form.errors.credencial">{{ form.errors.credencial }}</div>

                        <ButtonPrimary type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   dark:focus:ring-blue-800">Entrar</ButtonPrimary>
                    
                        <p class="text-gray-400 text-center m-1">v.2.1.0</p>
                    </form>
                </div>
            </div>
    </div>

</template>

<script>
    import { useForm } from '@inertiajs/vue3';
    import LayoutLogin from '../Components/LayoutLogin.vue';
    import ButtonPrimary from '../Components/ButtonPrimary.vue';
    import { usePage } from '@inertiajs/vue3';
    import { Head } from '@inertiajs/vue3';

    export default{
        name:"Login",
        components:{
            ButtonPrimary, Head
        },  
        data(){
            return{
                form: useForm({
                    email:"",
                    password:""
                }),
                usuario: useForm({
                    name:"Paulo Cesar Costa Cardoso",
                    email:"paulo@gmail.com",
                    password:"paulo"
                }),
                infor:Object
            }
        },
        methods:{
            login(){

                const audio = new Audio('/audio/audio2.mp3');
                audio.play();
                
                this.form.post("/validar/login", {
                    onSuccess:(result)=>{
                        console.log(result)
                    },
                    onError:(erro)=>{
                        console.log(erro);
                    }
                })

            },
            cadastrar(){
                this.usuario.post("/cad/usuario", {
                    preserveScroll:false,
                    onSuccess:(result)=>{
                        console.log(result)
                    },
                    onError:(erro)=>{
                        console.log(erro)
                    }
                })
            }
        },
        mounted(){
            const pag= usePage();
            this.infor = pag;
        },
        layout:LayoutLogin
    }

</script>