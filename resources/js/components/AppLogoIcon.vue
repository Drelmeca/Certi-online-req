<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <div class="flex items-center">
                    <img src="/images/??.jpg" alt="Logo" class="h-25 mr-3">
                </div>
</template>
