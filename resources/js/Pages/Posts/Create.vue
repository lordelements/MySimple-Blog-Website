<template>
    <AuthenticatedLayout>
      <Head title="Create Posts" />
      <div class="p-6 bg-gray-100 min-h-screen flex items-center justify-center">
          <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
          <div class="mb-6">
              <h1 class="text-3xl font-bold text-gray-800">Create New Post</h1>
              <p class="text-gray-500 mt-1">Fill out the form below to create a new post.</p>
          </div>
          <form @submit.prevent="submit" class="space-y-6">
              <div>
              <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
              <input
                  id="title"
                  v-model="form.title"
                  placeholder="Enter a compelling title..."
                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
              />
              </div>
              <div>
              <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
              <textarea
                  id="content"
                  v-model="form.content"
                  rows="8"
                  placeholder="Write your post content here..."
                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out resize-none"
              ></textarea>
              </div>
              <div class="flex justify-end pt-4">
              <button
                  type="submit"
                  :disabled="form.processing"
                  class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out"
              >
                  <span v-if="form.processing">Saving...</span>
                  <span v-else>Save Post</span>
              </button>
              </div>
          </form>
          </div>
      </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  title: '',
  content: ''
});

function submit() {
  form.post('/posts');
}
</script>