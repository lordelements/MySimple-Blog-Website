<script setup>
import PostCard from '@/Components/PostCard.vue'

defineProps({
  posts: Array,
  required: true
})
</script>

<template>
  <div>
    <h2 class="text-2xl text-gray-900 font-bold mb-4">Latest Posts</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <PostCard
        v-for="post in posts"
        :key="post.id"
        :post="post"
        class="bg-white rounded-lg shadow hover:shadow-md transition p-6"
      />
    </div>
  </div>
</template>
