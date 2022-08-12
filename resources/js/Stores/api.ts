import {reactive} from "vue";
import axios from "../Utils/axios";

export let api = reactive({
    loading: false,
    client: axios,

    async paginatedGet(url: string) {
        return await this.get(url);
    },

    async get(url: string) {
        this.loading = true;

        const response = await this.client.get(url);
        const data = await response.data;

        this.loading = false;
        return data;
    },
});
