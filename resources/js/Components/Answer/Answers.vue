<script setup>
import { reactive } from 'vue';
import useModal from '../../Composables/useModal';
import Pagination from '../Pagination.vue';
import Answer from './Answer.vue';
import UpdateAnswer from './UpdateAnswer.vue';

const { showModal, hideModal, modalTitle, Modal } = useModal('#update-answer-modal');

defineProps({
    answers: {
        type: Object,
        required: true
    }
})

const editAnswer = (payload) => {
    modalTitle.value = 'Edit Answer'

    editingAnswer.body = payload.body
    editingAnswer.question_id = payload.question_id
    editingAnswer.id = payload.id

    showModal()
}

const editingAnswer = reactive({
    body: '',
    question_id: '',
    id: ''
})
</script>

<template>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mt-4 answer-header">{{ answers.meta.total }} Answers</h2>
        <Pagination :meta="answers.meta" />
    </div>
    <div class="answer-content mt-4">
        <Answer v-for="answer in answers.data" :key="answer.id" :answer="answer" @edit="editAnswer" />
    </div>
    <Modal id="update-answer-modal" :title="modalTitle" size="lg" @hidden="editingAnswer.body = ''">
        <UpdateAnswer :answer="editingAnswer" @success="hideModal" v-if="editingAnswer.body" />
    </Modal>
</template>