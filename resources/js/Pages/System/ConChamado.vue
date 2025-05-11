<template>

    <Head>
        <title>Atendimentos - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Atendimentos">Tickets do meu Departamento</TitlePage>

    <div class=" p-4 rounded-2xl mb-4 shadow-lg border-1 border-gray-200">

        <div class="grid gap-6 mb-2 md:grid-cols-5" @keyup.enter="pesquisar()">

            <div>
                <label>Buscar por Código:</label>
                <input id="eCodPes" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            
            <div>
                <label class="inline-flex">Buscar por assunto/descrição:
                    <span title="A busca acontecerá por assunto ou descrição que contenham a palavra inserida.">
                    <svg  class="ml-1 w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/>
                    </svg>
                    </span>
                </label>

                <input id="eAssPes" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <div>
                <label>Data Inicial:</label>

                <VueDatePicker v-model="dataInicial" @change="pesquisar()" :format="'dd/MM/yyyy'"></VueDatePicker>
                
            </div>

            <div>
                <label>Data Final:</label>
                <VueDatePicker v-model="dataFinal" @change="pesquisar()" :format="'dd/MM/yyyy'"></VueDatePicker>
            </div>


            <div class="relative z-40">
                <label>Departamentos:</label>
                <Select :lista="lisDepartamento" v-model="getStoreFilter.listDepChe"></Select>

            </div>
        
            <div class="relative z-30">
                <label>Situação:</label>
                <SelectGeneric :lista="listaSituacao" v-model="getStoreFilter.listSitChe"></SelectGeneric>
            </div>

            <div class="relative z-20">
                <label>Prioridade:</label>
                <SelectGeneric :lista="listaPrioridade" v-model="getStoreFilter.listPriChe"></SelectGeneric>
            </div>

            <div class="relative z-10">
                <label>Responsável por Atendimento:</label>
                <SelectGenericSearch :lista="listUsuario" v-model="getStoreFilter.listUseChe" :config="configSelUsu"></SelectGenericSearch>
            </div>

            <div class="relative z-10">
                <label>Responsável por Abertura:</label>
                <SelectGenericSearch :lista="listUsuario" v-model="getStoreFilter.listUseAbe" :config="configSelUsu"></SelectGenericSearch>
            </div>
            
        </div>

        <ButtonPrimary @click="pesquisar()" class="inline-flex">
            
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M5.05 3C3.291 3 2.352 5.024 3.51 6.317l5.422 6.059v4.874c0 .472.227.917.613 1.2l3.069 2.25c1.01.742 2.454.036 2.454-1.2v-7.124l5.422-6.059C21.647 5.024 20.708 3 18.95 3H5.05Z"/>
            </svg>
            Filtrar

        </ButtonPrimary>
        
    </div>
    
    <div class=" overflow-x-auto shadow-md sm:rounded-lg">
        <Table class="text-sm" id="teste">
            <thead>
                <tr>
                    <ThTable>Cód</ThTable>
                    <ThTable>Assunto</ThTable>
                    <ThTable>Solicitação</ThTable>
                    <ThTable>Departamento</ThTable>
                    <ThTable>Abertura</ThTable>
                    <ThTable>Prioridade</ThTable>
                    <ThTable>Situação</ThTable>
                    <ThTable>Responsável</ThTable>
                    <ThTable>Abertura</ThTable>
                    <ThTable>Fechamento</ThTable>
                    <ThTable>Horas</ThTable>
                    <ThTable>Ações</ThTable>
                </tr>
            </thead>
            <tbody class="bg-gray-100 rounded-lg text-center h-6 overflow-x-scroll">

                <template v-if="arrayTempChamados.length">

                    <tr v-for="(l, index) in arrayTempChamados" :key="index" class="border-b-1 border-b-gray-300" >
                        <template v-if="l">
                            <td class="p-2">{{ l.id_chamados }}</td>
                            <td :title="l.assunto_chamados">{{ l.assunto_chamados.substring(0, 25) }}</td>
                            <td>{{ l.titulo_solicitacoes}}</td>
                            <td>{{ l.nome_departamentos }}</td>
                            <td class="">
                                <label class="inline-flex">
                                    <img v-if="l.vip_criador_chamados" src="../../../img/vip.png.png" class="w-5 mr-1">
                                    {{l.nome_criador_chamados }}
                                </label>
                            </td>
                            <td>
                                <IconPrioridade :valor_prioridade="parseInt(l.prioridade_solicitacoes)"/>
                            </td>
                            <td>
                                <IconSituacao :valor_situacao="parseInt(l.status_chamados)"/>
                            </td>
                            <td>
                                <label v-if="l.id_user_chamados">{{ l.id_user_chamados == user.id ? l.name + " (eu)" : l.name }}</label>
                                <label v-else>Aguardando</label>
                            </td>
                            <td>
                                <label>{{ textDatPt(l.data_cadastro_chamados) }}</label>
                            </td>

                            <td>
                                <label v-if="l.data_finalizar_chamados">{{ textDatPt(l.data_finalizar_chamados) }}</label>
                                <label v-else class="inline-flex" title="Atendimento ainda não finalizado!">
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                    </svg>
                                </label>
                            </td>

                            <td>

                                <template v-if="l.status_chamados < 4">
                                    <label :title="'TMA: ' + l.tempo_solicitacoes + ' hora(s).'" :class="calcularDias(l.data_cadastro_chamados, l.tempo_solicitacoes)[0] ? 'text-red-500' : ''">{{ calcularDias(l.data_cadastro_chamados, l.tempo_solicitacoes)[1] }}</label>
                                </template>
                                
                            </td>

                            <td class="flex justify-start gap-x-2">

                                <!-- Permitido visualizar detalhes a todos os usuários -->
                                <button class="p-1" @click="abrirModal(l.id_chamados, 1)" title="Visualizar detalhes">
                                    <svg class="w-6 h-6 text-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>

                                <!-- Permitido transferências a todos os usuários -->
                                <button v-show="l.status_chamados < 4" class="p-1" @click="abrirModal(l.id_chamados, 2)" title="Encaminhar o atendimento">
                                    <svg class="w-6 h-6 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M5 4a2 2 0 0 0-2 2v1h10.968l-1.9-2.28A2 2 0 0 0 10.532 4H5ZM3 19V9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm11.707-7.707a1 1 0 0 0-1.414 1.414l.293.293H8a1 1 0 1 0 0 2h5.586l-.293.293a1 1 0 0 0 1.414 1.414l2-2a1 1 0 0 0 0-1.414l-2-2Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>

                                <!-- Permitido aderir apenas os chamados que estejam em aberto -->
                                <button v-show="l.status_chamados == 0" class="p-1" @click="assumirChamado(l.id_chamados)" title="Aderir o atendimento">
                                    <svg class="w-6 h-6 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>

                                <!-- Permitido visualizar os pendências apenas no estado de interrompido -->
                                <button v-show="l.status_chamados == 3" class="p-1" @click="viewLastInterruption(l.id_chamados)" title="Visualizar todas as pendências.">
                                    <svg class="w-6 h-6 text-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm.5 5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Zm0 5c.47 0 .917-.092 1.326-.26l1.967 1.967a1 1 0 0 0 1.414-1.414l-1.817-1.818A3.5 3.5 0 1 0 11.5 17Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>

                                <!-- Permitido apenas aos líderes e ao usuário responsável pelo ticket -->
                                <Link v-if="l.id_user_chamados == user.id || user.type == 2" class="inline-flex p-1 " :href="'/history/' + l.id_chamados" title="Abrir atendimento">
                                    <svg class="w-6 h-6 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z" clip-rule="evenodd"/>
                                    </svg>
                                </Link>
                            </td>
                        </template>

                    </tr>
                </template>

                <template v-else-if="!lista_temp">
                    <tr>
                        <td colspan="12" class="animate-pulse">
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                            <div class="m-4 p-2 bg-gray-500 rounded-3xl"></div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </Table>
    </div>

    <PaginationTableDefault v-if="lista_temp" :list="lista_temp" v-model="arrayTempChamados"/>

    <!-- MODAL MULTIFUNCIONAL -->

    <div  id="modalEl" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative max-h-full w-full max-w-2xl">
            <!-- Modal content -->
            <div class="relative bg-white shadow-sm">
                <!-- Modal header -->
                <div
                    
                    class="flex items-start justify-between border-b-1 border-blue-300 bg-blue-600 text-white pt-3 pb-3 pl-5 pr-5"
                >
                    <h3 v-show="typeModal == 0" class="text-xl text-white lg:text-2xl" >Editar Infomações</h3>
                    <h3 v-show="typeModal == 1" class="text-xl text-white lg:text-2xl" >Visualizar Informações</h3>
                    <h3 v-show="typeModal == 2" class="text-xl text-white lg:text-2xl" >Encaminhar Chamado</h3>
                    <button
                        @click="fecharModal()" type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-white hover:bg-gray-200 hover:text-gray-900"
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
                    
                    <loading v-show="!formTemp.id_chamados"></loading>

                    <div v-show="formTemp.id_chamados && this.typeModal == 0">

                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Assunto do chamado:</label>
                            <input v-model="formTemp.assunto_chamados" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                        </div>

                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Descrição do chamado:</label>
                            <input v-model="formTemp.descricao_chamados" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                        </div>

                    </div>

                    <div v-show="formTemp.id_chamados && this.typeModal == 1">
                        <label><span class="font-bold">Assunto:</span> {{ this.formTemp.assunto_chamados }}</label> <br>
                        <label><span class="font-bold">Descricao:</span><span v-html="this.formTemp.descricao_chamados"></span></label>
                    </div> 

                    <div v-show="formTemp.id_chamados && this.typeModal == 2">

                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-900">Selecione o Departamento:</label>

                            <select v-model="formTemp.id_departamento_chamados" @change="listaSelectUsu()" name="" id="sSelDep" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                <option value="0">- selecione um departamento -</option>

                                <template v-for="(l, index) in lisDepartamento" :key="index">

                                    <option :value="l.id_departamentos">{{ l.nome_departamentos }}</option>

                                </template>

                            </select>

                        </div>

                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Definir o Usuário:</label>
                            <select v-model="formTemp.id_user_chamados" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="sSelUsu">
                                <option value="0">- selecionar o usuário -</option>

                                <template v-for="(l, index) in this.listUsuario" :key="index">
                                    <option v-if="l.res_chamados==1" :value="l.id_users">{{ l.name }}</option>
                                </template>
                                
                            </select>
                        </div>

                        <div>

                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Observações para transferência:</label>
                        
                            <textarea id="eObsTra" class="bg-gray-50 h-30 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>

                            <p class="mt-1 text-gray-400">As observações são visualizadas apenas por líderes/liderados relacionados diretamente ao ticket.</p>

                        </div>

                    </div>

                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-2 rtl:space-x-reverse rounded-b border-t border-gray-200 p-6"
                >
                    <button v-show="formTemp.id_chamados && this.typeModal==0"
                        @click="salvarAlteracao()"
                        type="button"
                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
                    >
                        Salvar
                    </button>

                    <button v-show="formTemp.id_chamados && this.typeModal==2"
                        @click="salvarEncaCha()"
                        type="button"
                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
                    >
                        Salvar
                    </button>

                    <button
                        @click="fecharModal()"
                        type="button"
                        class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-300"
                    >
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL VISUALIZAR PENDÊNCIA -->

    <div v-if="showModalInterruption" class="relative z-40" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-blue-600 px-4 py-3 sm:flex sm:px-6">
                        <label for="forTitle" class="text-[14pt] text-white">Visualizar Pendência</label>
                    </div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        
                        <loading v-if="!interruptList"></loading>

                        <div v-else>

                            <div for="forTeste" v-if="interruptList.length">

                                <label for="forDes" class="inline-flex mb-2 text-gray-700">

                                    <svg class="w-5 h-5 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/>
                                    </svg>

                                    Total de pendência(s): {{ interruptList.length }}

                                </label>

                                <div class="h-50 overflow-auto p-2">
                                    <div class="bg-red-400 rounded-sm p-2 mb-2 text-white hover:bg-red-500 animate duration-700" v-for="(l, index) in interruptList">

                                        <label for="forDesc" class="">
                                            <span class="font-bold">{{ textDatPt(l.data_cadastro_manifestacoes) }}: </span>
                                            {{ l.descricao_manifestacoes }}
                                        </label>

                                    </div>
                                </div>

                            </div>

                            <div v-else>
                                <div for="forVazioSemPendencia" class="inline-flex bg-yellow-300 w-full p-3 rounded-sm mb-2">
                                    <svg class="w-6 h-6 mr-2 text-gray-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    Não há pendências registradas...
                                </div>
                                <label for="forInfor" class="text-gray-400 text-sm">Pode haver informações de pendências no histórico do chat, nessa tela apenas será visualizada informações datadas a partir do dia 24/04/2025, conforme última atualização.</label>
                            </div>

                        </div>

                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="showModalInterruption=false">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import TitlePage from "../Components/TitlePage.vue";
    import IconLock from "../Icons/IconLock.vue";
    import Table from "../Components/Table.vue";
    import ThTable from "../Components/ThTable.vue";
    import { Modal } from "flowbite";
    import { useForm, usePage } from "@inertiajs/vue3";
    import Loading from "../Components/Loading.vue";
    import InputText from "../Components/InputText.vue";
    import axios from "axios";
    import Swal from "sweetalert2";
    import {Link} from "@inertiajs/vue3";
    import { router } from '@inertiajs/vue3';
    import IconPrioridade from "../Components/IconPrioridade.vue";
    import TextSituacao from "../Components/TextSituacao.vue";
    import ButtonPrimary from "../Components/ButtonPrimary.vue";
    import ButtonDanger from "../Components/ButtonDanger.vue";
    import VueDatePicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css';
    import {Head} from "@inertiajs/vue3";
    import {formatDateTexPtHelpers} from "../../../helpers/format.js"
    import {formatDateTextUsHelpers} from "../../../helpers/format.js"
    import {calcDifHouUtils} from "../../../helpers/utils.js"
    import Select from "../Components/Select.vue";
    import SelectGeneric from "../Components/SelectGeneric.vue";
    import SelectGenericSearch from "../Components/SelectGenericSearch.vue";
    import PaginationTableDefault from "../Components/PaginationTableDefault.vue";
    import IconSituacao from "../Components/IconSituacao.vue";
    import { useExampleStore } from "../../../store/store.js";

    export default{
        name:"ConChamado",
        data(){
            return{
                arrayTempChamados: [],
                varModal:Modal,
                formTemp:useForm({
                    id_chamados:0,
                    assunto_chamados:"",
                    descricao_chamados:""
                }),
                typeModal:Number,
                formEnc:useForm({
                    id_chamados:0,
                    id_users_chamados:0,
                }),
                listUsuario:{},
                lisDepartamento: {},
                user: Object,
                lista_temp: 0,
                dataInicial: "",
                dataFinal: "",
                table_temp: false,
                listDepChe: [],
                listSitChe: [],
                listPriChe: [],
                listUseChe: [],
                listUseAbe: [],
                listaSituacao:[
                    {id: 0, name:"Aberto"},
                    {id: 1, name:"Encaminhado"},
                    {id: 2, name:"Execução"},
                    {id: 3, name:"Pendente"},
                    {id: 4, name:"Resolvido"},
                    {id: 5, name:"Não Resolvido"},
                    {id: 6, name:"Sem Retorno"},
                ],
                listaPrioridade:[
                    {id: 1, name: "Baixa"},
                    {id: 2, name: "Normal"},
                    {id: 3, name: "Alta"}
                ],
                configSelUsu:{
                    id: "id_users",
                    name: "name"
                },
                showModalInterruption:false,
                interruptList: false,
                getStoreFilter: false
            }
        },
        components:{
            IconSituacao, PaginationTableDefault,  SelectGenericSearch, TitlePage, IconLock, Table, ThTable, Loading, InputText, Link, IconPrioridade, TextSituacao, ButtonPrimary, VueDatePicker, Head, Select, SelectGeneric, ButtonDanger
        },
        props:{
        },
        beforeMount(){
            this.getStoreFilter = useExampleStore();
        },
        mounted(){

            this.getStoreFilter = useExampleStore();

            //Montando o modal para edição/visualização
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

            this.user = usePage().props.auth.user;

            this.pesquisar();

            axios.post("/lis/departamento").
            then((response)=>{
                this.lisDepartamento = response.data.lista
            }).
            catch((erro)=>{
                console.log(erro);
            })

            axios.post("/lis/usuario").
            then((result)=>{

                this.listUsuario = result.data.lista

            }).
            catch((erro)=>{
                console.log(erro)
            })

        }, 
        methods:{

            abrirModal(id, type_tmp){

                this.typeModal = type_tmp;

                this.varModal.show();
                
                this.formTemp.reset();

                if(this.typeModal == 2){

                    this.formTemp = useForm({
                        id_chamados:id,
                        id_user_chamados:0,
                        prioridade_chamados:0,
                        status_chamados:1,
                        id_departamento_chamados: 0,
                        obs: ""
                    })

                    axios.post("/lis/departamento").
                    then((response)=>{
                        this.lisDepartamento = response.data.lista
                    }).
                    catch((erro)=>{
                        console.log(erro);
                    })

                }

                if(this.typeModal == 0 || this.typeModal == 1){

                    this.formTemp = useForm({
                        id_chamados:0,
                        assunto_chamados:"",
                        descricao_chamados:""
                    })

                    axios.get("/lis/chamado/" + id).
                    then((response)=>{
                        this.formTemp.id_chamados = response.data.lista.id_chamados
                        this.formTemp.assunto_chamados = response.data.lista.assunto_chamados
                        this.formTemp.descricao_chamados = response.data.lista.descricao_chamados

                        console.log(response)
                    }).
                    catch((erro)=>{
                        console.log(erro)
                    });
                }

            },
            fecharModal(){
                this.varModal.hide();
            },
            salvarAlteracao(){
                this.formTemp.id_chamados && this.formTemp.assunto_chamados && this.formTemp.descricao_chamados ?
                this.formTemp.post("/upd/cha", {
                    preserveScroll:true,
                    onSuccess:()=>{
                        Toast.fire({
                            title:"Alterações realizadas com sucesso!",
                            icon:"success"
                        })
                        this.formTemp.reset();
                        this.varModal.hide();
                        this.pesquisar();
                    }
                }):
                Swal.fire("Atenção!", "Todos os campos são obrigatórios!", "error");
            },
            salvarEncaCha(){

                this.formTemp.obs = eObsTra.value

                if(parseInt(sSelDep.value) && parseInt(sSelUsu.value) && eObsTra.value != ''){

                    this.formTemp.post("/enc/cha",{
                        preserveScroll:true,
                        onSuccess:()=>{
                            Toast.fire({
                                title:"Chamado encaminhado com sucesso!",
                                icon:"success"
                            })
                            this.formTemp.reset();
                            eObsTra.value = "";
                            this.varModal.hide();
                            this.pesquisar();
                        }
                    })
                }else{
                    Swal.fire("Atenção!", "É necessário preencher o departamento, usuário e observações da transferência!", "error");
                }
            },
            assumirChamado(id){
                Swal.fire({
                    title: "Deseja realmente aderir o chamado?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirmar",
                    cancelButtonText: `Cancelar`
                }).then((res) => {

                    if (res.isConfirmed) {

                        axios.post("/adr/cha",{
                            id_chamados:id,
                            status_chamados: 1,
                            id_user_chamados: this.user.id
                        }).
                        then((result)=>{
                            if(result.data[0]){
                                Toast.fire({
                                    title:"Chamado aderido com sucesso!",
                                    icon: "success"
                                });
                                this.pesquisar();
                            }else{
                                Swal.fire("Atenção!", result.data[1], "warning");
                            }

                        }).
                        catch((erro)=>{
                            console.log(erro);
                        })

                    }
                    
                });
            },
            changePage(url){
                if (url) {
                    router.visit(url);
                }
            },
            pesquisar(){

                this.arrayTempChamados = []
                this.lista_temp = 0

                axios.post("/teste",{
                    assunto: eAssPes.value,
                    codigo: eCodPes.value,
                    prioridade: "0",
                    situacao: "5",
                    inicio: this.validarDataIni,
                    fim: this.validarDataFin,
                    departamento: "",
                    deps: this.getStoreFilter.listDepChe,
                    prio: this.getStoreFilter.listPriChe,
                    sits: this.getStoreFilter.listSitChe,
                    resp: this.getStoreFilter.listUseChe,
                    lis_dep: this.user.department,
                    id_user: "",
                    aber: this.getStoreFilter.listUseAbe
                }).
                then((result)=>{

                    this.lista_temp = result.data.lista

                }).
                catch((erro)=>{
                    console.log(erro);
                })

            },
            listaSelectUsu(){
                if(parseInt(sSelDep.value)){

                    console.log(sSelDep.value)

                    axios.post("/lis/usuario").
                    then((response)=>{

                        const temp = []

                        response.data.lista.forEach(element => {

                            const deps = JSON.parse(element.lista_departamento_users)
                            
                            if(deps.find((tes) => tes == parseInt(sSelDep.value))){
                                temp.push(element)
                            }
                               
                        });

                        this.listUsuario = temp

                    }).
                    catch((erro)=>{
                        console.log(erro);
                    })

                }else{
                    sSelUsu.value = "0"
                }
            },
            textDatPt(dat){
                return formatDateTexPtHelpers(dat)
            },
            calcularDias(dat, ref){

                let a = false;

                let horas = calcDifHouUtils(dat, formatDateTextUsHelpers());

                if(horas < ref){
                    a = [0, parseInt(horas) + " hora(s)"]
                }else{
                    a = [1, parseInt(horas) + " hora(s)"]
                }


                if(horas > 24){

                    let dias = parseInt(horas/24);
                    horas = dias + " dia(s) " + parseInt((horas - (dias * 24))) + " hora (s)";
                    a[1] = horas;

                }
                return a;
            },
            viewLastInterruption(id){
                this.showModalInterruption = true
                this.interruptList= false

                axios.post("/con/pendencia/" + parseInt(id)).
                then((result)=>{
                    this.interruptList= result.data.lista
                }).
                catch((erro)=>{
                    console.log(erro);
                })
            }
        },
        computed:{

            validarDataIni(){

                if(this.dataInicial){
                    return new Date(this.dataInicial).toLocaleDateString("pt-BR");
                }else{
                    return ""
                }

            },

            validarDataFin(){

                if(this.dataFinal){
                    return new Date(this.dataFinal).toLocaleDateString("pt-BR");
                }else{
                    return ""
                }

            },

            validarTotal(){
                return "Encontrado(s): " + this.lista.length + " resultado(s)"
            }

        },
        watch:{

        }
    }

</script>