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
      </div>

      <hr class="my-24 border-gray-800" />
      <Aboutus />
      <ContactUs />
      <hr class="my-24 border-gray-800" />
      <Footer />
    </main>
  </AuthenticatedLayout>
</template>
