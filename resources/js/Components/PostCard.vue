<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const { post } = defineProps({
  post: {
    type: Object,
    required: true,
  },
})


const authUser = usePage().props.auth.user

// Use a computed property to determine if the authenticated user is an admin
const isAdmin = computed(() => {
    return authUser && authUser.role === 'admin'
})

// Function to generate a placeholder image URL based on a post's unique ID.
const getPlaceholderImage = (id) => {
    return `https://placehold.co/600x400/039487/ffffff?text=Post+${id}`;
}

// Correctly determine if the file is a video
const isVideo = computed(() => {
  if (!post.filename) return false;
  const extension = post.filename.split('.').pop().toLowerCase();
  return ['mp4', 'mov', 'avi', 'wmv'].includes(extension);
});

const fileUrl = computed(() => {
  return post.file_url || null;
});


// Function to get the correct MIME type for the video
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
</script>

<template>
    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 mt-4">
        <!-- Post Media -->
        <figure class="relative w-full">
            <div v-if="post.filename">
                <template v-if="isVideo">
                    <video controls class="w-full h-auto rounded-t-2xl shadow">
                        <!-- <source :src="fileUrl" :type="getVideoMimeType(post.filename)" /> -->
                         <source :src="fileUrl" :type="getVideoMimeType(post.filename)" />
                        Your browser does not support the video tag.
                    </video>
                </template>
                <template v-else>
                    <img :src="fileUrl" class="object-cover w-full h-48 rounded-t-2xl shadow" :alt="post.title" />
                </template>
            </div>
            <div v-else>
                <!-- Placeholder if no file is uploaded -->
                <img :src="getPlaceholderImage(post.id)" :alt="post.title" class="object-cover w-full h-48 rounded-t-2xl shadow" />
            </div>
        </figure>

        <!-- Post Content -->
        <div class="p-6 space-y-4 gap-8">
            <div class="flex items-center justify-between mb-2">
                <h5 class="text-xl font-bold text-gray-900 line-clamp-2">
                    {{ post.title }}
                </h5>
            </div>

            <p class="text-gray-600 line-clamp-3">
                {{ post.content }}
            </p>

            <!-- Post Meta and Actions -->
            <div class="pt-2 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <!-- Meta Info -->
                    <div class="flex items-center gap-4 text-sm text-gray-500">
                        <span class="font-medium">
                            <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ new Date(post.created_at).toLocaleString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })
                            }}
                        </span>
                        <span class="font-medium">
                            <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            {{ post.comments?.length || 0 }} Comments
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 items-center">
                        <Link :href="`/posts/${post.id}`"
                            class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors duration-200">
                        Read More
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.5 14.5l4.5-4.5-4.5-4.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 10H2" />
                        </svg>
                        </Link>

                        <!-- Only show these links if the user is an admin -->
                        <template v-if="isAdmin">
                            <Link :href="`/posts/${post.id}/edit`"
                                class="text-gray-600 hover:text-gray-900 font-medium transition-colors">
                            Edit
                            </Link>
                            <Link :href="`/posts/${post.id}`" method="delete" as="button"
                                class="text-red-500 hover:text-red-700 font-medium transition-colors">
                            Delete
                            </Link>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
