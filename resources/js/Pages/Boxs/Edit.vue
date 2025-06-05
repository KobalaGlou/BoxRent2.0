<script setup>
import { useForm,usePage } from '@inertiajs/vue3'
import { onMounted } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineOptions({
    layout: AuthenticatedLayout
})

const props = defineProps({
  box: Object
})

const form = useForm({
  name: props.box.name,
  desc: props.box.desc,
  lieux: props.box.lieux,
  prix: props.box.prix,
  occupé: props.box.occupé
})

const submit = () => {
  form.put(route('boxs.update', props.box.id))
}
</script>

<template>
  <div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Modifier la Box</h1>

    <!-- Erreurs de validation -->
    <div v-if="form.hasErrors" class="bg-red-100 text-red-800 p-4 rounded mb-4">
      <ul>
        <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
      </ul>
    </div>

    <!-- Formulaire -->
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
        <input v-model="form.name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" required />
      </div>

      <div>
        <label for="desc" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea v-model="form.desc" id="desc" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" />
      </div>

      <div>
        <label for="lieux" class="block text-sm font-medium text-gray-700">Lieu</label>
        <input v-model="form.lieux" type="text" id="lieux" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" />
      </div>

      <div>
        <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
        <input v-model="form.prix" type="number" step="0.01" id="prix" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" />
      </div>

      <div>
        <label for="occupé" class="block text-sm font-medium text-gray-700">Occupé</label>
        <select v-model="form.occupé" id="occupé" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
          <option :value="0">Non</option>
          <option :value="1">Oui</option>
        </select>
      </div>

      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Mettre à jour
      </button>
    </form>
  </div>
</template>
