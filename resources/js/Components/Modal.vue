<script setup>
import { computed, onMounted, ref } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: true
    },

    size: {
        type: String,
        default: ''
    },
    scrollable: {
        type: Boolean,
        default: false
    }
})

const classes = computed(() => {
    return {
        'modal-dialog': true,
        'modal-lg': props.size === 'lg',
        'modal-xl': props.size === 'xl',
        'modal-sm': props.size === 'sm',
        'modal-dialog-scrollable': props.scrollable
    }
})

const modalRef = ref(null)

const emit = defineEmits(['hidden'])

onMounted(() => {
    modalRef.value.addEventListener('hidden.bs.modal', event => {
        emit('hidden')
    })
})
</script>

<template>
    <div class="modal fade" ref="modalRef" tabindex="-1" aria-labelledby="new-question-modal-label" aria-hidden="true">
        <div :class="classes">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="new-question-modal-label">{{ title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <slot />
                </div>
                <div class="modal-footer" v-if="$slots.footer">
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </div>
</template>