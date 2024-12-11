<script setup>
defineProps({
    id: {
        type: String,
        required: true
    },
    message: {
        type: String,
        default: ''
    }
})
</script>

<template>
    <div class="sticky-bottom">
        <div class="toast-container bottom-0 end-0 m-3" v-show="message">
            <div class="toast align-items-center text-bg-success border-0" :id="id" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ message }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</template>