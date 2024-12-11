<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { onMounted, reactive } from 'vue';
import Navbar from '../Components/Navbar.vue';
import Toast from '../Components/Toast.vue';

const state = reactive({
    toastReff: null,
    toastMessage: ''
})

const page = usePage()

router.on('finish', () => {
    state.toastMessage = page.props.toast.success

    showToast()
})

onMounted(() => {
    state.toastReff = new bootstrap.Toast('#app-toast', {
        delay: 3000
    })
})

const showToast = () => {
    state.toastReff.show()
}

</script>

<template>
    <Navbar />
    <main class="py-4">
        <slot />
    </main>

    <Toast id="app-toast" :message="state.toastMessage" />
</template>