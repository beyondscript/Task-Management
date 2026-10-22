<template>
    <div class="content_loader" role="status" aria-live="polite">
        <span class="content_spinner" aria-hidden="true"></span>
        <span>{{ label }}</span>
    </div>
</template>

<script setup>
defineProps({
    label: { type: String, default: 'Loading…' }
})
</script>
