<template>

   <div class="bg-gray">
      <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-blue-800 rounded-lg sm:hidden hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
         <span class="sr-only">Open sidebar</span>
         <svg class="w-6 h-6 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z" clip-rule="evenodd"/>
         </svg> <label class="font-bold">MENU</label>

      </button>

      <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
         <div class="h-full px-3 py-4 overflow-y-auto bg-blue-600">

            <Link href="/" class="flex items-center ps-2.5 mb-5">
               <img src="../../../img/ticket-white.png" class="w-50 me-3 sm:w-50 mt-10" alt="Flowbite Logo" />
            </Link>

            <ul class="space-y-2 font-medium">

               <li>
                  <Link href="/" class="flex items-center p-2 text-white rounded-lg hover:bg-black group transition duration-400">
                     <IconHome class="text-white"></IconHome>
                     <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                  </Link>
               </li>

               <li v-show="user.res_chamados == 1">
                  <Link href="/con/chamado" class="flex items-center p-2 text-white rounded-lg hover:bg-black group transition duration-400">
                     <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 2a7 7 0 0 0-7 7 3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V9a5 5 0 1 1 10 0v7.083A2.919 2.919 0 0 1 14.083 19H14a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a2 2 0 0 0 1.732-1h.351a4.917 4.917 0 0 0 4.83-4H19a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3 7 7 0 0 0-7-7Zm1.45 3.275a4 4 0 0 0-4.352.976 1 1 0 0 0 1.452 1.376 2.001 2.001 0 0 1 2.836-.067 1 1 0 1 0 1.386-1.442 4 4 0 0 0-1.321-.843Z" clip-rule="evenodd"/>
                     </svg>

                     <span class="flex-1 ms-3 whitespace-nowrap">Atendimentos</span>
                  </Link>
               </li>

               <li>
                  <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-black" aria-controls="dropdown-meustickets" data-collapse-toggle="dropdown-meustickets">
                        <Annotation class="text-white"></Annotation>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Meus Tickets</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                  </button>
                  <ul id="dropdown-meustickets" class="hidden py-2 space-y-2">
                        <li>
                           <Link href="/cad/chamado" class="flex items-center w-full p-2 text-white transition duration-400 rounded-lg pl-11 group hover:bg-black">
                              
                              <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                 <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd"/>
                              </svg>
                              Abrir Ticket
                           </Link>

                        </li>
                        <li>
                           <Link href="/meuchamado" class="flex items-center w-full p-2 text-white transition duration-400 rounded-lg pl-11 group hover:bg-black">
                              
                              <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M3.22302 14C4.13247 18.008 7.71683 21 12 21c4.9706 0 9-4.0294 9-9 0-4.97056-4.0294-9-9-9-3.72916 0-6.92858 2.26806-8.29409 5.5M7 9H3V5"/>
                              </svg>
                              Histórico do Ticket</Link>
                        </li>

                  </ul>
               </li>

               <li v-show="user.adm == 1">
                  <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-black" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                           <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Cadastrar</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                  </button>
                  <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                           <Link href="/cad/departamento" class="flex items-center w-full p-2 text-white transition duration-400 rounded-lg pl-11 group hover:bg-black">
                              <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 1-.4477 1-1V3.85714C20 2.98529 19.3667 2 18.268 2H6Z"/>
                                 <path d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z"/>
                              </svg>
                              Departamento</Link>
                        </li>
                        <li>
                           <Link href="/cad/solicitacao" class="flex items-center w-full p-2 text-white transition duration-400 rounded-lg pl-11 group hover:bg-black">
                              
                              <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                 <path fill-rule="evenodd" d="M3 6a3 3 0 1 1 4 2.83v6.34a3.001 3.001 0 1 1-2 0V8.83A3.001 3.001 0 0 1 3 6Zm11.207-2.707a1 1 0 0 1 0 1.414L13.914 5H15a4 4 0 0 1 4 4v6.17a3.001 3.001 0 1 1-2 0V9a2 2 0 0 0-2-2h-1.086l.293.293a1 1 0 0 1-1.414 1.414l-2-2a1 1 0 0 1 0-1.414l2-2a1 1 0 0 1 1.414 0Z" clip-rule="evenodd"/>
                              </svg>
                              Solicitação</Link>
                        </li>
                        <li>
                           <Link href="/cad/usuario" class="flex items-center w-full p-2 text-white transition duration-400 rounded-lg pl-11 group hover:bg-black">
                              <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                 <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                              </svg>
                              Usuario
                           </Link>
                        </li>

                  </ul>
               </li>

               <li v-show="user.adm == 1">
                  <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-400 rounded-lg group hover:bg-black " aria-controls="dropdown-example" data-collapse-toggle="dropdown-example2">
                     <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                     </svg>

                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Consultar</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                  </button>
                  <ul id="dropdown-example2" class="hidden py-2 space-y-2">
                        <li>
                           <Link href="/con/departamento" class="flex items-center w-full p-2 text-white transition duration-400 rounded-lg pl-11 group hover:bg-black">
                              <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 1-.4477 1-1V3.85714C20 2.98529 19.3667 2 18.268 2H6Z"/>
                                 <path d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z"/>
                              </svg>
                              Departamento
                           </Link>
                        </li>

                        <li>
                           <Link href="/con/solicitacao" class="flex items-center w-full p-2 text-white transition duration-400 rounded-lg pl-11 group hover:bg-black">
                              <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                 <path fill-rule="evenodd" d="M3 6a3 3 0 1 1 4 2.83v6.34a3.001 3.001 0 1 1-2 0V8.83A3.001 3.001 0 0 1 3 6Zm11.207-2.707a1 1 0 0 1 0 1.414L13.914 5H15a4 4 0 0 1 4 4v6.17a3.001 3.001 0 1 1-2 0V9a2 2 0 0 0-2-2h-1.086l.293.293a1 1 0 0 1-1.414 1.414l-2-2a1 1 0 0 1 0-1.414l2-2a1 1 0 0 1 1.414 0Z" clip-rule="evenodd"/>
                              </svg>
                              Solicitações
                           </Link>
                        </li>
                        <li>
                           <Link href="/con/usuario" class="flex items-center w-full p-2 text-white transition duration-400 rounded-lg pl-11 group hover:bg-black">
                              <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                 <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                              </svg>
                              Usuário
                           </Link>
                        </li>
                  </ul>
               </li>

               <li>
                  <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-black" aria-controls="dropdown-meusuario" data-collapse-toggle="dropdown-meusuario">
                        <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Meu Usuário</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                  </button>
                  <ul id="dropdown-meusuario" class="hidden py-2 space-y-2">
                        <li>
                           <Link href="/edi/password" class="flex items-center w-full p-2 text-white transition duration-400 rounded-lg pl-11 group hover:bg-black">
                              
                              <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                 <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                              </svg>

                              Atualizar Senha
                           </Link>
                        </li>

                  </ul>
               </li>

               <li>
                  <Link href="/logout" class="flex items-center p-2 text-white rounded-lg hover:bg-black group transition duration-400">
                     <Close class="text-white"></Close>
                     <span class="flex-1 ms-3 whitespace-nowrap">Sair</span>
                  </Link>
               </li>

            </ul>
         </div>
      </aside>

      <div class="p-8 sm:ml-64 h-screen">

         <div class="flex flex-row space-x-2">

            <div class="inline-flex mb-2 text-white bg-blue-600 rounded-2xl p-1 pl-3 pr-3 shadow-lg"><IconUser class="text-color-500"/>{{ user.name }}</div>
            
            <div v-if="user.vip" class="inline-flex ml-2 mb-2 text-white bg-yellow-400 rounded-2xl p-1 pl-3 pr-3 shadow-lg" title="Seu usuário é VIP"><img src="../../../img/vip.png.png" class="w-5 mr-1">Usuário VIP</div>


            <div class="relative inline-block">
               <!-- Botão -->

               <svg v-if="user.res_chamados"  @click="showPopupNotification()" class="w-8 h-8 text-blue-800" :class="controlHistoryNotification ? 'text-red-500 animate-pulse' : ''" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
               <path d="M17.133 12.632v-1.8a5.407 5.407 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.933.933 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175Zm-13.267-.8a1 1 0 0 1-1-1 9.424 9.424 0 0 1 2.517-6.391A1.001 1.001 0 1 1 6.854 5.8a7.43 7.43 0 0 0-1.988 5.037 1 1 0 0 1-1 .995Zm16.268 0a1 1 0 0 1-1-1A7.431 7.431 0 0 0 17.146 5.8a1 1 0 0 1 1.471-1.354 9.424 9.424 0 0 1 2.517 6.391 1 1 0 0 1-1 .995ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z"/>
               </svg>

               <!-- Div flutuante 
               <div
                  v-if="mostrar"
                  class="absolute z-50 mt-2 w-85 p-4 bg-white border border-gray-200 rounded-lg shadow-xl right-0"
               >
                  <h3 class="text-lg font-semibold mb-2">Últimas Notificações</h3>

                     <div v-if="loadingShow">

                        <div class="w-full bg-gray-400 animate-pulse mb-2 h-10 rounded-sm"></div>

                        <div class="w-full bg-gray-400 animate-pulse mb-2 h-10 rounded-sm"></div>

                        <div class="w-full bg-gray-400 animate-pulse mb-2 h-10 rounded-sm"></div>

                        <div class="w-full bg-gray-400 animate-pulse mb-2 h-10 rounded-sm"></div>

                     </div>

                     <div v-else class="overflow-auto h-70 border-1 rounded-lg border-gray-200 p-1">

                        <div class="text-sm text-gray-700 inline-flex bg-red-200 rounded-sm p-1 m-1">
                           <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 10.5h.01m-4.01 0h.01M8 10.5h.01M5 5h14a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-6.6a1 1 0 0 0-.69.275l-2.866 2.723A.5.5 0 0 1 8 18.635V17a1 1 0 0 0-1-1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                           </svg>

                           <a href="#" target="_blank" class="text-blue-800 underline font-bold" title="Código do Ticket">#123</a>

                           Léo Lobianco gerou novo ticket
                        </div>

                        <div class="text-sm text-gray-700 inline-flex bg-blue-200 rounded-sm p-1 m-1">
                           <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                           </svg>

                           <a href="#" target="_blank" class="text-blue-800 underline font-bold" title="Código do Ticket">#123</a>

                           Léo Lobianco enviou nova mensagem
                        </div>

                        <div class="text-sm text-gray-700 inline-flex bg-red-200 rounded-sm p-1 m-1">
                           <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 10.5h.01m-4.01 0h.01M8 10.5h.01M5 5h14a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-6.6a1 1 0 0 0-.69.275l-2.866 2.723A.5.5 0 0 1 8 18.635V17a1 1 0 0 0-1-1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                           </svg>

                           <a href="#" target="_blank" class="text-blue-800 underline font-bold" title="Código do Ticket">#123</a>

                           Léo Lobianco gerou novo ticket
                        </div>

                        <div class="text-sm text-gray-700 inline-flex bg-red-200 rounded-sm p-1 m-1">
                           <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 10.5h.01m-4.01 0h.01M8 10.5h.01M5 5h14a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-6.6a1 1 0 0 0-.69.275l-2.866 2.723A.5.5 0 0 1 8 18.635V17a1 1 0 0 0-1-1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                           </svg>

                           <a href="#" target="_blank" class="text-blue-800 underline font-bold" title="Código do Ticket">#123</a>

                           Diego Tenório gerou novo ticket
                        </div>

                        <div class="text-sm text-gray-700 inline-flex bg-blue-200 rounded-sm p-1 m-1">
                           <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                           </svg>

                           <a href="#" target="_blank" class="text-blue-800 underline font-bold" title="Código do Ticket">#123</a>

                           Léo Lobianco enviou nova mensagem
                        </div>

                        <div class="text-sm text-gray-700 inline-flex bg-blue-200 rounded-sm p-1 m-1">
                           <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                           </svg>

                           <a href="#" target="_blank" class="text-blue-800 underline font-bold" title="Código do Ticket">#123</a>

                           Léo Lobianco enviou nova mensagem
                        </div>

                        <div class="text-sm text-gray-700 inline-flex bg-red-200 rounded-sm p-1 m-1">
                           <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 10.5h.01m-4.01 0h.01M8 10.5h.01M5 5h14a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-6.6a1 1 0 0 0-.69.275l-2.866 2.723A.5.5 0 0 1 8 18.635V17a1 1 0 0 0-1-1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                           </svg>

                           <a href="#" target="_blank" class="text-blue-800 underline font-bold" title="Código do Ticket">#123</a>

                           Diego Tenório gerou novo ticket
                        </div>

                        <div class="text-sm text-gray-700 inline-flex bg-red-200 rounded-sm p-1 m-1">
                           <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 10.5h.01m-4.01 0h.01M8 10.5h.01M5 5h14a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-6.6a1 1 0 0 0-.69.275l-2.866 2.723A.5.5 0 0 1 8 18.635V17a1 1 0 0 0-1-1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                           </svg>

                           <a href="#" target="_blank" class="text-blue-800 underline font-bold" title="Código do Ticket">#123</a>

                           Diego Tenório gerou novo ticket
                        </div>
                     </div>
                     
                  <p
                  @click="mostrar = false"
                  class="mt-3 text-gray-800 text-sm inline-flex"
                  >
                     <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                     </svg>
                     Fechar
                  </p>
               </div>
               -->

               <div v-if="showHistoryNotification" class="fixed inset-0 bg-white/30 backdrop-blur-lg z-50 flex items-center justify-center px-4 py-4">

                  <button title="Fechar Notificações" class="absolute top-4 right-4 text-gray-500 text-5xl font-bold hover:text-red-500" @click="showHistoryNotification = !showHistoryNotification">
                     &times;
                  </button>

                  <div class="max-w-lg w-full">

                     <div class="bg-white/80 p-4 rounded-sm mb-2 shadow-sm mx-1">

                        <p class="inline-flex text-gray-600 text-center">
                           
                           <svg class="w-6 h-6 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.193-.538 1.193H5.538c-.538 0-.538-.6-.538-1.193 0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365Zm-8.134 5.368a8.458 8.458 0 0 1 2.252-5.714m14.016 5.714a8.458 8.458 0 0 0-2.252-5.714M8.54 17.901a3.48 3.48 0 0 0 6.92 0H8.54Z"/>
                           </svg>
                           Últimas Notificações
                        </p>

                     </div>

                     <div class="py-2 mb-1 px-1">
                        <div class="flex space-x-1.5 justify-start">
                           <div class="flex text-gray-500 px-3 py-1 rounded-4xl shadow-sm" :class="selectFilterNotification == 0 ? 'bg-blue-600 text-white':'bg-white/60 '" @click="selectFilterNotification = 0">
                              <svg class="w-6 h-6 " :class="selectFilterNotification == 0 ? 'text-white' : 'text-gray-600'" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6h8m-8 4h12M6 14h8m-8 4h12"/>
                              </svg>
                              Todas
                           </div>
                           <div class="flex text-gray-500 px-3 py-1 rounded-4xl shadow-sm" :class="selectFilterNotification == 1 ? 'bg-blue-600 text-white':'bg-white/60 '" @click="selectFilterNotification = 1">
                              <svg class="w-6 h-6" :class="selectFilterNotification == 1 ? 'text-white' : 'text-gray-600'" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                 <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                              </svg>

                              Mensagens
                           </div>
                           <div class="flex text-gray-500 px-3 py-1 rounded-4xl shadow-sm" :class="selectFilterNotification == 2 ? 'bg-red-600 text-white':'bg-white/60 '" @click="selectFilterNotification = 2">
                              <svg class="w-6 h-6" :class="selectFilterNotification == 2 ? 'text-white' : 'text-gray-600'" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z"/>
                              </svg>
                              Tickets
                           </div>
                        </div>
                     </div>

                     <!--<p class="text-gray-500 text-sm text-center">{{ countTextNotification }}</p>-->

                     <div class="h-120 overflow-auto p-1">

                        <template v-if="!loadingShow">

                           <div v-if="arrayNotificationTemp.length">
                              
                              <div v-for="(l, index) in arrayNotificationTemp" v-bind:key="index" >

                                    <template v-if="l.tipo_notificacao == 1 && user.id==l.id_user_chamados">

                                       <div class="bg-white/70 border-l-4 border-l-blue-600 p-4 rounded-sm shadow-sm mb-2 hover:bg-gray-200 transform duration-500">
                                          <a title="Abrir o ticket?" :href="'/history/' + l.id_chamados" class="inline-flex text-sm text-gray-600 hover:text-blue-800">
                                             <svg class="w-5 h-5 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 9h5m3 0h2M7 12h2m3 0h5M5 5h14a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-6.616a1 1 0 0 0-.67.257l-2.88 2.592A.5.5 0 0 1 8 18.477V17a1 1 0 0 0-1-1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                                             </svg>

                                             {{ l.descricao_notificacao }}
                                          </a>
                                          <br>
                                          <p class="inline-flex text-[8pt] text-gray-500">
                                             
                                             <svg class="w-4 h-4 text-gray-500 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                             </svg>


                                             {{ textDatPt(l.data_cadastro_notificacao) }}
                                          
                                             <svg class="w-4 h-4 ml-1 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z"/>
                                             </svg>

                                             {{ l.nome_departamentos }}
                                          
                                          </p>
                                       </div>

                                    </template>

                                    <template v-else-if="l.tipo_notificacao == 0">

                                       <div class="bg-white/70 border-l-4 border-l-red-600 p-4 rounded-sm shadow-sm mb-2 hover:bg-gray-200 transform duration-500">
                                          <a title="Abrir o ticket?" :href="'/history/' + l.id_chamados" class="inline-flex text-sm text-gray-600 hover:text-blue-800">
                                             <svg class="w-5 h-5 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                             </svg>
                                             {{ l.descricao_notificacao }}
                                          </a>
                                          <br>
                                          <p class="inline-flex text-[8pt] text-gray-500">
                                             
                                             <svg class="w-4 h-4 text-gray-500 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                             </svg>


                                             {{ textDatPt(l.data_cadastro_notificacao) }}
                                          
                                             <svg class="w-4 h-4 ml-1 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z"/>
                                             </svg>

                                             {{ l.nome_departamentos }}
                                          
                                          </p>
                                       </div>

                                    </template>

                              </div>

                           </div>

                           <div v-else>
                              <p class="text-gray-500 text-normal flex justify-center mt-20">
                                 <svg class="w-6 h-6 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.99 9H15M8.99 9H9m12 3a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM7 13c0 1 .507 2.397 1.494 3.216a5.5 5.5 0 0 0 7.022 0C16.503 15.397 17 14 17 13c0 0-1.99 1-4.995 1S7 13 7 13Z"/>
                                 </svg>
                                 Sem notificações...
                              </p>
                           </div>
                        </template>

                        <template v-else>
                           
                           <div class="bg-gray-300 animate-pulse p-2 w-full rounded-sm h-15 mb-2"></div>
                           <div class="bg-gray-300 animate-pulse p-2 w-full rounded-sm h-15 mb-2"></div>
                           <div class="bg-gray-300 animate-pulse p-2 w-full rounded-sm h-15 mb-2"></div>
                           <div class="bg-gray-300 animate-pulse p-2 w-full rounded-sm h-15 mb-2"></div>
                           <div class="bg-gray-300 animate-pulse p-2 w-full rounded-sm h-15 mb-2"></div>
                           
                        </template>

                     </div>

                     <p class="text-gray-400 text-sm text-center mt-2">Últimas notificações do dia.</p>

                  </div>
               </div>


            </div>

         </div>

         <div class="pb-30" style="font-size: 10pt;"><slot></slot></div>

      </div>
   </div>

   <div v-if="showNotification" class="fixed top-5 right-4 px-4 py-2 z-50">

      <div class="bg-red-400 text-white p-2 border-gray-400 w-80 rounded-sm mb-4 shadow-sm animate-pulse hover:animate-none">

         <p class="font-bold inline-flex">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
               <path d="M11.209 3.816a1 1 0 0 0-1.966.368l.325 1.74a5.338 5.338 0 0 0-2.8 5.762l.276 1.473.055.296c.258 1.374-.228 2.262-.63 2.998-.285.52-.527.964-.437 1.449.11.586.22 1.173.75 1.074l12.7-2.377c.528-.1.418-.685.308-1.27-.103-.564-.636-1.123-1.195-1.711-.606-.636-1.243-1.306-1.404-2.051-.233-1.085-.275-1.387-.303-1.587-.009-.063-.016-.117-.028-.182a5.338 5.338 0 0 0-5.353-4.39l-.298-1.592Z"/>
               <path fill-rule="evenodd" d="M6.539 4.278a1 1 0 0 1 .07 1.412c-1.115 1.23-1.705 2.605-1.83 4.26a1 1 0 0 1-1.995-.15c.16-2.099.929-3.893 2.342-5.453a1 1 0 0 1 1.413-.069Z" clip-rule="evenodd"/>
               <path d="M8.95 19.7c.7.8 1.7 1.3 2.8 1.3 1.6 0 2.9-1.1 3.3-2.5l-6.1 1.2Z"/>
            </svg>

            Atenção</p>
         <p>Seu departamento tem {{ listTicketNotification.length }} nova (s) notificação.</p>
      
         <!--
         <p class="inline-flex" v-for="(l, index) in listTicketNotification">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
               <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
            </svg>
            {{l.nome_criador_chamados}}
         </p>
         -->
      </div>
  
   </div>

   <Link title="Abrir Novo Ticket" href="/cad/chamado" class="fixed bottom-6 right-6 bg-blue-500 hover:bg-blue-700 text-white p-4 rounded-full shadow-2xl">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
   </Link>

</template>

<script>

   import { Link } from '@inertiajs/vue3'
   import { initFlowbite } from 'flowbite';
   import IconHome from '../Icons/IconHome.vue';
   import CheckPlus from '../Icons/CheckPlus.vue';
   import Close from '../Icons/Close.vue';
   import { usePage } from '@inertiajs/vue3';
   import Annotation from '../Icons/Annotation.vue';
   import IconUser from '../Icons/IconUser.vue';
   import IconDepart from '../Icons/IconDepart.vue';
   import {getTimeCurrentUtils} from '../../../helpers/utils.js';
   import Loading from "../Components/Loading.vue";
   import {formatDateTexPtHelpers} from "../../../helpers/format.js";

   export default{
      name:"Navbar",
      data(){
         return{
            permissao:[],
            user:Object,
            status: 0,
            showNotification: false,
            listTicketNotification: [],
            timeEnd: 0,
            timeStart: 0,
            titleTemp: "",
            setInNotification: false,
            showHistoryNotification: false,
            loadingShow: true,
            controlHistoryNotification: false,
            arrayNotification: [],
            arrayNotificationTemp: [],
            selectFilterNotification: false,
            countTextNotification: ""
         }
      },
      components:{
         Link, IconHome, CheckPlus, Close, Annotation, IconUser, IconDepart, Loading
      },
      beforeUnmount(){
         clearInterval(this.setInNotification);
      },
      mounted(){

         //carrega a hora inicial
         this.timeStart = getTimeCurrentUtils();

         initFlowbite();

         //carrega atributos da sessão atual
         this.user = usePage().props.auth.user;

         //buscar por novos tickets dentro do início/fim programado.
         this.setInNotification = setInterval(() => {

            //hora atual que entra no loop
            this.timeEnd = getTimeCurrentUtils();

            //controle
            console.log(`${this.timeStart} & ${this.timeEnd}`);
            axios.post("/count/chamado",{
               timeStart: this.timeStart,
               timeEnd: this.timeEnd,
               listDepartament: this.user.department
            }).
            then((result) => {
               
               if(result.data.lista.length){

                  //recuperando o title da página atual
                  this.titleTemp = document.title;

                  //definindo o novo title da página atual
                  document.title = `${result.data.lista.length} novo(s) ticket(s)`;

                  //ativando o alert de notificações
                  this.actionShowNotification();

                  //carregando a lista de usuários da notificação encontrada
                  this.listTicketNotification = result.data.lista;
                  this.controlHistoryNotification = true;

               }

            })

            //definir hora inicial como a hora final para então carregar o novo ciclo
            this.timeStart = this.timeEnd;


         }, (10000));

      },
      beforeUnmount(){
         //clearInterval(this.status)
      },
      methods:{
         actionShowNotification(){
            this.showNotification = !this.showNotification

            setTimeout(() => {
               this.showNotification = false;
               document.title = this.titleTemp;
            }, 8000);
            
         },
         showPopupNotification(){

            this.selectFilterNotification = 0;

            this.controlHistoryNotification = false;
            this.showHistoryNotification = true;
            this.loadingShow = true;

            axios.post("/history/notification",{
               listDepartament: this.user.department
            })
            .then((result) =>{
               this.loadingShow = false;
               this.arrayNotification = result.data.lista
               this.arrayNotificationTemp = result.data.lista
               this.countTextNotification = `${this.arrayNotificationTemp.length} notificações encontradas`
            })
            .catch((erro) =>{
               console.log(erro);
            })

            this.controlHistoryNotification = false;
            this.showHistoryNotification = true;
            this.loadingShow = true;

         },
         textDatPt(dat){
            return formatDateTexPtHelpers(dat);
         }
      },
      watch:{
         selectFilterNotification(temp){

            if(temp == 0){
               this.arrayNotificationTemp = this.arrayNotification
            }else if(temp == 1){
               this.arrayNotificationTemp = this.arrayNotification.filter((ob) => ob.tipo_notificacao == 1);
            }else if(temp == 2){
               this.arrayNotificationTemp = this.arrayNotification.filter((ob) => ob.tipo_notificacao == 0);
            }

            if(this.arrayNotificationTemp.length){
               this.countTextNotification = `${this.arrayNotificationTemp.length} notificações encontradas`
            }
            
         }
      }
   }

</script>


