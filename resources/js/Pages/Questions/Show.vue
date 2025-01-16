<script setup>
import { Head, router } from '@inertiajs/vue3';
import Answers from '../../Components/Answer/Answers.vue';
import CreateAnswer from '../../Components/Answer/CreateAnswer.vue';
import Author from '../../Components/Author.vue';
import AppLayout from '../../Layouts/AppLayout.vue';

const props = defineProps({
    question: {
        type: Object,
        required: true
    },
    answers: {
        type: Object,
        required: true
    }
})

const bookmark = () => {
    if (props.question.is_bookmarked) {
        router.delete(route('questions.bookmark.destroy', props.question.id), {
            preserveScroll: true,
        })
    } else {
        router.post(route('questions.bookmark.store', props.question.id), {}, {
            preserveScroll: true,
        })
    }
}
</script>

<template>

    <Head :title="question.title" />

    <AppLayout>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-bottom pb-3 mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h1 class="question-title">{{ question.title }}</h1>
                            <a href="index.html" class="btn btn-outline-secondary">All Questions</a>
                        </div>
                        <div class="d-flex question-meta">
                            <div class="me-3">
                                <span class="text-muted">Asked </span>
                                <time :datetime="question.created_at.machine">{{ question.created_at.human
                                    }}</time>
                            </div>
                            <div class="me-3">
                                <span class="text-muted">Modified</span> {{ question.updated_at.human }}
                            </div>
                            <div>
                                <span class="text-muted">Viewed</span> {{ question.views_count }} times
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="question-content post-item">
                        <div class="vote-col">
                            <div class="d-flex flex-column align-items-center">
                                <button title="This post is useful" class="btn btn-outline-secondary btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                                    </svg>
                                </button>
                                <div class="votes-count">1</div>
                                <button title="This post is not useful" class="btn btn-outline-secondary btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                    </svg>
                                </button>
                                <button title="Bookmark the post" class="btn text-secondary"
                                    :class="{ 'question-bookmarked': question.is_bookmarked }" @click="bookmark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="post-col actionable">
                            <div class="question-body" v-html="question.body">
                            </div>
                            <div class="d-flex justify-content-between align-items start py-3">
                                <ul class="tags-inline">
                                    <li><a href="#" class="tag">PHP</a></li>
                                    <li><a href="#" class="tag">Laravel</a></li>
                                    <li><a href="#" class="tag">OOP</a></li>
                                </ul>
                                <Author :user="question.user" :post-at="question.created_at" :is-answer="false" />
                            </div>
                            <div class="post-action">
                                <div class="d-flex gap-1 justify-content-center align-items-center">
                                    <button class="btn btn-sm btn-circle shadow text-white btn-secondary me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm btn-circle shadow btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <Answers :answers="answers" />

                    <CreateAnswer :question="question" />
                </div>
                <div class="col-md-3">
                    <h3 class="fs-5 mb-3">Related</h3>
                    <div class="related">
                        <div class="related-item">
                            <a href="#">
                                <div class="answer-votes">5</div>
                            </a>
                            <a href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias,
                                dignissimos!</a>
                        </div>
                        <div class="related-item">
                            <a href="#">
                                <div class="answer-votes">3</div>
                            </a>
                            <a href="#">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                        </div>
                        <div class="related-item">
                            <a href="#">
                                <div class="answer-votes answer-accepted">9</div>
                            </a>
                            <a href="#">Lorem ipsum dolor sit amet.</a>
                        </div>
                        <div class="related-item">
                            <a href="#">
                                <div class="answer-votes">7</div>
                            </a>
                            <a href="#">Lorem ipsum dolor sit amet.</a>
                        </div>
                    </div>

                    <h3 class="fs-5 mt-5">Tags</h3>
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
    </AppLayout>
</template>