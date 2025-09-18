<script setup>
import { computed } from 'vue';

const props = defineProps({
    pagination: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(['page-changed']);

// Emit the page number to the parent component when a link is clicked
const changePage = (page) => {
    emit('page-changed', page);
};

// Generates the array of pages to display, with ellipsis
const pages = computed(() => {
    const pagesArray = [];
    const { current_page, last_page, per_page, total } = props.pagination;

    // Show a limited number of pages around the current page
    let start = Math.max(1, current_page - 2);
    let end = Math.min(last_page, current_page + 2);

    if (start > 1) {
        pagesArray.push(1);
        if (start > 2) {
            pagesArray.push('...');
        }
    }

    for (let i = start; i <= end; i++) {
        pagesArray.push(i);
    }

    if (end < last_page) {
        if (end < last_page - 1) {
            pagesArray.push('...');
        }
        pagesArray.push(last_page);
    }
    
    return pagesArray;
});
</script>

<template>
    <div class="flex items-center justify-center space-x-2 mt-8">
        <!-- Previous Button -->
        <button
            @click="changePage(pagination.current_page - 1)"
            :disabled="pagination.current_page === 1"
            class="px-4 py-2 text-sm font-medium rounded-md border transition-colors duration-200"
            :class="{
                'bg-gray-200 text-gray-500 cursor-not-allowed': pagination.current_page === 1,
                'bg-white text-gray-700 hover:bg-gray-100 border-gray-300': pagination.current_page !== 1,
            }"
        >
            Previous
        </button>

        <!-- Page Number Links -->
        <div class="flex space-x-1">
            <template v-for="(page, index) in pages" :key="index">
                <span v-if="page === '...'" class="px-3 py-2 text-gray-500">...</span>
                <button
                    v-else
                    @click="changePage(page)"
                    class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200"
                    :class="{
                        'bg-blue-600 text-white': page === pagination.current_page,
                        'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300': page !== pagination.current_page,
                    }"
                >
                    {{ page }}
                </button>
            </template>
        </div>

        <!-- Next Button -->
        <button
            @click="changePage(pagination.current_page + 1)"
            :disabled="pagination.current_page === pagination.last_page"
            class="px-4 py-2 text-sm font-medium rounded-md border transition-colors duration-200"
            :class="{
                'bg-gray-200 text-gray-500 cursor-not-allowed': pagination.current_page === pagination.last_page,
                'bg-white text-gray-700 hover:bg-gray-100 border-gray-300': pagination.current_page !== pagination.last_page,
            }"
        >
            Next
        </button>
    </div>
</template>
