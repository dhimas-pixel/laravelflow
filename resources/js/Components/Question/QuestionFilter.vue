<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    filter: {
        type: String,
    }
})
</script>

<template>
    <ul class="nav nav-underline flex-column mt-4">
        <li class="nav-item">
            <Link class="nav-link" :class="{ active: filter === 'latest' }" aria-current="page" href="/?filter=latest">
            Latest</Link>
        </li>
        <li class="nav-item">
            <Link class="nav-link" :class="{ active: filter === 'unanswered' }" href="/?filter=unanswered">Unanswered
            </Link>
        </li>
        <li class="nav-item">
            <Link class="nav-link" :class="{ active: filter === 'scored' }" href="/?filter=scored">Scored</Link>
        </li>
        <li class="nav-item" v-if="$page.props.user">
            <Link class="nav-link" :class="{ active: filter === 'mine' }" href="/?filter=mine">Mine</Link>
        </li>
    </ul>
</template>