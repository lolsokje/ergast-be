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

<script setup lang="ts">
import {onMounted, Ref, ref, watch} from 'vue';

const currentTheme: Ref<string> = ref('');

const switchTheme = (theme: string) => {
    currentTheme.value = theme;
};

watch(currentTheme, (newTheme: string, oldTheme: string) => {
    if (oldTheme !== '') {
        document.querySelector('html.theme')?.classList.remove(oldTheme);
    }
    document.querySelector('html.theme')?.classList.add(newTheme);

    localStorage.setItem('theme', newTheme);
});

onMounted(() => {
    currentTheme.value = localStorage.getItem('theme') ?? 'dark';
});
</script>

<script lang="ts">
export default {name: "ThemeSwitcher",};
</script>

<style scoped>

</style>
