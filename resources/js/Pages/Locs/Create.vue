<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineOptions({
    layout: AuthenticatedLayout
})

const form = useForm({
  nom: '',
  tel: '',
  email: '',
  adresse: '',
  compte_bancaire: '',
})

const submit = () => {
  form.post(route('locs.store'))
}
</script>

<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">
          Ajouter un locataire
        </h2>

        <div v-if="form.hasErrors" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
          <strong class="font-bold">Erreurs :</strong>
          <ul class="mt-2 list-disc list-inside">
            <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
          </ul>
        </div>

        <form @submit.prevent="submit">
          <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-bold mb-2">Nom :</label>
            <input
              type="text"
              id="nom"
              v-model="form.nom"
              required
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
            />
          </div>

          <div class="mb-4">
            <label for="tel" class="block text-gray-700 font-bold mb-2">Téléphone :</label>
            <input
              type="text"
              id="tel"
              v-model="form.tel"
              required
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
            />
          </div>

          <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">E-mail :</label>
            <input
              type="email"
              id="email"
              v-model="form.email"
              required
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
            />
          </div>

          <div class="mb-4">
            <label for="adresse" class="block text-gray-700 font-bold mb-2">Adresse :</label>
            <textarea
              id="adresse"
              v-model="form.adresse"
              required
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
            ></textarea>
          </div>

          <div class="mb-4">
            <label for="compte_bancaire" class="block text-gray-700 font-bold mb-2">Compte Bancaire :</label>
            <input
              type="text"
              id="compte_bancaire"
              v-model="form.compte_bancaire"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
            />
          </div>

          <div class="flex items-center justify-between">
            <button
              type="submit"
              :disabled="form.processing"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
              Ajouter le locataire
            </button>
            <a
              :href="route('locs.index')"
              class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
            >
              Annuler
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
