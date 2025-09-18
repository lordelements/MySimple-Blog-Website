<script setup>
import { usePage, Link, useForm } from '@inertiajs/vue3'
import { computed } from 'vue' 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
  post: Object,
  comments: Array,
})

const authUser = usePage().props.auth.user

// Inertia form
const form = useForm({
  post_id: props.post.id,
  body: '',
})

function submit() {
  form.post(route('comments.store'), {
    onSuccess: () => form.reset('body'),
  })
}

// Compute the formatted content for paragraphs
const formattedContent = computed(() => {
  if (props.post.content) {
    // Split content by line breaks and create paragraphs
    return props.post.content
      .split('\n')
      .map(paragraph => `<p class="text-gray-700 leading-relaxed mb-6">${paragraph}</p>`)
      .join('')
  }
  return ''
})
</script>

<template>
  <AuthenticatedLayout>
    <div class="py-12 max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ post.title }}</h1>

        <!-- Render formatted content as HTML -->
        <div v-html="formattedContent"></div>

        <p class="text-sm text-gray-500 font-medium">
          By <span class="text-gray-700">{{ post.user?.name }}</span>
          <span class="mx-1">•</span>
          {{ new Date(post.created_at).toLocaleString('en-US', { dateStyle: 'long', timeStyle: 'short' }) }}
        </p>
      </div>

      <div class="bg-white rounded-2xl shadow-xl p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-4">Comments ({{ comments.length }})</h3>

        <div v-if="comments.length" class="space-y-6">
          <div v-for="comment in comments" :key="comment.id" class="border-b last:border-b-0 pb-4 last:pb-0">
            <p class="text-gray-800 leading-snug mb-1">{{ comment.body }}</p>
            <p class="text-sm text-gray-500 font-medium">
              By <span class="text-gray-700">{{ comment.user?.name }}</span>
              <span class="mx-1">•</span>
              {{ new Date(comment.created_at).toLocaleString('en-US', { dateStyle: 'long', timeStyle: 'short' }) }}
            </p>
          </div>
        </div>
        <p v-else class="text-gray-500 italic">No comments yet. Be the first to add one!</p>

        <div v-if="authUser" class="mt-8 pt-6 border-t border-gray-200">
          <h4 class="text-lg font-semibold text-gray-900 mb-4">Add a Comment</h4>
          <form @submit.prevent="submit">
            <input type="hidden" v-model="form.post_id" />
            <textarea
              v-model="form.body"
              rows="4"
              class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
              placeholder="Share your thoughts..."
            ></textarea>
            <button
              type="submit"
              :disabled="form.processing"
              class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              Post Comment
            </button>
          </form>
        </div>
        <div v-else class="text-gray-600 mt-6 text-center italic">
          <Link :href="route('login')" class="text-blue-600 hover:underline font-semibold">
            Login
          </Link> to post a comment.
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
