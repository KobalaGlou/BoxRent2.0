<script setup>
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineOptions({
    layout: AuthenticatedLayout
})

const currentStep = ref(1)
const totalSteps = 3

const form = useForm({
  name: '',
  desc: '',
  lieux: '',
  prix: '',
  occupé: 0,
})

// Validation par étape
const isStep1Valid = computed(() => {
  return form.name.trim() !== '' && form.desc.trim() !== ''
})

const isStep2Valid = computed(() => {
  return form.lieux.trim() !== ''
})

const isStep3Valid = computed(() => {
  return form.prix !== '' && form.prix > 0
})

// Navigation entre les étapes
const nextStep = () => {
  if (currentStep.value < totalSteps) {
    if (currentStep.value === 1 && !isStep1Valid.value) return
    if (currentStep.value === 2 && !isStep2Valid.value) return
    currentStep.value++
  }
}

const prevStep = () => {
  if (currentStep.value > 1) {
    currentStep.value--
  }
}

const goToStep = (step) => {
  // Permet de naviguer uniquement vers les étapes précédentes ou si les étapes précédentes sont valides
  if (step <= currentStep.value || 
      (step === 2 && isStep1Valid.value) || 
      (step === 3 && isStep1Valid.value && isStep2Valid.value)) {
    currentStep.value = step
  }
}

const submit = () => {
  if (isStep1Valid.value && isStep2Valid.value && isStep3Valid.value) {
    form.post(route('boxs.store'))
  }
}

// Titres des étapes
const stepTitles = {
  1: 'Informations générales',
  2: 'Localisation',
  3: 'Tarification et disponibilité'
}
</script>

<template>
  <div class="container mx-auto py-6 max-w-2xl">
    <h1 class="text-3xl font-bold mb-8 text-center">Créer une Box</h1>

    <!-- Indicateur de progression -->
    <div class="mb-8">
      <div class="flex items-center justify-between">
        <div 
          v-for="step in totalSteps" 
          :key="step" 
          class="flex items-center cursor-pointer"
          @click="goToStep(step)"
        >
          <div 
            :class="[
              'w-10 h-10 rounded-full flex items-center justify-center text-white font-bold transition-colors duration-300',
              currentStep >= step ? 'bg-indigo-600' : 'bg-gray-300'
            ]"
          >
            {{ step }}
          </div>
          <span 
            :class="[
              'ml-2 text-sm font-medium',
              currentStep >= step ? 'text-indigo-600' : 'text-gray-500'
            ]"
          >
            {{ stepTitles[step] }}
          </span>
          <!-- Ligne de connexion -->
          <div 
            v-if="step < totalSteps" 
            :class="[
              'flex-1 h-1 mx-4 transition-colors duration-300',
              currentStep > step ? 'bg-indigo-600' : 'bg-gray-300'
            ]"
          ></div>
        </div>
      </div>
    </div>

    <!-- Erreurs de validation -->
    <div v-if="form.hasErrors" class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
      <ul class="list-disc list-inside">
        <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
      </ul>
    </div>

    <!-- Formulaire -->
    <form @submit.prevent="submit" class="bg-white shadow-lg rounded-lg p-6">
      <!-- Étape 1: Informations générales -->
      <div v-show="currentStep === 1" class="space-y-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Étape 1: Informations générales</h2>
        
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
            Nom de la box <span class="text-red-500">*</span>
          </label>
          <input 
            v-model="form.name" 
            type="text" 
            id="name" 
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Ex: Box de stockage 10m²"
            required 
          />
        </div>

        <div>
          <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">
            Description <span class="text-red-500">*</span>
          </label>
          <textarea 
            v-model="form.desc" 
            id="desc" 
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Décrivez votre box de stockage..."
            required
          ></textarea>
        </div>
      </div>

      <!-- Étape 2: Localisation -->
      <div v-show="currentStep === 2" class="space-y-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Étape 2: Localisation</h2>
        
        <div>
          <label for="lieux" class="block text-sm font-medium text-gray-700 mb-1">
            Adresse ou lieu <span class="text-red-500">*</span>
          </label>
          <input 
            v-model="form.lieux" 
            type="text" 
            id="lieux" 
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Ex: 123 Rue de la République, 75001 Paris"
            required
          />
          <p class="text-sm text-gray-500 mt-1">Indiquez l'adresse complète ou la zone géographique</p>
        </div>
      </div>

      <!-- Étape 3: Tarification -->
      <div v-show="currentStep === 3" class="space-y-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Étape 3: Tarification et disponibilité</h2>
        
        <div>
          <label for="prix" class="block text-sm font-medium text-gray-700 mb-1">
            Prix (€/mois) <span class="text-red-500">*</span>
          </label>
          <input 
            v-model="form.prix" 
            type="number" 
            step="0.01" 
            min="0"
            id="prix" 
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Ex: 50.00"
            required
          />
        </div>

        <div>
          <label for="occupé" class="block text-sm font-medium text-gray-700 mb-1">
            Statut d'occupation
          </label>
          <select 
            v-model="form.occupé" 
            id="occupé" 
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          >
            <option :value="0">Disponible</option>
            <option :value="1">Occupé</option>
          </select>
        </div>

        <!-- Récapitulatif -->
        <div class="bg-gray-50 p-4 rounded-lg">
          <h3 class="font-medium text-gray-800 mb-2">Récapitulatif:</h3>
          <div class="text-sm text-gray-600 space-y-1">
            <p><strong>Nom:</strong> {{ form.name }}</p>
            <p><strong>Lieu:</strong> {{ form.lieux }}</p>
            <p><strong>Prix:</strong> {{ form.prix }}€/mois</p>
            <p><strong>Statut:</strong> {{ form.occupé ? 'Occupé' : 'Disponible' }}</p>
          </div>
        </div>
      </div>

      <!-- Boutons de navigation -->
      <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
        <button 
          v-if="currentStep > 1"
          type="button" 
          @click="prevStep"
          class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200"
        >
          Précédent
        </button>
        <div v-else></div> <!-- Espace vide pour maintenir l'alignement -->

        <div class="flex space-x-3">
          <button 
            v-if="currentStep < totalSteps"
            type="button" 
            @click="nextStep"
            :disabled="(currentStep === 1 && !isStep1Valid) || (currentStep === 2 && !isStep2Valid)"
            :class="[
              'px-6 py-2 rounded-md font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500',
              (currentStep === 1 && !isStep1Valid) || (currentStep === 2 && !isStep2Valid)
                ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                : 'bg-indigo-600 text-white hover:bg-indigo-700'
            ]"
          >
            Suivant
          </button>

          <button 
            v-if="currentStep === totalSteps"
            type="submit" 
            :disabled="!isStep1Valid || !isStep2Valid || !isStep3Valid || form.processing"
            :class="[
              'px-6 py-2 rounded-md font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500',
              !isStep1Valid || !isStep2Valid || !isStep3Valid || form.processing
                ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                : 'bg-green-600 text-white hover:bg-green-700'
            ]"
          >
            {{ form.processing ? 'Création...' : 'Créer la box' }}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>