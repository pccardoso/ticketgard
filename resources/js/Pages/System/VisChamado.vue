<template>

    <Head>
        <title>Visualizar Ticket - Ticket Gard</title>
    </Head>
    
    <TitlePage titulo="Histórico do Ticket"></TitlePage>

    <div class="md:flex">
        <ul class="flex-column space-y space-y-4 font-medium text-gray-500 md:me-4 mb-2 md:mb-0">
            <li>
                <a @click="tab=0" href="#" class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full  " aria-current="page">
                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                    </svg>
                    Informações
                </a>
            </li>
            <li>
                <a @click="tab=1" href="#" class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full  ">
                    <svg class="w-6 h-6 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z" clip-rule="evenodd"/>
                    </svg>
                    Bate-Papo
                </a>
            </li>

        </ul>
        <div class="p-6 bg-gray-100 text-gray-500  rounded-lg w-full ">

            <div class="bg-gray-200 pl-4 pr-4 pb-4 pt-3 rounded-2xl mb-2">

                <ButtonSuccess @click="executarChamado()" v-if="result.id_user_chamados == user.id && (result.status_chamados == 1 || result.status_chamados == 3)" class="inline-flex">
                    <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z" clip-rule="evenodd"/>
                    </svg>
                    Executar
                </ButtonSuccess>

                <ButtonSuccess @click="showModalFinish=true" v-if="result.id_user_chamados == user.id && result.status_chamados == 2" class="inline-flex">
                    <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                    </svg>

                    Finalizar
                </ButtonSuccess>

                <ButtonDanger @click="showModalCloseInt()" v-if="result.id_user_chamados == user.id && result.status_chamados == 2" class="inline-flex">
                    <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8Zm7 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1Z" clip-rule="evenodd"/>
                    </svg>
                    Pendente
                </ButtonDanger>

            </div>

            <div v-show="tab==0" class="text-base">
                <h3 class="font-bold text-gray-900  mb-2">Detalhes do Ticket</h3>

                <p>
                    <span class="font-bold">Assunto:</span> {{ result.assunto_chamados }}
                </p>

                <p>
                    <span class="font-bold">Descrição:</span> {{ result.descricao_chamados }}
                </p>

                <p>
                    <span class="font-bold">Data de Abertura:</span> {{ validarData }}
                </p>

                <p>
                    <span class="font-bold">Responsável pela abertura: </span> {{ result.nome_criador_chamados }}
                </p>

                <table v-if="anexos_chamado.length" class="w-full bg-white text-center text-base rounded-sm shadow-sm mt-3">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-1">Cód</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(l, index) in anexos_chamado" class="border-b-1 border-blue-100">
                            <td class="p-1">{{ l.id_file }}</td>
                            <td>{{ l.caminho_file.split('/')[2] }}</td>
                            <td class="inline-flex">

                                <a :href="l.caminho_file" target="_blank" title="Baixar o anexo">
                                    <svg class="w-[21px] h-[21px] text-gray-800 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                                    </svg>
                                </a>

                                <button v-if="l.caminho_file.split('.')[1] == 'png' || l.caminho_file.split('.')[1] == 'jpg' || l.caminho_file.split('.')[1] == 'jpeg'" @click="abrirModal(l.caminho_file)" class="Visualizar a imagem">
                                    <svg class="w-[21px] h-[21px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>

                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div v-show="tab==1">

                    <ol class="mt-3 relative border border-gray-300 rounded-sm shadow bg-white">

                        <div class="p-4 space-y-4 w-full h-150 overflow-x-auto w-s" ref="bomessage">

                            <template v-if="manifestacoes">

                                <template v-for="(l, index) in manifestacoes">

                                        <!-- Mensagem da esquerda -->
                                        <div v-show="l.id_user_manifestacoes != user.id && l.id_user_manifestacoes" class="flex justify-start">
                                            <div class="bg-gray-200  text-gray-800 p-3 rounded-lg max-w-[500px] transition hover:ml-2 shadow-sm" :class="l.tipo == '2' ? 'bg-red-300': ''">
                                                <p class="text-black font-bold">{{l.name}}</p>
                                                {{l.descricao_manifestacoes}} <br>
                                                

                                                <template v-if="l.anexo_manifestacoes">

                                                    <a :href="l.anexo_manifestacoes" target="_blank" class="inline-flex bg-gray-600 text-white p-2 rounded-sm mt-2 text-sm mb-2">
                                                        <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                                                            <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ l.anexo_manifestacoes.split('/')[2] }}
                                                    </a>

                                                    <img v-if="l.anexo_manifestacoes.split('.')[1] == 'png' || l.anexo_manifestacoes.split('.')[1] == 'jpg' || l.anexo_manifestacoes.split('.')[1] == 'jpeg'" :src="l.anexo_manifestacoes" class="rounded-sm w-60 h-60 object-cover object-center" @click="abrirModal(l.anexo_manifestacoes)">

                                                </template>
                                                
                                                
                                                <p class="inline-flex mt-2 text-sm"><IconClock/> {{formatDatTex(l.data_cadastro_manifestacoes)}}</p>
                                            </div>
                                        </div>

                                        <!-- Mensagem da direita -->
                                        <div v-show="user.id == l.id_user_manifestacoes" class="flex justify-end">
                                            <div class="bg-green-200 text-gray-800 p-3 rounded-lg max-w-xs transition hover:mr-2 shadow-sm ">
                                                <p class="text-black font-bold">{{l.name}}</p>
                                                {{l.descricao_manifestacoes}} <br>
                                                

                                                <template v-if="l.anexo_manifestacoes">

                                                    <a :href="l.anexo_manifestacoes" target="_blank" class="inline-flex bg-gray-600 text-white p-2 rounded-sm mt-2 text-sm mb-2">
                                                        <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                                                            <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ l.anexo_manifestacoes.split('/')[2] }}
                                                    </a>

                                                    <img v-if="l.anexo_manifestacoes.split('.')[1] == 'png' || l.anexo_manifestacoes.split('.')[1] == 'jpg' || l.anexo_manifestacoes.split('.')[1] == 'jpeg'" :src="l.anexo_manifestacoes" class="rounded-sm" @click="abrirModal(l.anexo_manifestacoes)">

                                                </template>
                                                
                                                
                                                <p class="inline-flex mt-2 text-sm"><IconClock/> {{formatDatTex(l.data_cadastro_manifestacoes)}}</p>
                                            </div>
                                        </div>

                                        <!-- Mensagem do sistema -->
                                        <div v-show="!l.id_user_manifestacoes" class="flex justify-center">

                                            

                                            <div v-if="l.tipo_manifestacoes == 3" class="bg-red-200 text-gray-900 p-3 rounded-lg max-w-xs text-center">
                                                {{l.descricao_manifestacoes}} <br>
                                                
                                                <p class="inline-flex mt-2 text-sm"><IconClock/> {{formatDatTex(l.data_cadastro_manifestacoes)}}</p>
                                            </div>

                                            <div v-else-if="user.id!=l.id_criador_chamados && l.tipo_manifestacoes==2" class="bg-gray-100 text-gray-900 p-3 rounded-lg max-w-xs text-center">
                                                
                                                <p class="text-gray-600">Observações da transferência:</p>

                                                {{l.descricao_manifestacoes}} <br>
                                                
                                                <p class="inline-flex mt-2 text-sm"><IconClock/> {{formatDatTex(l.data_cadastro_manifestacoes)}}</p>
                                            </div>

                                            <div v-else class="bg-gray-300 text-gray-900 p-3 rounded-lg max-w-xs text-center">
                                                {{l.descricao_manifestacoes}} <br>
                                                
                                                <p class="inline-flex mt-2 text-sm"><IconClock/> {{formatDatTex(l.data_cadastro_manifestacoes)}}</p>
                                            </div>

                                        </div>

                                </template>

                            </template>

                            <template v-else>
                                <!--<Loading></Loading>-->
                                <LoadingChat></LoadingChat>
                            </template>

                        </div>

                        <div v-if="this.notif" class="text-center mt-3">
                            <label title="Descer para nova mensagem..." class="bg-green-600 text-white p-2 rounded-3xl shadow-sm animate-pulse inline-flex" @click="fecharNotificacao()">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                                </svg>
                                Nova Mensagem
                            </label>
                        </div>

                        <div class="grid gap-4 m-4 md:grid-cols-4">

                            <!-- Campo de Texto -->
                            <textarea title="Pressione Enter para enviar..." id="eDesMan" @keyup.enter="salvarManifestacao()" class="bg-gray-50 border-gray-500 border-2 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" 
                                rows="1" placeholder="Digite sua mensagem..."></textarea>

                            <!-- Input de Arquivo -->
                            <input type="file" hidden id="fileInput2" @change="handleFileChange" class="bg-gray-50 border-2 border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">

                            <label for="fileInput2" class="bg-blue-600 h-10 rounded-lg hover:bg-blue-800 inline-flex text-white p-2" title="Selecionar anexo?">
                                <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8v8a5 5 0 1 0 10 0V6.5a3.5 3.5 0 1 0-7 0V15a2 2 0 0 0 4 0V8"/>
                                </svg>
                                Anexo
                            </label>

                            <!-- Botão de Envio -->
                            <button title="Enviar mensagem" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800 inline-flex" @click="salvarManifestacao()" :disabled="form_temp.processing">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                                </svg>

                                Enviar
                            </button>

                            <!-- Botão de Atualizar o Chat -->
                            <button title="Atualizar" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800 inline-flex" @click="atualizarManifestacoes()">
                                
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                                </svg>

                                
                                Atualizar
                            </button>

                        </div>

                        <div v-if="anexo_manifestacoes.name" class=" m-4 rounded-lg ">
                            <div class="flex items-center justify-between p-2  bg-green-500 rounded-md shadow">
                                <span class="text-white font-medium inline-flex">
                                    <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ anexo_manifestacoes.name }}
                                </span>
                                <button class="text-red-600 hover:text-red-800 font-semibold" title="Remover anexo" @click="removerAnexo()">
                                    <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </ol>
            </div>
        </div>
    </div>

    <br>

    <!-- MODAL PARA REGISTRO DE MANIFESTAÇÕES -->

    <div
    id="modalEl"
    tabindex="-1"
    aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
>
    <div class="relative w-full max-w-7xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg">            

            <!-- Modal body -->
            <div class="flex justify-center items-center bg-transparent">
                <img :src="this.anexo_view" alt="anexo" class="m-5 h-screen">
            </div>
            
            <div class="text-center">
                <button class="text-center mt-3 inline-flex bg-gray-600 text-white p-2 rounded-sm" @click="fecharModal">
                    <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                    </svg>
                    Fechar
                </button>  
            </div>

        </div>
    </div>
    </div>

    <!-- MODAL PARA ENCERRAR CHAMADOS -->

    <div
    id="modalEl2"
    tabindex="-1"
    aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0"
    >
        <div class="relative max-h-full w-full max-w-2xl">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow-sm ">
                <!-- Modal header -->
                <div
                    class="flex items-start justify-between rounded-t border-b p-5 "
                >
                    <h3
                        class="text-xl font-semibold text-gray-900  lg:text-2xl"
                    >
                        Finalizar Chamado
                    </h3>
                    <button
                        @click="fecharModal()"
                        type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
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
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Observações:</label>
                    <textarea id="eObsCha" class="bg-gray-50 h-40 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-2 rtl:space-x-reverse rounded-b border-t border-gray-200 p-6 dark:border-gray-600"
                >
                    <button
                        @click="finalizarChamado()"
                        type="button"
                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300   dark:focus:ring-blue-800"
                    >
                        Salvar
                    </button>
                    <button
                        @click="fecharModal()"
                        type="button"
                        class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-300  dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SINALIZAR PENDÊNCIA -->

    <div v-if="showModalClose" class="relative z-40" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-blue-600 px-4 py-3 sm:flex sm:px-6">
                        <label for="forTitle" class="text-[14pt] text-white">Sinalizar Pendência</label>
                    </div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Observações:</label>
                        <textarea v-model="tObsTransf" id="tObsTransf" class="bg-gray-50 h-40 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                        <label for="forInformativoSina" class="text-gray-500">As observações de pendências serão visualizadas por todos os usuários relacionados diretamente ao ticket.</label>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto" @click="saveInterruptCall()">Confirmar</button>
                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="showModalClose=false">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- MODAL FINALIZAR TICKET -->

    <div v-if="showModalFinish" class="relative z-40" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-blue-600 px-4 py-3 sm:flex sm:px-6">
                        <label for="forTitle" class="text-[14pt] text-white">Finalizar Ticket</label>
                    </div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        
                        <div class="mb-2">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Observações ao finalizar:</label>
                            <textarea  id="tObsFinTic" class="bg-gray-50 h-40 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Sobre a solução do ticket:</label>
                            <label for="forResolvido" class="p-1 text-[11pt]"><input type="radio" class="w-5 h-5" v-model="optionFinish" value="4"> Resolvido</label> <br>
                            <label for="forNaoResolvido" class="p-1 text-[11pt]"><input type="radio" class="w-5 h-5" v-model="optionFinish" value="5"> Não Resolvido</label> <br>
                            <label for="forInatividade" class="p-1 text-[11pt]"><input type="radio" class="w-5 h-5" v-model="optionFinish" value="6"> Inatividade</label> <br>
                        </div>

                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto" @click="confirmarFinalizarTickeet()">Confirmar</button>
                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="showModalFinish=false">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VISUALIZAR ANEXO -->

    <div v-if="showHistoryNotification" class="fixed inset-0 bg-white/30 backdrop-blur-lg z-50 flex items-center justify-center px-4 py-4">

        <button title="Fechar Notificações" class="absolute top-4 right-4 text-gray-500 text-5xl font-bold hover:text-red-500" @click="showHistoryNotification = !showHistoryNotification">
            &times;
        </button>

        <div class="max-w-3xl w-full">
            <img :src="anexo_view" class="shadow-lg rounded-sm">
        </div>
    </div>

</template>

<script>

    import TitlePage from '../Components/TitlePage.vue';
    import ButtonSuccess from '../Components/ButtonSuccess.vue';
    import ButtonDanger from '../Components/ButtonDanger.vue';
    import ButtonPrimary from '../Components/ButtonPrimary.vue';
    import { usePage } from '@inertiajs/vue3';
    import IconCalendar from '../Icons/IconCalendar.vue';
    import {useForm} from '@inertiajs/vue3';
    import { Modal } from 'flowbite';
    import Annotation from '../Icons/Annotation.vue';
    import IconRefresh from '../Icons/IconRefresh.vue';
    import Loading from '../Components/Loading.vue';
    import IconClock from '../Icons/IconClock.vue';
    import LoadingChat from '../Components/LoadingChat.vue';
    import {formatDateTexPtHelpers} from "../../../helpers/format.js";
    import {Head} from '@inertiajs/vue3';

import Swal from 'sweetalert2';

    export default{
        name:"VisChamado",
        data(){
            return{
                infor:Object,
                tab:0,
                user:Object,
                manifestacoes:Object,
                form_temp:useForm({}),
                varModal:Modal,
                varModalEncCha: Modal,
                anexo_manifestacoes:"",
                anexo_view:"",
                intervalId: null,
                nova_msg:0,
                notif: false,
                anexos_chamado: false,
                showModalClose: false,
                tObsTransf: "",
                showModalFinish: false,
                optionFinish: 0,
                showHistoryNotification: false
            }
        },
        props:{
            result:Object
        },
        components:{
            TitlePage, Head, ButtonSuccess, ButtonDanger, IconCalendar, ButtonPrimary, Annotation,IconRefresh, Loading, IconClock, LoadingChat
        },
        mounted(){

            this.user = usePage().props.auth.user 

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

            //Montando o modal para edição/visualização
            const $targetEl2 = document.getElementById('modalEl2');
            const options2 = {
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 fixed inset-0 z-40',
                closable: false
            };
            const instanceOptions2 = {
            id: 'modalEl',
            override: true
            };

            this.varModal = new Modal($targetEl, options, instanceOptions);
            this.varModalEncCha = new Modal($targetEl2, options2, instanceOptions2);
            

            this.intervalId = setInterval(()=>{
                axios.post("/lis/manifestacoes/" + this.result.id_chamados).
                then((res)=>{

                    this.manifestacoes = res.data.lista

                    if(this.nova_msg == 0){
                        this.notif = false
                    }else if(this.nova_msg != this.manifestacoes.length){

                        if(this.manifestacoes[this.manifestacoes.length-1].id_user_manifestacoes != this.user.id && this.manifestacoes[this.manifestacoes.length-1].id_user_manifestacoes != null){
                            this.notif = true
                        }

                    }

                    this.nova_msg = this.manifestacoes.length
                }).
                catch((erro)=>{
                    console.log(erro)
                });
            }, 2000)

            this.rolarfinal()

            this.listarAnexo()

        },
        beforeMount(){
            axios.post("/lis/manifestacoes/" + this.result.id_chamados).
            then((result)=>{
                this.manifestacoes = result.data.lista
                console.log(this.manifestacoes)
            }).
            catch((erro)=>{
                console.log(erro)
            });
        },
        beforeUnmount(){
            clearInterval(this.intervalId)
        },  
        methods:{

            handleFileChange(event) {
                // Aqui estamos manipulando a mudança do input do tipo "file"
                const file = event.target.files[0];
                this.anexo_manifestacoes = file; // Definimos o arquivo no form
                console.log(this.anexo_manifestacoes)
            },

            executarChamado(){
                this.form_temp = useForm({
                    id_chamados:this.result.id_chamados,
                    status_chamados:2
                })
                
                this.form_temp.post("/exe/cha",{
                    preserveScroll:true,
                    onSuccess:()=>{

                        Toast.fire({
                            title:"Chamado em execução!",
                            icon:"success"
                        })

                    }
                })
            },
            saveInterruptCall(){

                if(this.tObsTransf.length > 2){

                

                    Swal.fire({
                    title: "Deseja realmente sinalizar pendência no ticket?",
                    showCancelButton: true,
                    icon: "question",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: `Cancelar`
                    }).then((result) => {

                        if(result.isConfirmed){

                            this.form_temp = useForm({
                                id_chamados:this.result.id_chamados,
                                status_chamados:3,
                                observacoes_transferencia: this.tObsTransf
                            })
                            
                            this.form_temp.post("/int/cha",{
                                preserveScroll:true,
                                onSuccess:()=>{

                                    Toast.fire({
                                        title:"Chamado pendente!",
                                        icon:"warning"
                                    })

                                    this.showModalClose = false

                                }
                            })

                            this.showModalClose = false

                        }

                    })

                }else{
                    Swal.fire("Atenção!", "A observação da pendência é obrigatória!", "warning");
                }

            },
            abrirModal(src){
                this.anexo_view = src
                //this.varModal.show()
                this.showHistoryNotification = true
            },
            fecharModal(){
                this.varModal.hide()
                this.varModalEncCha.hide()
            },
            salvarManifestacao(){

                if(eDesMan.value.length >= 2){

                    this.form_temp = useForm({
                        id_chamados:this.result.id_chamados,
                        descricao_manifestacoes: eDesMan.value,
                        id_users: this.user.id,
                        anexo_manifestacoes: this.anexo_manifestacoes
                    })

                    this.form_temp.post("/cad/man", {
                        preserveScroll:true,
                        onSuccess:()=>{
                            Toast.fire({
                                title:"Mensagem enviada com sucesso!",
                                icon:"success"
                            })
                            eDesMan.value = "";
                            fileInput2.value = "";
                            this.anexo_manifestacoes = "";
                            this.atualizarManifestacoes();
                            
                        }
                    })
                }else{
                    Swal.fire("Atenção", "Campo de mensagem é obrigatório!", "error");
                    eDesMan.value = "";
                }

                this.rolarfinal()
            },
            abrirModalEncCha(){
                this.varModalEncCha.show()
            },
            finalizarChamado(){


                    this.form_temp = useForm({
                        id_chamados:this.result.id_chamados,
                        status_chamados:parseInt(this.optionFinish),
                        observacao_chamados: tObsFinTic.value,
                    })

                    this.form_temp.post("/fin/cha", {
                        preserveScroll:true,
                        onSuccess:()=>{
                            Toast.fire({
                                title:"Chamado finalizado com sucesso!",
                                icon:"success"
                            })

                            this.showModalFinish = false;

                        }
                    })

            },
            atualizarManifestacoes(){

                this.manifestacoes = 0;

                axios.post("/lis/manifestacoes/" + this.result.id_chamados).
                then((result)=>{
                    this.manifestacoes = result.data.lista
                    this.rolarfinal()
                }).
                catch((erro)=>{
                    console.log(erro)
                });
            },
            temp(){

                axios.post("/lis/manifestacoes/" + this.result.id_chamados).
                then((result)=>{
                    this.manifestacoes = result.data.lista
                }).
                catch((erro)=>{
                    console.log(erro)
                });

            },
            formatDatTex(dat){
                return formatDateTexPtHelpers(dat)
            },
            rolarfinal(){
                this.$nextTick(() => {
                    const div = this.$refs.bomessage
                    div.scrollTop = div.scrollHeight;
                });
            },
            gerarNotificacao(){
                this.notif = true
            },
            fecharNotificacao(){
                this.rolarfinal()
                this.notif = false
            },
            listarAnexo(){
                axios.post("/lis/anexos/" + parseInt(this.result.id_chamados))
                .then((resul)=>{

                    this.anexos_chamado = resul.data.lista

                })
                .catch((erro)=>{
                    console.log(erro)
                })
            },
            removerAnexo(){
                this.anexo_manifestacoes = false;
            },
            showModalCloseInt(){
                this.showModalClose=true
                this.tObsTransf = ""
            },
            confirmarFinalizarTickeet(){

                if(tObsFinTic.value && this.optionFinish){
                    this.finalizarChamado()
                }else{
                    Swal.fire("Atenção!", "As observações e opções são obrigatórias!", "warning");
                }

            }
        },
        computed:{

            validarData(){
                const data = new Date(this.result.data_cadastro_chamados);

                const formatada = data.toLocaleString("pt-BR", {
                day: "2-digit",
                month: "long",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit"
                });

                return formatada
            }

        }
    }
</script>