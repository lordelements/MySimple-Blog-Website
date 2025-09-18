<script setup>
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PostCard from '@/Components/PostCard.vue';
import Pagination from '@/Components/Pagination.vue';

const { posts } = defineProps({
    posts: Object,
});

function changePage(page) {
    if (page < 1 || page > posts.last_page) return;

    router.get(route('posts.index'), { page });
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold mb-6">All Posts</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <PostCard v-for="post in posts.data" :key="post.id" :post="post" />
            </div>
            
            <!-- Use the new Pagination component here -->
            <Pagination 
                :pagination="posts" 
                @page-changed="changePage" 
                class="mt-8"
            />
        </div>
    </AuthenticatedLayout>
</template>
