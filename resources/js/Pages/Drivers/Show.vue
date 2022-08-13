<template>
    <template v-if="driver">
        <h2>{{ driver.full_name }}</h2>
        <h4 class="text-muted">{{ driver.dob }}</h4>

        <div v-if="races.length">
            <h3 class="mt-5">Races</h3>

            <Pagination :links="racesMeta?.links" :disabled="api.loading" @fetch="fetchRaces"/>
            <table class="table">
                <thead>
                <tr>
                    <th>Race</th>
                    <th>Team</th>
                    <th>Date</th>
                    <th>Grid</th>
                    <th>Finish</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="race in races" :key="race.id">
                    <td>{{ race.race }}</td>
                    <td>{{ race.team }}</td>
                    <td>{{ race.date }}</td>
                    <td>{{ race.grid === 0 ? 'PIT' : race.grid }}</td>
                    <td>{{ race.position ?? race.status }}</td>
                    <td>
                        <a :href="race.url" target="_blank">details</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </template>
</template>

<script setup lang="ts">
import { onMounted, ref, Ref } from 'vue';
import Driver from '../../Interfaces/Driver';
import { api } from '../../Stores/api';
import DriverRace from '../../Interfaces/DriverRace';
import Pagination from '../../Components/Pagination.vue';
import Meta from '../../Interfaces/Meta';

interface Props {
    id: Number,
};

const props = defineProps<Props>();
const driver: Ref<Driver | null> = ref(null);
const races: Ref<DriverRace[]> = ref([]);
const racesMeta: Ref<Meta | undefined> = ref();

const getDriver = async (id: Number): Promise<Driver> => {
    const response = await api.get(`drivers/${id}`);
    return await response.data;
};

const fetchRaces = async (url: string | null = null) => {
    races.value = [];
    const response = await api.paginatedGet(url ?? `drivers/${props.id}/races`);

    races.value = response.data;
    racesMeta.value = response.meta;
};

onMounted(async () => {
    driver.value = await getDriver(props.id);

    await fetchRaces();
});
</script>

<script lang="ts">
export default { name: "Show" };
</script>
