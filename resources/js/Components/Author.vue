<script setup>
import { computed } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    postAt: {
        type: Object,
        required: true
    },
    isAnswer: {
        type: Boolean,
        default: false
    }
})

const postAtString = computed(() => {
    const prefix = props.isAnswer ? 'Answer at' : 'Asked at';
    return prefix + ' ' + props.postAt.formatted
})

const classes = computed(() => {
    return {
        'author': true,
        'owner': !props.isAnswer
    }
})
</script>

<template>
    <div :class="classes">
        <div class="author-info">
            <div class="text-muted mb-1">{{ postAtString }}</div>
            <a href="#" class="avatar-md">
                <div class="d-flex align-items-center justify-content-start">
                    <img :src="user.avatar_url" class="me-2">
                    <span>{{ user.name }}</span>
                </div>
            </a>
        </div>
    </div>
</template>