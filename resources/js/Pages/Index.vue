<template>
    <div class="row" v-if="birthdays.length">
        <h2>Today's birthdays</h2>

        <div class="row">
            <div class="col-4" v-for="driver in birthdays" :key="driver.driverId">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <h5 class="card-title">{{ driver.full_name }}</h5>
                                <h6 class="card-subtitle text-muted">{{ driver.dob }}</h6>
                            </div>
                            <div class="col-3">
                                <InertiaLink :href="`drivers/${driver.id}`" class="btn btn-primary">
                                    details
                                </InertiaLink>
                            </div>
                        </div>
                        <hr>
                        <h5 class="card-title">Stats</h5>
                        <ul class="list-unstyled">
                            <li v-for="(value, statName) in driver.stats" :key="statName">
                                {{ ucFirst(statName) }}: {{ value }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, Ref, ref } from 'vue';
import { api } from '../Stores/api';
import { ucFirst } from '../Utils/firstLetterUppercase';
import Driver from "../Interfaces/Driver";

const birthdays: Ref<Array<Driver>> = ref([]);

onMounted(async () => {
    birthdays.value = await api.get('drivers/birthdays');
});
</script>

<script lang="ts">
export default { name: 'Index' };
</script>
