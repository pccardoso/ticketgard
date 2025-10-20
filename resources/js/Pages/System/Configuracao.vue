<template>

    <Head>
        <title>Configurações - Ticket Gard</title>
    </Head>

    <TitlePage titulo="Configurações"></TitlePage>

    <div class="p-4 rounded-2xl mb-4 shadow-lg border-1 border-gray-200">

        <div class="border border-gray-200 p-3 rounded-sm mb-3">

            <p class="text-gray-500 text-2xl mb-2">Tipos de Notificações:</p>

            <div class="grid gap-4 mb-4 md:grid-cols-3">

                <div class="flex items-center space-x-2">
                    <input id="notifyEmail" v-model="formTemp.notifyEmail" type="checkbox"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                    <label for="notifyEmail" class="text-sm font-medium text-gray-700">
                        Notificar por E-mail
                    </label>
                </div>

                <div class="flex items-center space-x-2">
                    <input id="notifyPopup" v-model="formTemp.notifyPopup" type="checkbox"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                    <label for="notifyPopup" class="text-sm font-medium text-gray-700">
                        Notificar por Popup
                    </label>
                </div>

            </div>


        </div>

        <ButtonPrimary @click="validar()" class="inline-flex">

            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                    clip-rule="evenodd" />
            </svg>

            Salvar

        </ButtonPrimary>

    </div>

</template>

<script>

import TitlePage from "../Components/TitlePage.vue";
import FormButton from "../Components/FormButton.vue";
import Table from "../Components/Table.vue";
import ThTable from "../Components/ThTable.vue";
import IconPrioridade from "../Components/IconPrioridade.vue";
import ButtonPrimary from "../Components/ButtonPrimary.vue";
import ButtonDanger from "../Components/ButtonDanger.vue";
import { usePage } from "@inertiajs/vue3";
import Label from "../Components/Label.vue";
import { Head } from "@inertiajs/vue3";
import { getUser } from "../../../helpers/utils";

export default {
    name: "ConSolicitacao",
    components: {
        TitlePage, FormButton, Table, ThTable, IconPrioridade, ButtonPrimary, ButtonDanger, Label, Head
    },
    data() {
        return {
            user: Object,
            formTemp: {
                notifyEmail: false,
                notifyPopup: false,
            },
        }
    },
    async mounted() {
        this.user = usePage().props.auth.user;

        const response = await getUser(this.user.id);

        console.log(response);

        if(response.status == 200){
            this.formTemp.notifyEmail = response.data.notify_email ? true : false;
            this.formTemp.notifyPopup = response.data.notify_popup ? true : false;
        }
    },
    methods: {

    }

}

</script>