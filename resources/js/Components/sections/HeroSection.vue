<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <!-- <section class="relative min-h-screen bg-gradient-to-r from-green-600 to-indigo-700 text-white shadow-lg overflow-hidden">
    <div class="px-20 py-24 text-center sm:px-12 lg:px-20">
      <h1 class="text-4xl sm:text-5xl font-extrabold mb-4">
        Welcome to Our Blog
      </h1>
      <p class="text-lg sm:text-xl text-gray-100 max-w-2xl mx-auto mb-6">
        Discover stories, tutorials, and insights shared by our amazing community.
        Stay connected, stay inspired.
      </p>
      <div class="flex justify-center gap-4">
        <Link
          :href="route('posts.index')"
          class="px-6 py-3 bg-white text-blue-700 font-semibold rounded-lg shadow hover:bg-gray-100 transition"
        >
          Browse Posts
        </Link>
        <Link
          :href="route('posts.create')"
          class="px-6 py-3 bg-indigo-500 text-white font-semibold rounded-lg shadow hover:bg-indigo-600 transition"
        >
          Create Post
        </Link>
      </div>
    </div>
  </section> -->

  <div class="bg-gray-300">
    <div class="relative isolate px-1 lg:px-8 min-h-screen flex items-center">
      <div class="mx-auto max-w-2xl text-center">
        <h1 class="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">Welcome to Our Blog</h1>
        <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">Whether you're just getting started or deepening your skills, our blog is your guide to all things
           HTML, CSS, JavaScript, frameworks,
           and more. Learn by doing — through practical tutorials, real-world projects, and expert insights.</p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <!-- <Link :href="route('posts.create')"
            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
          Create Post
          </Link> -->
          <Link
            class="rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
          Start Learning
          </Link>
          <Link :href="route('posts.index')"
            class="rounded-md shadow px-6 py-3 bg-white text-blue-700 font-semibold hover:bg-gray-100 transition">
          View Latest Articles →
          </Link>
        </div>
      </div>

      <div aria-hidden="true"
        class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
        <div style="clip-path: polygon(74.1% 44.1%)" class="relative left-[calc(50%+3rem)] ..."></div>
      </div>
    </div>
  </div>
</template>
