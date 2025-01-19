<script setup>
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';
import Author from '../../Components/Author.vue';
import useVote from '../../Composables/useVote';
import ActionButton from '../ActionButton.vue';
import Votable from '../Votable.vue';

const props = defineProps({
    answer: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(['remove', 'edit'])

const removeAnswer = () => {
    if (confirm('Are you sure you want to delete this answer?')) {
        router.delete(route('questions.answers.destroy', [
            props.answer.question_id,
            props.answer.id
        ]), {
            preserveScroll: true,
        })
    }
}

const classes = computed(() => ({
    'answer-accepted': props.answer.is_best,
    'text-secondary': !props.answer.is_best
}))

const acceptAnswer = () => {
    router.post(route('questions.answers.accept', props.answer.id), {
        preserveScroll: true,
    })
}

const { upVote, downVote } = useVote(props.answer, 'questions.answers.vote');
</script>

<template>
    <Votable class="my-4 border-bottom" :votes="answer.votes_count" @up-vote="upVote" @down-vote="downVote">
        <div class="question-body">
            {{ answer.body }}
        </div>
        <div class="d-flex justify-content-end mb-2">
            <Author :user="answer.user" :post-at="answer.created_at" :is-answer="true" />
        </div>
        <ActionButton :allow-updated="answer.can_be.updated" :allow-deleted="answer.can_be.deleted"
            @remove="removeAnswer" @edit="emit('edit', answer)" />
        <template #extra>
            <button title="Mark the answer ans accepted" :disabled="!answer.can_be.accepted" @click="acceptAnswer"
                class="btn p-0" :class="classes">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-lg icon-lg" viewBox="0 0 16 16">
                    <path
                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                </svg>
            </button>
        </template>
    </Votable>
</template>

<style scoped>
.btn:disabled {
    border-color: transparent;
}
</style>