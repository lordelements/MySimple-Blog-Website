<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Posts from '@/Components/sections/Posts.vue';
import Aboutus from '@/Components/sections/Aboutus.vue';
import HeroSection from '@/Components/sections/HeroSection.vue';
import Footer from '@/Components/sections/Footer.vue';
import ContactUs from '@/Components/sections/Contactus.vue';
import PostCard from '@/Components/PostCard.vue'

defineProps({
    posts: Object,
})
</script>

<template>
    <AuthenticatedLayout>

        <div class="bg-white-950 min-h-screen text-white font-sans antialiased">
            <main class="space-y-24 py-1">
                <!-- Hero Section -->
                <HeroSection />

                <!-- Content Section -->
                <!-- <div class="max-w-[80rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                    <Posts class="mt-4" :posts="posts" />
                </div> -->

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <h2 class="text-2xl text-gray-900 font-bold mb-4">Latest Posts</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <PostCard v-for="post in posts.data" :key="post.id" :post="post"
                            class="bg-white rounded-lg shadow hover:shadow-md transition p-6" />
                    </div>
                </div>

                <!-- Separator -->
                <hr class="my-24 border-gray-800" />

                <!-- About Us Section -->
                <Aboutus />

                <!-- Contact Us Section -->
                <ContactUs />

                <!-- Separator -->
                <hr class="my-24 border-gray-800" />
                <Footer />
            </main>
        </div>
    </AuthenticatedLayout>

</template>

<style scoped>
/* You can add custom styles here if needed, or use Tailwind classes directly in the template. /
/ Example: /
/ .posts-section { /
/ @apply pt-16; /
/ } */
</style>