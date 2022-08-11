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

<script setup>
defineProps({
    disabled: Boolean,
    links: Array,
});

const emit = defineEmits([ 'fetch' ]);
</script>

<script>
export default { name: "Pagination" };
</script>
