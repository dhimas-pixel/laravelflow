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
    <QuestionForm :question="question" :action="route('questions.update', question.id)" @success="emit('success')"
        method="PUT" />
</template>