<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    'question': {
        type: Object,
        required: true
    }
})

const form = useForm({
    body: null
})

const submit = () => {
    form.post(route('questions.answers.store', props.question.id), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        }
    })
}
</script>

<template>
    <h2 class="mt-4 answer-header">Your answer</h2>
    <form @submit.prevent="submit">
        <div class="card mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#write" type="button" role="tab"
                            href="#">Write</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#preview" type="button"
                            role="tab">Preview</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="write" role="tabpanel" aria-labelledby="write-tab"
                        tabindex="0">
                        <textarea rows="7" class="form-control" :class="{ 'is-invalid': form.errors.body }"
                            v-model="form.body"></textarea>
                        <div class="invalid-feedback" v-if="form.errors.body">
                            {{ form.errors.body }}
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="preview" role="tabpanel" aria-labelledby="preivew-tab"
                        tabindex="0">
                        <div class="preview-body">hi there</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-outline-primary" type="submit">Post your answer</button>
        </div>
    </form>
</template>