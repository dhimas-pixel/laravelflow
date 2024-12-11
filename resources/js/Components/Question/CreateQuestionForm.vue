<script setup>
import QuestionForm from './QuestionForm.vue';


const emit = defineEmits(['success'])

const props = defineProps({
    question: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <QuestionForm :question="question" :action="route('questions.store')" @success="emit('success')" />
</template>