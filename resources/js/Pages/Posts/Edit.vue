<template>
    <Head title="Edit" />
    <AuthenticatedLayout>
        <div class="p-6 bg-gray-100 min-h-screen flex items-center justify-center">
            <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
                <div class="mb-6 border-b border-gray-200 pb-4">
                    <h1 class="text-3xl font-bold text-gray-800">Edit Post</h1>
                    <p class="text-gray-500 mt-1">Update the details of your post and click save.</p>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-1">File</label>
                        <input type="file" @change="handleFileChange" name="file" accept="image/*,video/*" id="file"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
                        />
                        <div v-if="form.errors.file" class="text-red-500 mt-2 text-sm">{{ form.errors.file }}</div>
                    </div>
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input
                            id="title"
                            v-model="form.title"
                            placeholder="Enter a compelling title..."
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
                        />
                        <div v-if="form.errors.title" class="text-red-500 mt-2 text-sm">{{ form.errors.title }}</div>
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
                        <div v-if="form.errors.content" class="text-red-500 mt-2 text-sm">{{ form.errors.content }}</div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <Link href="/posts" class="text-gray-600 hover:text-gray-900 font-medium transition duration-150 ease-in-out">
                            Cancel
                        </Link>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                        >
                            <span v-if="form.processing">Updating...</span>
                            <span v-else>Update Post</span>
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
import { useForm, Link } from '@inertiajs/vue3'
import { router } from '@inertiajs/core';

const props = defineProps({
    post: Object
})

const form = useForm({
    title: props.post.title,
    content: props.post.content,
    file: null,
    _method: 'put',
});

function handleFileChange(event) {
    form.file = event.target.files[0];
}

// Correctly handle file upload with a PUT request by using POST and a _method field.
function submit() {
    form.post(route('posts.update', props.post.id), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => router.visit(route('posts.index')),
        onError: () => console.error('Error:', form.errors),
    });
}


</script>
