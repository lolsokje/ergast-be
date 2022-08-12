<template>
    <ul class="pagination">
        <li class="page-item"
            v-for="(link, index) in links"
            :key="index"
            :class="{ 'active' : link.active, 'disabled' : link.disabled || !link.url || disabled  }"
        >
            <button class="page-link" @click.stop="emit('fetch', link.url)">{{ link.label }}</button>
        </li>
    </ul>
</template>

<script setup lang="ts">
import MetaLink from "../Interfaces/MetaLink";

interface Props {
    disabled: Boolean,
    links?: Array<MetaLink>,
}

defineProps<Props>();

const emit = defineEmits(['fetch']);
</script>

<script lang="ts">
export default {name: "Pagination"};
</script>
