<template>
    <p class="">Página Inicial</p>
    <button @click="abrirModal()">Abrir</button>
    <button-primary-vue @click="abrirModal()">Abrir Modal</button-primary-vue>

    <div id="modalEl" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative max-h-full w-full max-w-2xl">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow-sm">
                <!-- Modal header -->
                <div
                    class="flex items-start justify-between rounded-t border-b p-5"
                >
                    <h3
                        class="text-xl font-semibold text-gray-900 lg:text-2xl" >
                        Terms of Service
                    </h3>
                    <button
                        @click="fecharModal()" type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                    >
                        <svg
                            class="h-3 w-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                            />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="space-y-6 p-6">
                    <p
                        class="text-base leading-relaxed text-gray-500"
                    >
                        With less than a month to go before the European Union
                        enacts new consumer privacy laws for its citizens, companies
                        around the world are updating their terms of service
                        agreements to comply.
                    </p>
                    <p
                        class="text-base leading-relaxed text-gray-500"
                    >
                        The European Union’s General Data Protection Regulation
                        (G.D.P.R.) goes into effect on May 25 and is meant to ensure
                        a common set of data rights in the European Union. It
                        requires organizations to notify users as soon as possible
                        of high-risk data breaches that could personally affect
                        them.
                    </p>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-2 rtl:space-x-reverse rounded-b border-t border-gray-200 p-6"
                >
                    <button
                        type="button"
                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
                    >
                        I accept
                    </button>
                    <button
                        type="button"
                        class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-300"
                    >
                        Decline
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import ButtonPrimaryVue from '../Components/ButtonPrimary.vue';
    import { Modal } from 'flowbite';

    export default{
        components:{
            ButtonPrimaryVue
        },
        name:"Home",
        data(){
            return{
                varModal:Modal
            }
        },
        mounted(){

            const $targetEl = document.getElementById('modalEl');
            const options = {
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 fixed inset-0 z-40',
                closable: false
            };
            const instanceOptions = {
            id: 'modalEl',
            override: true
            };

            this.varModal = new Modal($targetEl, options, instanceOptions);
        },
        methods:{
            abrirModal(){
                this.varModal.show();
            },
            fecharModal(){
                this.varModal.hide();
            }
        }
    }

</script>