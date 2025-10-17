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
                    class="absolute top-4 right-4 rounded-full p-1 hover:bg-black/10 focus:outline-none" @click="close"
                    aria-label="Fechar modal">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 8.586l4.95-4.95 1.414 1.414L11.414 10l4.95 4.95-1.414 1.414L10 11.414l-4.95 4.95L3.636 14.95 8.586 10 3.636 5.05 5.05 3.636 10 8.586z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Header com foto e texto -->
                <div class="bg-blue-700 p-6 rounded-t-2xl shadow-b mb-4 flex flex-col md:flex-row items-center gap-6">
                    <div class="flex-shrink-0">
                        <img src="https://s2-oglobo.glbimg.com/uMVci1cIhR-98RN8rnVeJgXiHMc=/0x0:4530x2892/888x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_da025474c0c44edd99332dddb09cabe8/internal_photos/bs/2025/n/a/ygvHt7ScWiEVmjoXNZ7w/99923500-files-in-this-file-photo-taken-on-april-03-2022-us-singer-songwriter-lady-gaga-arrives.jpg"
                            alt="Foto do instrutor" class="rounded-full w-30 h-30 object-cover shadow-lg">
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white mb-2">Pesquisa de Campo - Workshop de Desenvolvimento</h2>
                        <p class=" text-neutral-100">Desenvolvido por Paulo Cesar - Tecnologia</p>
                    </div>
                </div>

                <!-- Corpo do modal (formulário) -->
                <div class="px-14 pt-6 pb-6">
                    <div id="workshopForm" class="space-y-4">

                        <h2 class="text-xl font-bold mb-2">Workshop de Linguagem de Programação - Desmetificando esse mercado!</h2>

                        <div class="text-[12pt] text-justify" v-if="!showForm">
                            <p>
                                Fala, Guardião! 👋 Quer dar uma espiada em como funcionam as aplicações, entender a lógica por trás dos códigos? Já adianto que não é nenhum bicho de sete cabeças 😎.
                                
                            </p>
                            <br>
                            <p>
                                Estou fazendo uma pesquisa rápida pra saber quem tá afim de aprender o básico de programação de sistemas. A ideia é desmistificar tudo e mostrar que qualquer pessoa consegue aprender de forma prática e divertida.
                            </p>
                            <br>
                            <p>
                                Meu método é flexível: explicações simples, on-line e muita liberdade pra testar suas próprias ideias. Você vai ver que programar pode ser acessível e até divertido!
                            </p>
                            <br>
                            <p>Portanto, se tiver interesse em participar basta se cadastrar no formulário abaixo!!!</p>

                            <div class="flex justify-center space-x-4 pt-4">

                                <button class="w-32 bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg font-semibold transition-all " >Não, obrigado!</button>
                                <button class="w-42 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition-all " @click="showForm = true">Sim, quero participar!</button>

                            </div>
                        </div>

                        <div v-if="showForm" class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block font-medium text-slate-700 mb-1">Nome completo</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="email" class="block font-medium text-slate-700 mb-1">Whatsapp:</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="knowWorkshop" class="block font-medium text-slate-700 mb-1">Você já sabe o
                                    que é um workshop?</label>
                                <select id="knowWorkshop" name="knowWorkshop" required
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="sim">Sim</option>
                                    <option value="nao">Não tenho certeza</option>
                                </select>
                            </div>

                            <div>
                                <label for="participatedWorkshop" class="block font-medium text-slate-700 mb-1">Você já
                                    participou de algum workshop antes?</label>
                                <select id="participatedWorkshop" name="participatedWorkshop" required
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
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="sim">Sim, quero aprender mais</option>
                                    <option value="talvez">Talvez, dependendo do conteúdo</option>
                                    <option value="nao">Não tenho interesse</option>
                                </select>
                            </div>

                            <div>
                                <label for="perceivedDifficulty" class="block font-medium text-slate-700 mb-1">Você acha
                                    que programação é muito complicada?</label>
                                <select id="perceivedDifficulty" name="perceivedDifficulty" required
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="sim">Sim, parece muito difícil</option>
                                    <option value="umPouco">Um pouco, mas quero tentar</option>
                                    <option value="nao">Não, quero aprender sem medo</option>
                                </select>
                            </div>


                            <div>
                                <label for="workshop1" class="block font-medium text-slate-700 mb-1">Você participaria
                                    do Workshop Gratuito?</label>
                                <select id="workshop1" name="workshop1" required
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
                                <select id="availability" name="availability" required
                                    class="w-full p-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    <option value="manha">Manhã</option>
                                    <option value="tarde">Tarde</option>
                                    <option value="noite">Noite</option>
                                    <option value="fimDeSemana">Fim de semana</option>
                                </select>
                            </div>

                           


                            <div class="col-span-2 flex justify-end">

                                <button class="w-42 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition-all " @click="showForm = false">Enviar!</button>

                            </div>

                            <div class="text-center col-span-2 text-neutral-400">

                                <p>Pesquisa de campo autorizada pelo líder do departamento.</p>
                                <p>Desenvolvido por Paulo Cesar - Tecnologia</p>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        modelValue: Boolean,
        panelClasses: {
            type: String,
            default: ''
        }
    },
    data(){
        return{
            showForm: false
        }
    },
    methods: {
        close() {
            this.$emit('update:modelValue', false)
        },
        onOverlayClick() {
            this.close()
        }
    }
}
</script>
