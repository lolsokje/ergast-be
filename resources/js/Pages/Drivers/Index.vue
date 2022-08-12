<template>
    <Pagination :disabled="api.loading" :links="meta?.links" @fetch="fetchDrivers"/>

    <table class="table" v-if="drivers.length">
        <thead>
        <tr>
            <th>Driver</th>
            <th>Date of birth</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="driver in drivers" :key="driver.id">
            <td>{{ driver.full_name }}</td>
            <td>{{ driver.dob }}</td>
            <td>details</td>
        </tr>
        </tbody>
    </table>
</template>

<script setup lang="ts">
import {onMounted, Ref, ref} from 'vue';
import {api} from '../../Stores/api';
import Pagination from "../../Components/Pagination.vue";
import MetaLink from "../../Interfaces/MetaLink";
import Meta from "../../Interfaces/Meta";
import Driver from "../../Interfaces/Driver";

const drivers: Ref<Array<Driver>> = ref([]);
const meta: Ref<Meta | undefined> = ref();

const fetchDrivers = async (link: string | null = null) => {
    drivers.value = [];
    const response = await api.paginatedGet(link ?? `drivers?page=1`);

    drivers.value = response.data;
    meta.value = response.meta;

    meta.value?.links.forEach((link: MetaLink) => {
        if (link.label.includes('Previous')) {
            link.label = 'Previous';
        }

        if (link.label.includes('Next')) {
            link.label = 'Next';
        }
    });
};

onMounted(async () => {
    await fetchDrivers();
});
</script>

<script lang="ts">
export default {name: "DriverIndex"};
</script>
