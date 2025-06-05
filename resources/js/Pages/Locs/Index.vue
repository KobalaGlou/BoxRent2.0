<script setup>
import { Head, Link } from '@inertiajs/vue3'
import LocataireCard from '@/Components/Partials/Entries/Loc.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineOptions({
    layout: AuthenticatedLayout
})

defineProps({
  locataires: Array,
  flash: Object,
})
</script>

<template>
  <Head title="Mes Locataires" />

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h2 class="text-2xl font-semibold text-gray-800 leading-tight mb-6">
        Mes Locataires
      </h2>

      <div v-if="flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <strong class="font-bold">Succès !</strong>
        <span class="block sm:inline">{{ flash.success }}</span>
      </div>

      <Link :href="route('locs.export')" class="btn btn-primary mb-4 inline-block bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
        Exporter en CSV
      </Link>

      <div class="mb-6">
        <Link :href="route('locs.create')" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
          Ajouter un nouveau locataire
        </Link>
      </div>

      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="p-6">
          <template v-if="locataires.length === 0">
            <p>Vous n'avez pas encore de locataires.</p>
          </template>
          <template v-else>
            <table class="min-w-full bg-white border border-gray-200">
              <thead>
                <tr>
                  <th class="py-2 px-4 border-b text-left">Nom</th>
                  <th class="py-2 px-4 border-b text-left">Téléphone</th>
                  <th class="py-2 px-4 border-b text-left">Email</th>
                  <th class="py-2 px-4 border-b text-left">Adresse</th>
                  <th class="py-2 px-4 border-b text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                <LocataireCard
                  v-for="loc in locataires"
                  :key="loc.id"
                  :locataire="loc"
                />
              </tbody>
            </table>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>
