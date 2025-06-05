<script setup>
import { computed } from 'vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { usePage } from '@inertiajs/vue3'

defineOptions({
    layout: GuestLayout
})

const page = usePage()
const user = computed(() => page.props.auth.user)

// Debug pour voir ce que Vue reçoit
console.log('Welcome.vue - Props auth:', page.props)
</script>

<template>
    <section class="min-h-screen flex flex-col justify-center items-center bg-white text-gray-900 px-4">
      <!-- Debug visuel -->
      <div class="mb-4 p-4 bg-gray-100 rounded">
      </div>
      
      <div class="max-w-2xl text-center">
        <h1 class="text-4xl font-extrabold mb-4">Bienvenue sur votre tableau de bord</h1>
        <p class="text-lg text-gray-600 mb-6">
          Gérez vos box, locataires, contrats et bien plus encore depuis une interface simple et intuitive.
        </p>
        <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg shadow">
          Commencer
        </a>
      </div>
    </section>
</template>