<script setup>
import { Link } from '@inertiajs/vue3';
import ActionButton from '../ActionButton.vue';

defineProps({
    question: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(['edit', 'remove'])
</script>

<template>
    <li class="list-group-item">
        <div class="post-item question-summary">
            <div class="question-summary-stats">
                <div class="stats-item vote"><strong>{{ question.votes_count }}</strong> vote</div>
                <div class="stats-item status has-answers"><strong>{{ question.answers_count }}</strong> answer</div>
                <div class="stats-item view">
                    {{ question.views_count }} views
                </div>
            </div>
            <div class="question-summary-content actionable">
                <div class="d-flex align-items-center">
                    <h3 class="mt-0 question-summary-title">
                        <Link :href="route('questions.show', question.slug)">
                        {{ question.title }}
                        </Link>
                    </h3>
                    <div class="ml-auto"></div>
                </div>
                <div class="excerpt">{{ question.summary }}</div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <ul class="tags-inline">
                        <li><a href="#" class="tag">PHP</a></li>
                        <li><a href="#" class="tag">Laravel</a></li>
                        <li><a href="#" class="tag">OOP</a></li>
                    </ul>
                    <div class="question-summary-author">
                        <a href="#" class="avatar-sm">
                            <img :src="question.user.avatar_url" size="16" alt="" srcset="">
                            {{ question.user.name }}
                        </a>
                        <span class="text-muted"> asked <time :datetime="question.created_at.machine">{{
                            question.created_at.human }}</time></span>
                    </div>
                </div>
                <ActionButton @edit="emit('edit', question)" />
            </div>
        </div>
    </li>
</template>