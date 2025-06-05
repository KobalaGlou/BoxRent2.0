<script setup>
import { Link, usePage, router } from '@inertiajs/vue3'
import { computed } from 'vue'
import Box from '@/Components/Partials/Entries/Box.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
  boxs: Array,
  success: String
})

defineOptions({
    layout: AuthenticatedLayout
})

const hasBoxs = computed(() => props.boxs.length > 0)
</script>

<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <!-- Message de succès -->
      <div v-if="success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <strong class="font-bold">Succès !</strong>
        <span class="block sm:inline">{{ success }}</span>
      </div>

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <!-- Bouton pour créer une nouvelle box -->
          <div class="mb-6">
            <Link
              href="/boxs/create"
              class="inline-block bg-blue-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
            >
              Ajouter une nouvelle box
            </Link>
          </div>

          <!-- Liste des boxs -->
          <div v-if="hasBoxs" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <Box
              v-for="box in boxs"
              :key="box.id"
              :box="box"
            />
          </div>
          <div v-else>
            <p>Vous n'avez pas encore de box.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>
