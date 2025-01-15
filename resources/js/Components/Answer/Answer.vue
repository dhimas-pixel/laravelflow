<script setup>
import { router } from '@inertiajs/vue3';
import Author from '../../Components/Author.vue';
import ActionButton from '../ActionButton.vue';
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
</script>

<template>
    <div class="post-item my-4 border-bottom">
        <div class="vote-col">
            <div class="d-flex flex-column align-items-center">
                <button title="This post is useful" class="btn btn-outline-secondary btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                        <path
                            d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                    </svg>
                </button>
                <div class="votes-count">{{ answer.votes_count }}</div>
                <button title="This post is not useful" class="btn btn-outline-secondary btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path
                            d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                    </svg>
                </button>
                <button title="Bookmark the post" class="btn text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                        <path
                            d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2" />
                    </svg>
                </button>
                <button title="Mark the answer ans accepted" class="btn p-0 answer-accepted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-lg icon-lg" viewBox="0 0 16 16">
                        <path
                            d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="post-col actionable">
            <div class="question-body">
                {{ answer.body }}
            </div>
            <div class="d-flex justify-content-end mb-2">
                <Author :user="answer.user" :post-at="answer.created_at" :is-answer="true" />
            </div>
            <ActionButton :allow-updated="answer.can_be.updated" :allow-deleted="answer.can_be.deleted"
                @remove="removeAnswer" @edit="emit('edit', answer)" />
        </div>
    </div>
</template>