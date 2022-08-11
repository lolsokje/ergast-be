import { reactive } from "vue";
import apiClient from '../Utils/apiClient';

export let api = reactive({
    loading: false,
    client: apiClient,

    async paginatedGet (url) {
        return await this.get(url);
    },

    async get (url) {
        this.loading = true;

        const response = await this.client.get(url);
        const data = await response.data;

        this.loading = false;
        return data;
    },
});
