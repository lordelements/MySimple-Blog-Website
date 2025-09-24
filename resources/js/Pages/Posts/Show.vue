<script setup>
import { usePage, Link, useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
    post: Object,
    comments: Array,
})

const authUser = usePage().props.auth.user

const isAdmin = computed(() => {
    return authUser && authUser.role === 'admin'
})

const form = useForm({
    post_id: props.post.id,
    body: '',
})

function submit() {
    form.post(route('comments.store'), {
        onSuccess: () => form.reset('body'),
    })
}

// Check if the content contains HTML-like tags to determine if it's code
const isCodeContent = computed(() => {
    return props.post.content.includes('<') || props.post.content.includes('>');
});

// Computed property to display code as text
// Replace HTML characters with their escaped equivalents
const escapedContent = computed(() => {
    if (props.post.content) {
      
        return props.post.content
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }
    return '';
});

// Computed property to format normal text with paragraphs
const formattedContent = computed(() => {
    if (props.post.content) {
        return props.post.content
            .split('\n')
            .map(paragraph => `<p class="text-gray-700 leading-relaxed mb-6">${paragraph}</p>`)
            .join('');
    }
    return '';
});

const isVideo = computed(() => {
    if (!props.post.filename) return false;
    const extension = props.post.filename.split('.').pop().toLowerCase();
    return ['mp4', 'mov', 'avi', 'wmv'].includes(extension);
})

const fileUrl = computed(() => {
    return `/storage/posts_uploads/${props.post.filename}`;
})

function getVideoMimeType(filename) {
    const extension = filename.split('.').pop().toLowerCase();
    switch (extension) {
        case 'mp4': return 'video/mp4';
        case 'mov': return 'video/quicktime';
        case 'avi': return 'video/x-msvideo';
        case 'wmv': return 'video/x-ms-wmv';
        default: return '';
    }
}

function getPlaceholderImage(id) {
    return `https://placehold.co/600x400/039487/ffffff?text=Post+${id}`;
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-16 bg-slate-100 min-h-screen">
            <div class="max-w-4xl mx-auto">
                <!-- Post Card Section -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8">
                    <div v-if="post.filename" class="mb-8 rounded-2xl overflow-hidden">
                        <video v-if="isVideo" controls class="w-full">
                            <source :src="fileUrl" :type="getVideoMimeType(post.filename)" />
                            Your browser does not support the video tag.
                        </video>
                        <img v-else :src="fileUrl" :alt="post.title" class="w-full object-cover">
                    </div>
                    <div v-else class="mb-8 rounded-2xl overflow-hidden">
                        <img :src="getPlaceholderImage(post.id)" :alt="post.title" class="w-full object-cover">
                    </div>

                    <!-- Post Header -->
                    <div class="flex flex-col mb-6">
                        <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-2">{{ post.title }}</h1>
                        <p class="text-sm font-medium text-gray-500">
                            By <span class="text-gray-700 font-semibold">{{ post.user?.name }}</span>
                            <span class="mx-1">•</span>
                            {{ new Date(post.created_at).toLocaleString('en-US', { dateStyle: 'long', timeStyle: 'short' }) }}
                        </p>
                    </div>

                    <!-- Post Content with Conditional Formatting -->
                    <div class="my-6">
                        <!-- Display as code block if it contains HTML/code -->
                        <div v-if="isCodeContent">
                            <pre class="bg-gray-800 text-white p-6 rounded-xl font-mono text-sm overflow-x-auto whitespace-pre-wrap"><code v-html="escapedContent"></code></pre>
                        </div>
                        <!-- Otherwise, display as a normal text document -->
                        <div v-else v-html="formattedContent"></div>
                    </div>

                    <!-- Admin Links -->
                    <div v-if="isAdmin" class="mt-6 pt-4 border-t border-gray-200">
                        <Link :href="`/posts/${post.id}/edit`"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200">
                            Edit Post
                        </Link>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="bg-white rounded-3xl shadow-2xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-4">Comments ({{ comments.length }})</h3>

                    <div v-if="comments.length" class="space-y-8">
                        <div v-for="comment in comments" :key="comment.id" class="flex items-start gap-4 pb-4 last:pb-0">
                            <!-- User Avatar -->
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover" src="https://placehold.co/40x40/cbd5e1/4b5563?text=U" :alt="comment.user?.name">
                            </div>
                            <!-- Comment Content -->
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <p class="font-semibold text-gray-900">{{ comment.user?.name }}</p>
                                    <p class="text-xs text-gray-400">
                                        {{ new Date(comment.created_at).toLocaleString('en-US', { dateStyle: 'short', timeStyle: 'short' }) }}
                                    </p>
                                </div>
                                <p class="text-gray-700 mt-1">{{ comment.body }}</p>
                            </div>
                        </div>
                    </div>
                    <p v-else class="text-gray-500 italic">No comments yet. Be the first to add one!</p>

                    <!-- Add Comment Form -->
                    <div v-if="authUser" class="mt-8 pt-6 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Add a Comment</h4>
                        <form @submit.prevent="submit" class="space-y-4">
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
                                class="inline-flex justify-center items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
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
        </div>
    </AuthenticatedLayout>
</template>
