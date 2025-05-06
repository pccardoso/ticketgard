
import { defineStore } from "pinia";


export const useExampleStore = defineStore('example', {
    state: () => ({
        listDepChe: []
    }),
    actions: {
        setName(newName) {
        this.name = newName
        },
    },
})