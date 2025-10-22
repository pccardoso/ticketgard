<template>

    <Head>
        <title>Visualizar Ticket - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Histórico do Ticket"></TitlePage>

    <div class="flex flex-col md:flex-col">
        <ul class="flex space-x-4 font-medium text-gray-500 mb-4">
            <li>
                <a @click="tab = 0" href="#"
                    class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full  "
                    aria-current="page">
                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                    </svg>
                    Informações
                </a>
            </li>
            <li>
                <a @click="tab = 1" href="#"
                    class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full  ">
                    <svg class="w-6 h-6 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z"
                            clip-rule="evenodd" />
                    </svg>
                    Bate-Papo
                </a>
            </li>

        </ul>
        <div class="w-full">

            <div class="mb-2 flex justify-end gap-2 flex-wrap">

                <ButtonSuccess @click="executarChamado()"
                    v-if="result['chamado'].id_user_chamados == user.id && (result['chamado'].status_chamados == 1 || result['chamado'].status_chamados == 3)"
                    class="inline-flex">
                    <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z"
                            clip-rule="evenodd" />
                    </svg>
                    Executar
                </ButtonSuccess>

                <ButtonSuccess @click="showModalFinish = true"
                    v-if="(result['chamado'].id_user_chamados == user.id || user.type == 2) && result['chamado'].status_chamados == 2"
                    class="inline-flex">
                    <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                            clip-rule="evenodd" />
                    </svg>
                    Finalizar
                </ButtonSuccess>

                <ButtonDanger @click="showModalCloseInt()"
                    v-if="result['chamado'].id_user_chamados == user.id && result['chamado'].status_chamados == 2"
                    class="inline-flex">
                    <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8Zm7 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1Z"
                            clip-rule="evenodd" />
                    </svg>
                    Pendente
                </ButtonDanger>

            </div>

            <div v-show="tab == 0" class="text-base">

                <div class="bg-white shadow-lg rounded-xl p-6 w-full mx-auto space-y-4 border border-gray-200">

                    <h2 class="text-xl font-semibold text-gray-600">
                        Informações do Ticket
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-700">

                        <!-- ID do Ticket -->
                        <div>
                            <span class="text-gray-500">Código do Ticket:</span>
                            <div class="font-medium text-gray-900">{{ `#${result['chamado'].id_chamados}` }}</div>
                        </div>

                        <!-- Status -->
                        <div>
                            <span class="text-gray-500">Status:</span>
                            <div>
                                <span class="text-sm font-semibold px-2.5 py-0.5 rounded-full"
                                    :class="text_status(result['chamado'].status_chamados)[0], text_status(result['chamado'].status_chamados)[1]">
                                    {{ text_status(result['chamado'].status_chamados)[2] }}
                                </span>
                            </div>
                        </div>

                        <!-- Assunto -->
                        <div>
                            <span class="text-gray-500">Assunto:</span>
                            <div class="font-medium text-gray-900">{{ result['chamado'].assunto_chamados }}</div>
                        </div>

                        <!-- Responsável -->
                        <div>
                            <span class="text-gray-500">Responsável pela Abertura:</span>
                            <div class="font-medium text-gray-900">{{ result['chamado'].nome_criador_chamados }}</div>
                        </div>

                        <!-- Data de criação -->
                        <div>
                            <span class="text-gray-500">Criado em:</span>
                            <div class="font-medium text-gray-900">{{ validarData }}</div>
                        </div>

                        <!-- Data de criação -->
                        <div>
                            <span class="text-gray-500">Última atualização:</span>
                            <div class="font-medium text-gray-900">{{ formatarData(result['chamado'].data_atualizado_chamados) }}
                            </div>
                        </div>

                        <!-- CAMPO DE DESCRIÇÃO OCUPANDO TUDO -->
                        <div class="md:col-span-3">
                            <span class="text-gray-500">Descrição do ticket:</span>
                            <div v-html="result['chamado'].descricao_chamados"
                                class="bg-gray-50 border border-gray-300 rounded-lg p-3 text-gray-800 text-sm whitespace-pre-wrap">
                            </div>
                        </div>

                        <!-- Área de Anexos -->
                        <div class="md:col-span-3" v-if="anexos_chamado.length">

                            <h2 class="text-xl font-semibold text-gray-600 mb-2">
                                Anexos do Ticket
                            </h2>

                            <!-- Tabela de anexos -->
                            <div class="overflow-x-auto">
                                <table
                                    class="min-w-full text-sm text-left text-gray-700 border border-gray-300 overflow-hidden">
                                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                        <tr>
                                            <th scope="col" class="px-4 py-2">Código</th>
                                            <th scope="col" class="px-4 py-2">Nome do Arquivo</th>
                                            <th scope="col" class="px-4 py-2">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(l, index) in anexos_chamado" class="border-b-1 border-blue-100">
                                            <td class="p-1">{{ l.id_file }}</td>
                                            <td>{{ l.caminho_file.split('/')[2] }}</td>
                                            <td class="inline-flex">

                                                <a :href="l.caminho_file" target="_blank" title="Baixar o anexo">
                                                    <svg class="w-[21px] h-[21px] text-gray-800 mr-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                                            clip-rule="evenodd" />
                                                        <path fill-rule="evenodd"
                                                            d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>

                                                <button
                                                    v-if="l.caminho_file.split('.')[1] == 'png' || l.caminho_file.split('.')[1] == 'jpg' || l.caminho_file.split('.')[1] == 'jpeg'"
                                                    @click="abrirModal(l.caminho_file)" class="Visualizar a imagem">
                                                    <svg class="w-[21px] h-[21px] text-gray-800" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-show="tab == 1">

                <ol class="relative border border-gray-300 bg-white shadow-lg rounded-xl">

                    <div class="p-4 space-y-4 w-full h-110 overflow-x-auto w-s rounded-t-xl" ref="bomessage" :style="`background-color: ${backgroundChat.backgroundColor}`">

                        <template v-if="manifestacoes">

                            <template v-for="(l, index) in manifestacoes">

                                <!-- Mensagem da esquerda -->
                                <div v-show="l.id_user_manifestacoes != user.id && l.id_user_manifestacoes"
                                    class="flex justify-start">
                                    <div class="bg-gray-200 text-gray-800 p-3 rounded-lg max-w-[500px] hover:ml-3 hover:bg-gray-300 duration-500 shadow-sm"
                                        :class="l.tipo == '2' ? 'bg-red-300' : ''">
                                        <p class="text-black font-bold">{{ l.name }}</p>

                                        <p class="py-1">{{ l.descricao_manifestacoes }}</p>

                                        <template v-if="l.anexo_manifestacoes">

                                            <img v-if="l.anexo_manifestacoes.split('.')[1] == 'png' || l.anexo_manifestacoes.split('.')[1] == 'jpg' || l.anexo_manifestacoes.split('.')[1] == 'jpeg'"
                                                :src="l.anexo_manifestacoes"
                                                class="rounded-sm w-60 h-60 object-cover object-center"
                                                @click="abrirModal(l.anexo_manifestacoes)">

                                            <audio v-if="l.anexo_manifestacoes.split('.')[1] == 'ogg'" :src="l.anexo_manifestacoes" controls></audio>

                                            <a :href="l.anexo_manifestacoes" target="_blank"
                                                class="inline-flex text-sm">
                                                <svg class="w-6 h-6" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                                        clip-rule="evenodd" />
                                                    <path fill-rule="evenodd"
                                                        d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ l.anexo_manifestacoes.split('/')[2] }}
                                            </a>

                                        </template>

                                        <p class="inline-flex mt-2 text-sm">
                                            <IconClock /> {{ formatDatTex(l.data_cadastro_manifestacoes) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Mensagem da direita -->
                                <div v-show="user.id == l.id_user_manifestacoes" class="flex justify-end">
                                    <div
                                        class="bg-green-200 text-gray-800 p-3 rounded-lg max-w-xs hover:mr-3 hover:bg-green-300 duration-500 shadow-sm ">
                                        <p class="text-black font-bold">{{ l.name }}</p>
                                        <p class="py-1">{{ l.descricao_manifestacoes }}</p>

                                        <template v-if="l.anexo_manifestacoes">

                                            <img v-if="l.anexo_manifestacoes.split('.')[1] == 'png' || l.anexo_manifestacoes.split('.')[1] == 'jpg' || l.anexo_manifestacoes.split('.')[1] == 'jpeg'"
                                                :src="l.anexo_manifestacoes" class="rounded-sm"
                                                @click="abrirModal(l.anexo_manifestacoes)">

                                            <audio v-if="l.anexo_manifestacoes.split('.')[1] == 'ogg'" :src="l.anexo_manifestacoes" controls></audio>

                                            <a :href="l.anexo_manifestacoes" target="_blank" title="Baixar anexo"
                                                class="inline-flex text-sm">
                                                <svg class="w-6 h-6" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                                        clip-rule="evenodd" />
                                                    <path fill-rule="evenodd"
                                                        d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ l.anexo_manifestacoes.split('/')[2] }}
                                            </a>

                                        </template>

                                        <p class="inline-flex text-sm">
                                            <IconClock /> {{ formatDatTex(l.data_cadastro_manifestacoes) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Mensagem do sistema -->
                                <div v-show="!l.id_user_manifestacoes" class="flex justify-center">

                                    <div v-if="l.tipo_manifestacoes == 3"
                                        class="bg-red-200 text-gray-900 p-3 rounded-lg max-w-xs text-center">
                                        {{ l.descricao_manifestacoes }} <br>

                                        <p class="inline-flex mt-2 text-sm">
                                            <IconClock /> {{ formatDatTex(l.data_cadastro_manifestacoes) }}
                                        </p>
                                    </div>

                                    <div v-else-if="user.id != l.id_criador_chamados && l.tipo_manifestacoes == 2"
                                        class="bg-gray-100 text-gray-900 p-3 rounded-lg max-w-xs text-center">

                                        <p class="text-gray-600">Observações da transferência:</p>

                                        {{ l.descricao_manifestacoes }} <br>

                                        <p class="inline-flex mt-2 text-sm">
                                            <IconClock /> {{ formatDatTex(l.data_cadastro_manifestacoes) }}
                                        </p>
                                    </div>

                                    <div v-else class="bg-gray-300 text-gray-900 p-3 rounded-lg max-w-xs text-center">
                                        {{ l.descricao_manifestacoes }} <br>

                                        <p class="inline-flex mt-2 text-sm">
                                            <IconClock /> {{ formatDatTex(l.data_cadastro_manifestacoes) }}
                                        </p>
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
                        <label title="Descer para nova mensagem..."
                            class="bg-green-600 text-white p-2 rounded-3xl shadow-sm animate-pulse inline-flex"
                            @click="fecharNotificacao()">
                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            Nova Mensagem
                        </label>
                    </div>

                    <div class="m-4 space-y-2">

                        <!-- Textarea largo -->
                        <textarea v-show="!isRecording" title="Pressione Enter para enviar..." id="eDesMan" ref="eDesMan"
                            @keyup.enter="salvarManifestacao()"
                            class="bg-gray-50 border-gray-400 border-2 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 focus:h-[100px] block w-full p-2 resize-none h-[40px] duration-300"
                            rows="3" placeholder="Digite sua mensagem...">
                        </textarea>


                        <!-- Linha com botões alinhados à direita -->
                        <div class="flex justify-end gap-2">

                            <!-- Input de arquivo (escondido) -->
                            <input type="file" hidden id="fileInput2" @change="handleFileChange">

                            <!-- Botão de Enviar -->
                            <button v-if="!isRecording && !tema" title="Gravar Áudio"
                                class="bg-red-500 h-10 w-10 rounded-lg hover:bg-red-800 duration-500 flex items-center justify-center"
                                @click="gravarAudio()" :disabled="form_temp.processing">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9v3a5.006 5.006 0 0 1-5 5h-4a5.006 5.006 0 0 1-5-5V9m7 9v3m-3 0h6M11 3h2a3 3 0 0 1 3 3v5a3 3 0 0 1-3 3h-2a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3Z" />
                                </svg>
                            </button>

                            <label v-if="isRecording && !tema" for="isRecording" class="inline-flex items-center animate-pulse">
                                <svg class="w-6 h-6 text-red-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M5 8a1 1 0 0 1 1 1v3a4.006 4.006 0 0 0 4 4h4a4.006 4.006 0 0 0 4-4V9a1 1 0 1 1 2 0v3.001A6.006 6.006 0 0 1 14.001 18H13v2h2a1 1 0 1 1 0 2H9a1 1 0 1 1 0-2h2v-2H9.999A6.006 6.006 0 0 1 4 12.001V9a1 1 0 0 1 1-1Z"
                                        clip-rule="evenodd" />
                                    <path d="M7 6a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v5a4 4 0 0 1-4 4h-2a4 4 0 0 1-4-4V6Z" />
                                </svg>
                                Gravando
                            </label>

                            <!-- Cancelar Áudio -->
                            <button title="Cancelar envio" v-if="isRecording && !tema"
                                class="bg-red-600 h-10 w-10 rounded-lg hover:bg-blue-800 flex items-center justify-center"
                                @click="cancelRecording()">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                </svg>
                            </button>

                            <!-- Botão de enviar áudio -->
                            <button title="Enviar Áudio" v-if="isRecording && !tema"
                                class="bg-green-600 h-10 w-10 rounded-lg hover:bg-blue-800 flex items-center justify-center"
                                @click="stopRecording()" :disabled="form_temp.processing">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                            </button>

                            <!-- Botão de enviar mensagem textual -->
                            <button title="Enviar mensagem" v-if="!isRecording && !tema"
                                class="bg-blue-600 h-10 w-10 rounded-lg hover:bg-blue-800 flex items-center justify-center"
                                @click="salvarManifestacao()" :disabled="form_temp.processing">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                            </button>

                            <!-- Botão de Anexo -->
                            <label for="fileInput2" v-if="!isRecording && !tema"
                                class="bg-blue-600 h-10 w-10 rounded-lg hover:bg-blue-800 flex items-center justify-center"
                                title="Selecionar anexo?">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8v8a5 5 0 1 0 10 0V6.5a3.5 3.5 0 1 0-7 0V15a2 2 0 0 0 4 0V8" />
                                </svg>
                            </label>

                            <!-- Botão de Atualizar -->
                            <button title="Atualizar" v-if="!isRecording && !tema"
                                class="bg-blue-600 h-10 w-10 rounded-lg hover:bg-blue-800 flex items-center justify-center"
                                @click="atualizarManifestacoes()">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                                </svg>
                            </button>

                            <!-- Botão de Tema -->
                            <button v-if="!tema && !isRecording" title="Tema"
                                class="bg-blue-600 h-10 w-10 rounded-lg hover:bg-blue-800 flex items-center justify-center"
                                @click="tema = !tema">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19.9999 18.0661c0 1.6203-1.3431 2.9339-3 2.9339-1.6568 0-3-1.3136-3-2.9339 0-1.6204 3-6.0661 3-6.0661s3 4.4457 3 6.0661Z"/>
                                <path fill="currentColor" fill-rule="evenodd" d="M10.4817 7.52489 9.12238 10.9817H11.841l-1.3593-3.45681Zm3.7494 4.06961-2.7166-6.90843c-.3694-.93918-1.69627-.93917-2.06558 0L6.76269 11.5173c-.03333.0634-.06004.1309-.07922.2014l-1.28309 3.263h-.41869c-.55229 0-1 .4477-1 1s.44771 1 1 1h2.75c.55228 0 1-.4477 1-1s-.44772-1-1-1h-.18223l.78646-2h4.29158l.3676.9349c.2021.514.7826.7668 1.2966.5647.514-.2021.7668-.7826.5647-1.2966l-.6085-1.5473c-.0053-.0144-.0109-.0287-.0168-.0429Z" clip-rule="evenodd"/>
                                </svg>
                            </button>

                            <input v-if="tema" title="Selecione a cor do chat." type="color" v-model="backgroundChat.backgroundColor" placeholder="Cor do box">

                            <!-- Cancelar Cor -->
                            <button title="Fechar" v-if="tema"
                                class="bg-red-600 h-10 w-10 rounded-lg hover:bg-blue-800 flex items-center justify-center"
                                @click="tema = !tema">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                </svg>
                            </button>
                        </div>
                    </div>


                    <div v-if="anexo_manifestacoes.name" class=" m-4 rounded-lg ">
                        <div class="flex items-center justify-between p-2  bg-green-500 rounded-md shadow">
                            <span class="text-white font-medium inline-flex">
                                <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ anexo_manifestacoes.name }}
                            </span>
                            <button class="text-red-600 hover:text-red-800 font-semibold" title="Remover anexo"
                                @click="removerAnexo()" v-if="!form_temp.processing">
                                <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
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

    <div id="modalEl" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg">

                <!-- Modal body -->
                <div class="flex justify-center items-center bg-transparent">
                    <img :src="this.anexo_view" alt="anexo" class="m-5 h-screen">
                </div>

                <div class="text-center">
                    <button class="text-center mt-3 inline-flex bg-gray-600 text-white p-2 rounded-sm"
                        @click="fecharModal">
                        <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                clip-rule="evenodd" />
                        </svg>
                        Fechar
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL PARA ENCERRAR CHAMADOS -->

    <div id="modalEl2" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative max-h-full w-full max-w-2xl">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow-sm ">
                <!-- Modal header -->
                <div class="flex items-start justify-between rounded-t border-b p-5 ">
                    <h3 class="text-xl font-semibold text-gray-900  lg:text-2xl">
                        Finalizar Chamado
                    </h3>
                    <button @click="fecharModal()" type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="space-y-6 p-6">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Observações:</label>
                    <textarea id="eObsCha"
                        class="bg-gray-50 h-40 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-2 rtl:space-x-reverse rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                    <button @click="finalizarChamado()" type="button"
                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300   dark:focus:ring-blue-800">
                        Salvar
                    </button>
                    <button @click="fecharModal()" type="button"
                        class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-300  dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
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

                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-blue-600 px-4 py-3 sm:flex sm:px-6">
                        <label for="forTitle" class="text-[14pt] text-white">Sinalizar Pendência</label>
                    </div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <label for="first_name"
                            class="block mb-2 text-sm font-medium text-gray-900">Observações:</label>
                        <textarea v-model="tObsTransf" id="tObsTransf"
                            class="bg-gray-50 h-40 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                        <label for="forInformativoSina" class="text-gray-500">As observações de pendências serão
                            visualizadas por todos os usuários relacionados diretamente ao ticket.</label>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto"
                            @click="saveInterruptCall()">Confirmar</button>
                        <button type="button"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto"
                            @click="showModalClose = false">Cancelar</button>
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

                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-blue-600 px-4 py-3 sm:flex sm:px-6">
                        <label for="forTitle" class="text-[14pt] text-white">Finalizar Ticket</label>
                    </div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                        <div class="mb-2">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Observações ao
                                finalizar:</label>
                            <textarea id="tObsFinTic"
                                class="bg-gray-50 h-40 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Sobre a solução
                                do
                                ticket:</label>
                            <label for="forResolvido" class="p-1 text-[11pt]"><input type="radio" class="w-5 h-5"
                                    v-model="optionFinish" value="4"> Resolvido</label> <br>
                            <label for="forNaoResolvido" class="p-1 text-[11pt]"><input type="radio" class="w-5 h-5"
                                    v-model="optionFinish" value="5"> Não Resolvido</label> <br>
                            <label for="forInatividade" class="p-1 text-[11pt]"><input type="radio" class="w-5 h-5"
                                    v-model="optionFinish" value="6"> Inatividade</label> <br>
                        </div>

                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto"
                            @click="confirmarFinalizarTickeet()">Confirmar</button>
                        <button type="button"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto"
                            @click="showModalFinish = false">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VISUALIZAR ANEXO -->

    <div v-if="showHistoryNotification"
        class="fixed inset-0 bg-white/30 backdrop-blur-lg z-50 flex items-center justify-center px-4 py-4">

        <button title="Fechar Notificações"
            class="absolute top-4 right-4 text-gray-500 text-5xl font-bold hover:text-red-500"
            @click="showHistoryNotification = !showHistoryNotification">
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
import { useForm } from '@inertiajs/vue3';
import { Modal } from 'flowbite';
import Annotation from '../Icons/Annotation.vue';
import IconRefresh from '../Icons/IconRefresh.vue';
import Loading from '../Components/Loading.vue';
import IconClock from '../Icons/IconClock.vue';
import LoadingChat from '../Components/LoadingChat.vue';
import { formatDateTexPtHelpers } from "../../../helpers/format.js";
import { Head } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { sendEmail, sendNotifyFirebase } from '../../../helpers/utils.js';
import { useExampleStore } from "../../../store/store.js";

export default {
    name: "VisChamado",
    data() {
        return {
            infor: Object,
            tab: 0,
            user: Object,
            manifestacoes: Object,
            form_temp: useForm({}),
            varModal: Modal,
            varModalEncCha: Modal,
            anexo_manifestacoes: "",
            anexo_view: "",
            intervalId: null,
            nova_msg: 0,
            notif: false,
            anexos_chamado: false,
            showModalClose: false,
            tObsTransf: "",
            showModalFinish: false,
            optionFinish: 0,
            showHistoryNotification: false,
            mediaRecorder: null,
            audioChunks: [],
            isRecording: false,
            audioFile: null,
            descricao_temp: "",
            saveAudio: false,
            tema: false,
            backgroundChat: ""
        }
    },
    props: {
        result: Object
    },
    components: {
        TitlePage, Head, ButtonSuccess, ButtonDanger, IconCalendar, ButtonPrimary, Annotation, IconRefresh, Loading, IconClock, LoadingChat
    },
    mounted() {

        this.backgroundChat = useExampleStore();

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


        this.intervalId = setInterval(() => {
            axios.post("/lis/manifestacoes/" + this.result['chamado'].id_chamados).
                then((res) => {

                    this.manifestacoes = res.data.lista

                    if (this.nova_msg == 0) {
                        this.notif = false
                    } else if (this.nova_msg != this.manifestacoes.length) {

                        if (this.manifestacoes[this.manifestacoes.length - 1].id_user_manifestacoes != this.user.id && this.manifestacoes[this.manifestacoes.length - 1].id_user_manifestacoes != null) {
                            this.notif = true
                        }

                    }

                    this.nova_msg = this.manifestacoes.length
                }).
                catch((erro) => {
                    console.log(erro)
                });
        }, 3000)

        this.rolarfinal()

        this.listarAnexo()

        eDesMan.value = "";

    },
    beforeMount() {
        axios.post("/lis/manifestacoes/" + this.result['chamado'].id_chamados).
            then((result) => {
                this.manifestacoes = result.data.lista
            }).
            catch((erro) => {
                console.log(erro)
            });
    },
    beforeUnmount() {
        clearInterval(this.intervalId)
    },
    methods: {

        handleFileChange(event) {
            // Aqui estamos manipulando a mudança do input do tipo "file"
            const file = event.target.files[0];
            this.anexo_manifestacoes = file; // Definimos o arquivo no form
        },
        executarChamado() {
            this.form_temp = useForm({
                id_chamados: this.result['chamado'].id_chamados,
                status_chamados: 2
            })

            this.form_temp.post("/exe/cha", {
                preserveScroll: true,
                onSuccess: () => {

                    Toast.fire({
                        title: "Chamado em execução!",
                        icon: "success"
                    })

                }
            })
        },
        saveInterruptCall() {

            if (this.tObsTransf.length > 2) {



                Swal.fire({
                    title: "Deseja realmente sinalizar pendência no ticket?",
                    showCancelButton: true,
                    icon: "question",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: `Cancelar`
                }).then((result) => {

                    if (result.isConfirmed) {

                        this.form_temp = useForm({
                            id_chamados: this.result['chamado'].id_chamados,
                            status_chamados: 3,
                            observacoes_transferencia: this.tObsTransf
                        })

                        this.form_temp.post("/int/cha", {
                            preserveScroll: true,
                            onSuccess: () => {

                                Toast.fire({
                                    title: "Chamado pendente!",
                                    icon: "warning"
                                })

                                this.showModalClose = false

                            }
                        })

                        this.showModalClose = false

                    }

                })

            } else {
                Swal.fire("Atenção!", "A observação da pendência é obrigatória!", "warning");
            }

        },
        abrirModal(src) {
            this.anexo_view = src
            //this.varModal.show()
            this.showHistoryNotification = true
        },
        fecharModal() {
            this.varModal.hide()
            this.varModalEncCha.hide()
        },
        salvarManifestacao() {

            if (eDesMan.value.length >= 2 || this.descricao_temp) {

                this.form_temp = useForm({
                    id_chamados: this.result['chamado'].id_chamados,
                    descricao_manifestacoes: eDesMan.value || this.descricao_temp,
                    id_users: this.user.id,
                    anexo_manifestacoes: this.anexo_manifestacoes
                });

                this.form_temp.post("/cad/man", {
                    preserveScroll: true,
                    onSuccess: () => {
                        Toast.fire({
                            title: "Mensagem enviada com sucesso!",
                            icon: "success"
                        });

                        if(this.user.id != this.result['chamado'].id_criador_chamados){
                            //enviando notiifcações

                            const payloadNotify = {
                                id_destinatario: this.result['chamado'].id_criador_chamados,
                                email: this.result['user'].email,
                                msg: eDesMan.value,
                                status: "Nova Mensagem",
                                codigo: this.result['chamado'].id_chamados,
                                remetente: this.user.name
                            };

                            if(this.result['user'].notify_email){
                                sendEmail(payloadNotify);
                            }

                            if(this.result['user'].notify_popup){
                                console.log(payloadNotify);
                                sendNotifyFirebase(payloadNotify);
                            }
                        }

                        eDesMan.value = "";
                        fileInput2.value = "";
                        this.anexo_manifestacoes = "";
                        this.descricao_temp = "";
                        this.atualizarManifestacoes();


                    }
                })
            } else {
                Swal.fire("Atenção", "Campo de mensagem é obrigatório!", "error");
                eDesMan.value = "";
            }

            this.rolarfinal()
        },
        abrirModalEncCha() {
            this.varModalEncCha.show()
        },
        finalizarChamado() {


            this.form_temp = useForm({
                id_chamados: this.result['chamado'].id_chamados,
                status_chamados: parseInt(this.optionFinish),
                observacao_chamados: tObsFinTic.value,
            })

            this.form_temp.post("/fin/cha", {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        title: "Chamado finalizado com sucesso!",
                        icon: "success"
                    })

                    this.showModalFinish = false;

                }
            })

        },
        atualizarManifestacoes() {

            this.manifestacoes = 0;

            axios.post("/lis/manifestacoes/" + this.result['chamado'].id_chamados).
                then((result) => {
                    this.manifestacoes = result.data.lista
                    this.rolarfinal()
                }).
                catch((erro) => {
                    console.log(erro)
                });
        },
        temp() {

            axios.post("/lis/manifestacoes/" + this.result['chamado'].id_chamados).
                then((result) => {
                    this.manifestacoes = result.data.lista
                }).
                catch((erro) => {
                    console.log(erro)
                });

        },
        formatDatTex(dat) {
            return formatDateTexPtHelpers(dat)
        },
        rolarfinal() {
            this.$nextTick(() => {
                const div = this.$refs.bomessage
                div.scrollTop = div.scrollHeight;
            });
        },
        gerarNotificacao() {
            this.notif = true
        },
        fecharNotificacao() {
            this.rolarfinal()
            this.notif = false
        },
        listarAnexo() {
            axios.post("/lis/anexos/" + parseInt(this.result['chamado'].id_chamados))
                .then((resul) => {

                    this.anexos_chamado = resul.data.lista

                })
                .catch((erro) => {
                    console.log(erro)
                })
        },
        removerAnexo() {
            this.anexo_manifestacoes = false;
        },
        showModalCloseInt() {
            this.showModalClose = true
            this.tObsTransf = ""
        },
        confirmarFinalizarTickeet() {

            if (tObsFinTic.value && this.optionFinish) {
                this.finalizarChamado()
            } else {
                Swal.fire("Atenção!", "As observações e opções são obrigatórias!", "warning");
            }

        },
        formatarData(data) {
            const dTemp = new Date(data);

            const formatada = dTemp.toLocaleString("pt-BR", {
                day: "2-digit",
                month: "long",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit"
            });
            return formatada;
        },
        text_status(status) {
            switch (status) {
                case 0: return ["text-red-500", "bg-red-100", "Aberto"]; break;
                case 1: return ["text-yellow-500", "bg-yellow-100", "Encaminhado"]; break;
                case 2: return ["text-green-500", "bg-green-100", "Execução"]; break;
                case 3: return ["text-red-500", "bg-red-100", "Pendente"]; break;
                case 4: return ["text-blue-500", "bg-blue-100", "Resolvido"]; break;
                case 5: return ["text-red-500", "bg-red-100", "Não Resolvido"]; break;
                case 6: return ["text-blue-500", "bg-blue-100", "Sem Retorno"]; break;
            }
        },
        async gravarAudio() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                this.audioChunks = [];
                this.mediaRecorder = new MediaRecorder(stream);

                this.mediaRecorder.ondataavailable = (e) => this.audioChunks.push(e.data);

                this.mediaRecorder.onstop = () => {

                    if (!this.saveAudio) {
                        this.audioChunks = [];
                        return; // <-- sai daqui sem salvar nem enviar
                    }

                    const audioBlob = new Blob(this.audioChunks, { type: 'audio/ogg' });
                    // Cria o File com nome, tipo e data
                    this.anexo_manifestacoes = new File([audioBlob], 'gravacao.ogg', {
                        type: 'audio/ogg',
                        lastModified: new Date().getTime(),
                    });

                    this.descricao_temp = "Mensagem de áudio";
                    this.salvarManifestacao();

                };

                this.mediaRecorder.start();
                this.isRecording = true;
            }catch(error){
                // Erro ao acessar microfone
                if (error.name === 'NotAllowedError') {
                alert("Permissão de microfone negada.");
                } else if (error.name === 'NotFoundError') {
                alert("Nenhum dispositivo de áudio foi encontrado.");
                } else {
                alert("Erro ao iniciar gravação: " + error.message);
                }
                // Opcional: limpa estado
                this.mediaRecorder = null;
                this.audioChunks = [];
                this.saveAudio = false;
                this.isRecording = false;
            }
        },
        stopRecording() {
            this.saveAudio = true;
            if (this.mediaRecorder && this.isRecording) {
                this.mediaRecorder.stop();
                this.isRecording = false;
            }
        },
        cancelRecording(){
            this.saveAudio = false;
            if (this.mediaRecorder && this.isRecording) {
                this.mediaRecorder.stop();
                this.isRecording = false;
            }
        }

    },
    computed: {

        validarData() {
            const data = new Date(this.result['chamado'].data_cadastro_chamados);

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