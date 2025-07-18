
import { defineStore } from "pinia";

export const useExampleStore = defineStore('example', {
    state: () => ({
        listDepChe: [],
        listSitChe: [],
        listPriChe: [],
        backgroundColor: ""
    }),
    actions: {
        /*setName(newName) {
        this.name = newName
        },*/
    },
    persist: {
        storage: localStorage
    }
})