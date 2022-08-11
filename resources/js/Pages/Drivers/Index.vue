<template>
    <Pagination :disabled="api.loading" :links="meta.links" @fetch="fetchDrivers"/>

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

<script setup>
import { onMounted, ref } from 'vue';
import { api } from '../../Stores/api';
import Pagination from '../../Components/Pagination';

const drivers = ref([]);
const meta = ref({});

const fetchDrivers = async (link = null) => {
    drivers.value = [];
    const response = await api.paginatedGet(link ?? `drivers?page=1`);

    drivers.value = response.data;
    meta.value = response.meta;

    meta.value.links.forEach((link) => {
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

<script>
export default { name: "Index" };
</script>
