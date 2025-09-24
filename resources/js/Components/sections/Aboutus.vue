<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <section class="bg-gray-50 py-24">
        <div class="mx-auto max-w-7xl px-4 md:px-5 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-16 lg:grid-cols-2">

                <!-- Text Column -->
                <div class="space-y-8 text-center lg:text-left">
                    <div class="inline-block rounded-full bg-blue-100 px-4 py-1.5 text-sm font-semibold text-blue-700">
                        About Us
                    </div>
                    <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                        Empowering Developers to Share, Learn, and Grow Together
                    </h2>
                    <p class="text-lg text-gray-600">
                        Our web development blog is built by developers, for developers. We believe in the power of open
                        knowledge, sharing real-world coding experiences, and fostering a supportive tech community. Whether
                        you're just starting out or scaling complex systems, we're here to grow with you—one post at a time.
                    </p>
                    <Link href="#"
                        class="inline-block rounded-full bg-blue-600 px-8 py-3 text-lg font-semibold text-white shadow-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                    Join the Community
                    </Link>
                </div>

                <!-- Image Column -->
                <div class="relative flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-lg rounded-3xl p-4 shadow-2xl bg-white lg:p-6">
                        <img class="w-full rounded-2xl object-cover"
                            src="https://pagedone.io/asset/uploads/1717751272.png" alt="About Us - Web Dev Blog" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
