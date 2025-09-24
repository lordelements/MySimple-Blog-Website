<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="relative isolate overflow-hidden bg-slate-50">
    <!-- Background Gradient -->
    <div class="absolute inset-x-0 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#94a3b8] to-[#1e293b] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="mx-auto max-w-7xl py-32 px-6 lg:py-48 lg:px-8 relative z-10 text-center">
      <h1 class="text-5xl font-extrabold tracking-tight text-balance text-gray-900 sm:text-7xl lg:text-8xl">Welcome to Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Dev Blog</span></h1>
      <p class="mt-8 text-lg font-medium text-pretty text-gray-600 sm:text-xl/8 max-w-3xl mx-auto">Whether you're just getting started or deepening your skills, our blog is your guide to all things HTML, CSS, JavaScript, frameworks, and more. Learn by doing — through practical tutorials, real-world projects, and expert insights.</p>
      
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <Link
          class="rounded-full bg-blue-600 px-8 py-3 text-lg font-semibold text-white shadow-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105"
          href="#"
        >
          Start Learning
        </Link>
        <Link
          :href="route('posts.index')"
          class="rounded-full px-8 py-3 text-lg font-semibold text-blue-700 ring-1 ring-inset ring-blue-700 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105"
        >
          View Latest Articles →
        </Link>
      </div>
    </div>
  </div>
</template>
