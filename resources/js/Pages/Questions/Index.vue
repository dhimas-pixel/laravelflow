<template>
    <AppLayout>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="page-header">All Questions</h1>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <QuestionSummary v-for="question in questions.data" :key="question.id" :question="question"
                                @edit="editQuestion" />
                        </ul>
                    </div>

                    <Pagination :meta="questions.meta" />
                </div>
                <div class="col-md-3">
                    <div class="d-grid">
                        <button class="btn btn-primary" @click="askQuestion">Ask
                            Question</button>
                    </div>

                    <ul class="nav nav-underline flex-column mt-4">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Latest</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Unanswered</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Scored</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mine</a>
                        </li>
                    </ul>
                    <h2 class="fs-5 mt-5">Related Tags</h2>
                    <ul class="tags-list mt-3">
                        <li><a href="#" class="tag mb-2">Javascript</a></li>
                        <li><a href="#" class="tag mb-2">JQuery</a></li>
                        <li><a href="#" class="tag mb-2">Vue.js</a></li>
                        <li><a href="#" class="tag mb-2">React.js</a></li>
                        <li><a href="#" class="tag mb-2">Inertia.js</a></li>
                        <li><a href="#" class="tag mb-2">PHP</a></li>
                        <li><a href="#" class="tag mb-2">Laravel</a></li>
                        <li><a href="#" class="tag mb-2">Bootstrap</a></li>
                        <li><a href="#" class="tag mb-2">Tailwind</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <Modal id="question-modal" :title="state.modalTitle" size="lg" scrollable @hidden="resetQuestion">
            <component :is="editing ? EditQuestionForm : CreateQuestionForm" :question="question"
                @success="hideModal" />
        </Modal>
    </AppLayout>
    <!-- <h1>Welcome!</h1>

    <div v-for="question in questions" :key="question.id">
        <Link :href="route('questions.show', question.id)">
        {{ question.title }}
        </Link>
    </div> -->

    <Head title="All Questions" />
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';
import Modal from '../../Components/Modal.vue';
import Pagination from '../../Components/Pagination.vue';
import CreateQuestionForm from '../../Components/Question/CreateQuestionForm.vue';
import EditQuestionForm from '../../Components/Question/EditQuestionForm.vue';
import QuestionSummary from '../../Components/Question/QuestionSummary.vue';
import AppLayout from '../../Layouts/AppLayout.vue';

defineProps({
    questions: {
        type: Object,
        required: true
    }
})

const state = reactive({
    modalRef: null,
    modalTitle: 'Ask Question',
})

const question = reactive({
    title: null,
    body: null,
    id: null
})

const editing = ref(false)

onMounted(() => {
    state.modalRef = new bootstrap.Modal('#question-modal', {
        backdrop: 'static',
        keyboard: false
    })
})

const showModal = () => {
    state.modalRef.show()
}

const hideModal = () => {
    state.modalRef.hide()
}

const editQuestion = (payload) => {
    editing.value = true
    state.modalTitle = `Edit Question`

    question.id = payload.id
    question.title = payload.title
    question.body = payload.body
    showModal()
}

const askQuestion = () => {
    question.id = null
    question.title = null
    question.body = null

    editing.value = false
    state.modalTitle = 'Ask Question'

    showModal()
}

const resetQuestion = () => {
    question.id = null
    question.title = null
    question.body = null

    editing.value = false
}
</script>