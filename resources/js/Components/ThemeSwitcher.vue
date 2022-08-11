<template>
    <div class="btn-group">
        <a type="button"
           class="dropdown-toggle"
           data-bs-toggle="dropdown"
           aria-expanded="false"
        >
            Themes
        </a>
        <ul class="dropdown-menu">
            <li role="button" class="dropdown-item" @click.prevent="switchTheme('dark')">Dark</li>
            <li role="button" class="dropdown-item" @click.prevent="switchTheme('light')">Light</li>
        </ul>
    </div>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue';

const currentTheme = ref(null);

const switchTheme = (theme) => {
    currentTheme.value = theme;
};

watch(currentTheme, (newTheme, oldTheme) => {
    document.querySelector('html.theme').classList.remove(oldTheme);
    document.querySelector('html.theme').classList.add(newTheme);

    localStorage.setItem('theme', newTheme);
});

onMounted(() => {
    currentTheme.value = localStorage.getItem('theme') ?? 'dark';
});
</script>

<script>
export default {
    name: "ThemeSwitcher",
};
</script>

<style scoped>

</style>
