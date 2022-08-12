<template>
    <div class="progress-bar" v-if="show">
        <div class="progress-bar-value"></div>
    </div>
</template>

<script setup lang="ts">
interface Props {
    show: Boolean,
}

defineProps<Props>();
</script>

<script lang="ts">
export default {name: "ProgressBar"};
</script>
