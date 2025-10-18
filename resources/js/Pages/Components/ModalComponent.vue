<template>
    <transition name="modal-fade">
        <div v-if="modelValue" class="fixed inset-0 z-50 flex items-center justify-center p-8" aria-modal="true"
            role="dialog">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="onOverlayClick"></div>

            <!-- Modal panel -->
            <div :class="panelClasses"
                class="relative z-10 max-h-[90vh] overflow-auto rounded-2xl shadow-xl bg-white w-full max-w-3xl"
                @click.stop>

                <!-- Botão fechar -->
                <button type="button"
                    class="absolute top-4 right-4 rounded-full p-1 hover:bg-black/10 focus:outline-none" @click="cancelSearchForm"
                    aria-label="Fechar modal">
                    <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 8.586l4.95-4.95 1.414 1.414L11.414 10l4.95 4.95-1.414 1.414L10 11.414l-4.95 4.95L3.636 14.95 8.586 10 3.636 5.05 5.05 3.636 10 8.586z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Header com foto e texto -->
                <div class="bg-green-700 p-6 rounded-t-2xl shadow-b mb-4 flex flex-col md:flex-row items-center gap-6">
                    <div class="flex-shrink-0">
                        <img src="../../../img/paulo.jpeg" alt="Foto do instrutor"
                            class="rounded-full w-20 h-20 object-cover shadow-lg border-white border-2">
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white mb-2">Pesquisa de Campo - Workshop de Programação</h2>
                        <p class=" text-neutral-100">Analista de TI - Tecnológo em Redes e cursando Administração Pública</p>
                        <p class=" text-neutral-100">Desenvolvedor do SafeGard e TicketGard</p>
                    </div>

                </div>

                <!-- Corpo do modal (formulário) -->
                <div class="px-14 pt-6 pb-6">
                    <div id="workshopForm" class="space-y-4">


                        <div class="text-[12pt] text-justify" v-if="!showForm">
                            
                            <p>
                                E aí, Guardião! 👋 Quer dar uma espiadinha em como as aplicações funcionam e entender a lógica por trás dos códigos? Que tal aprender a montar uma "telinha" como essa?
                            </p>
                            <br>
                            <p>
                                Estou fazendo uma pesquisa rápida pra saber quem tá afim de aprender o básico de programação de sistemas. A ideia é desmistificar tudo e mostrar que qualquer pessoa consegue aprender de forma prática e divertida.
                            </p>
                            <br>
                            <p>
                                Vou te mostrar um método simples, online, com explicações diretas e espaço pra você testar suas próprias ideias. Programar pode ser mais fácil e até divertido do que você imagina!
                            </p>
                            <br>
                            <p>
                                Então, se você quiser participar, é só clicar em "Continuar" e preencher um breve formulário. Ah, e essa pesquisa aparece só uma vez, beleza? 😉
                            </p>


                            <div class="flex justify-end space-x-4 pt-4 border-t-1 border-t-neutral-300 mt-6">

                                <button
                                    class=" bg-red-500 hover:bg-red-600 text-white py-3 px-3 rounded-lg font-semibold transition-all "
                                    @click="cancelSearchForm">Cancelar</button>
                                <button
                                    class=" bg-green-500 hover:bg-green-600 text-white py-3 px-3 rounded-lg font-semibold transition-all animate-pulse hover:animate-none"
                                    @click="showForm = true">Continuar</button>

                            </div>
                        </div>

                        <div v-if="showForm" class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block font-medium text-slate-700 mb-1">Nome completo</label>
                                <input type="text" id="name" name="name" required v-model="dataForm.name"
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="email" class="block font-medium text-slate-700 mb-1">Whatsapp:</label>
                                <input type="email" id="email" name="email" required v-model="dataForm.whatsapp"
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="knowWorkshop" class="block font-medium text-slate-700 mb-1">Você já sabe o
                                    que é um workshop?</label>
                                <select id="knowWorkshop" name="knowWorkshop" required v-model="dataForm.question_1"
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="sim">Sim</option>
                                    <option value="nao">Não</option>
                                    <option value="talvez">Talvez</option>
                                </select>
                            </div>

                            <div>
                                <label for="participatedWorkshop" class="block font-medium text-slate-700 mb-1">Você já
                                    participou de algum workshop antes?</label>
                                <select id="participatedWorkshop" name="participatedWorkshop" required
                                    v-model="dataForm.question_2"
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="sim">Sim</option>
                                    <option value="nao">Não</option>
                                </select>
                            </div>

                            <div>
                                <label for="interestProgramming" class="block font-medium text-slate-700 mb-1">Você tem
                                    interesse em aprender programação?</label>
                                <select id="interestProgramming" name="interestProgramming" required
                                    v-model="dataForm.question_3"
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="sim">Sim, quero aprender</option>
                                    <option value="talvez">Talvez, dependendo do conteúdo</option>
                                    <option value="nao">Não tenho interesse</option>
                                </select>
                            </div>

                            <div>
                                <label for="perceivedDifficulty" class="block font-medium text-slate-700 mb-1">Você acha
                                    que programação é muito complicada?</label>
                                <select id="perceivedDifficulty" name="perceivedDifficulty" required
                                    v-model="dataForm.question_4"
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="sim">Sim, parece muito difícil</option>
                                    <option value="um_pouco">Um pouco, mas quero tentar</option>
                                    <option value="nao">Não, quero aprender sem medo</option>
                                </select>
                            </div>


                            <div>
                                <label for="workshop1" class="block font-medium text-slate-700 mb-1">Você participaria
                                    do Workshop Gratuito?</label>
                                <select id="workshop1" name="workshop1" required v-model="dataForm.question_5"
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="sim">Sim</option>
                                    <option value="talvez">Talvez</option>
                                    <option value="nao">Não</option>
                                </select>
                            </div>

                            <div>
                                <label for="availability" class="block font-medium text-slate-700 mb-1">Qual horário
                                    você teria mais disponibilidade?</label>
                                <select id="availability" name="availability" required v-model="dataForm.question_6"
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="manha">Manhã</option>
                                    <option value="tarde">Tarde</option>
                                    <option value="noite">Noite</option>
                                    <option value="fimDeSemana">Fim de semana</option>
                                </select>
                            </div>




                            <div class="col-span-2 flex justify-end">

                                <button
                                    class="w-42 bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-semibold transition-all "
                                    @click="sendForm">Enviar!</button>

                            </div>

                            <div class="text-center col-span-2 text-neutral-400">

                                <p>Pesquisa de campo autorizada pelo líder do departamento.</p>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </transition>
</template>

<script>

import axios from 'axios';
import Swal from 'sweetalert2';
import { usePage } from '@inertiajs/vue3';

export default {
    props: {
        modelValue: Boolean,
        panelClasses: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            showForm: false,
            dataForm: {
                name: "",
                whatsapp: "",
                question_1: "",
                question_2: "",
                question_3: "",
                question_4: "",
                question_5: "",
                question_6: "",
                id_user: 0
            },
            userSession: {}
        }
    },
    methods: {
        close() {
            this.$emit('update:modelValue', false)
        },
        onOverlayClick() {
            this.close()
        },
        async sendForm() {

            try {
                const response = await axios.post("/cad/pesquisa", this.dataForm);

                if (response.status === 201) {
                    Swal.fire("Sucesso!", response.data.message, "success");
                }

            } catch (error) {
                Swal.fire("Atenção!", error.message, "error");
                console.log(`Erro na requisição: ${error}`);
            } finally {
                this.close();
            }

        },
        async cancelSearchForm() {
            try {
                const response = await axios.post("/cad/pesquisa", {
                    ...this.dataForm,
                    name: "---",
                    whatsapp: "---",
                    question_1: "---",
                    question_2: "---",
                    question_3: "---",
                    question_4: "---",
                    question_5: "---",
                    question_6: "---"
                });

                if (response.status === 201) {
                    Swal.fire("Sucesso!", "Obrigado por contribuir com a pesquisa!", "success");
                }

            } catch (error) {
                Swal.fire("Atenção!", error.message, "error");
                console.log(`Erro na requisição: ${error}`);
            } finally {
                this.close();
            }
        },

    },
    mounted() {
        this.userSession = usePage();
        this.dataForm.id_user = this.userSession?.props?.auth?.user?.id
        this.dataForm.name = this.userSession?.props?.auth?.user?.name
    }
}
</script>
