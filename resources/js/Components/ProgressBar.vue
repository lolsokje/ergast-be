<template>
    <div class="progress-bar" v-if="show">
        <div class="progress-bar-value"></div>
    </div>
</template>

<script setup>
defineProps({
    show: Boolean,
});
</script>

<script>
export default { name: "ProgressBar" };
</script>
