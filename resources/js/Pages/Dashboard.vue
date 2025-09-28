<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import HeroSection from '@/Components/sections/HeroSection.vue';
import Aboutus from '@/Components/sections/Aboutus.vue';
import ContactUs from '@/Components/sections/Contactus.vue';
import Footer from '@/Components/sections/Footer.vue';
import PostCard from '@/Components/PostCard.vue';

defineProps({
  posts: {
    type: Object,
    required: true,
  }
});
</script>

<template>
  <AuthenticatedLayout>
    <main class="space-y-24 py-1">
      <HeroSection />

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl text-gray-900 font-bold mb-4">Latest Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <PostCard v-for="post in posts.data" :key="post.id" :post="post" />
        </div>
        
        <div class="mt-8 flex justify-center">
            <a 
                :href="route('posts.index')"
                class="
                    inline-flex items-center 
                    px-6 py-3 
                    border border-transparent 
                    text-base font-medium 
                    rounded-lg 
                    shadow-md 
                    text-white 
                    bg-blue-600 
                    hover:bg-blue-700 
                    focus:outline-none 
                    focus:ring-2 
                    focus:ring-offset-2 
                    focus:ring-blue-500
                    transition ease-in-out duration-150
                "
            >
                See all posts 
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.5 14.5l4.5-4.5-4.5-4.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 10H2" />
                </svg>
            </a>
        </div>
      </div>

      <hr class="my-24 border-gray-800" />
      <Aboutus />
      <ContactUs />
      <hr class="my-24 border-gray-800" />
      <Footer />
    </main>
  </AuthenticatedLayout>
</template>
