<script setup>
import { useForm,usePage } from '@inertiajs/vue3'
import { onMounted } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineOptions({
    layout: AuthenticatedLayout
})

const props = defineProps({
  locataire: Object
})

const form = useForm({
  nom: props.locataire.nom,
  tel: props.locataire.tel,
  email: props.locataire.email,
  adresse: props.locataire.adresse,
  compte_bancaire: props.locataire.compte_bancaire,
})

const submit = () => {
  form.put(route('locs.update', props.locataire.id))
}
</script>

<template>
  <div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Modifier le Locataire</h1>

    <!-- Erreurs de validation -->
    <div v-if="form.hasErrors" class="bg-red-100 text-red-800 p-4 rounded mb-4">
      <ul>
        <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
      </ul>
    </div>

    <!-- Formulaire -->
    <form @submit.prevent="submit" class="space-y-4">
        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
            <input v-model="form.nom" type="text" id="nom" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" required />
        </div> 

        <div>
            <label for="tel" class="block text-sm font-medium text-gray-700">Téléphone</label>
            <input v-model="form.tel" type="text" id="tel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" required />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input v-model="form.email" type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" required />
        </div>

        <div>
            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
            <input v-model="form.adresse" type="text" id="adresse" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" required />
        </div>

        <div>
            <label for="compte_bancaire" class="block text-sm font-medium text-gray-700">Compte Bancaire</label>
            <input v-model="form.compte_bancaire" type="text" id="compte_bancaire" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" />
        </div>

        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Enregistrer
            </button>
        </div>
    </form>
    </div>
</template>

