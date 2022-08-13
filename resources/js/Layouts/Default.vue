<template>
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <InertiaLink href="/" class="nav-link">Home</InertiaLink>
                </li>
                <li class="nav-item">
                    <InertiaLink href="/drivers" class="nav-link">Drivers</InertiaLink>
                </li>
            </ul>
        </div>
        <ThemeSwitcher class="pe-5"/>
    </nav>
    <ProgressBar :show="api.loading"/>
    <main class="container mt-3 vh-100">
        <slot/>
    </main>
</template>

<script setup lang="ts">
import ProgressBar from '../Components/ProgressBar.vue';
import { api } from "../Stores/api";
import ThemeSwitcher from '../Components/ThemeSwitcher.vue';</script>

<script lang="ts">
export default { name: 'Default' };
</script>
