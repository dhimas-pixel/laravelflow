<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    answer: {
        type: Object,
        required: true
    }
})

const form = useForm({
    body: props.answer.body
})

const emit = defineEmits(['success'])

const submit = () => {
    form.put(route('questions.answers.update', [props.answer.question_id, props.answer.id]), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit('success')
        }
    })
}
</script>

<template>
    <form @submit.prevent="submit">
        <div class="mb-3">
            <label for="answer-body" class="form-label">Update your answer</label>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#write" type="button"
                                role="tab" href="#">Write</a>
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
        </div>
        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</template>