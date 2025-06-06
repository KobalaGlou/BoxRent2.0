<script setup>
import { computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { usePage } from '@inertiajs/vue3'

defineOptions({
    layout: AuthenticatedLayout
})

const page = usePage()
const user = computed(() => page.props.auth.user)

</script>

<template>
    <section class=" flex flex-col justify-center items-center bg-white text-gray-900 px-4" style="min-height: 30vh;">
      
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
