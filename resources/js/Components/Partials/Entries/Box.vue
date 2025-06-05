<script setup>
import { Link, router } from '@inertiajs/vue3'
const props = defineProps({
  box: Object
})

const deleteBox = () => {
  if (confirm('Êtes-vous sûr de vouloir supprimer cette box ?')) {
    router.delete(`/boxs/${props.box.id}`)
  }
}
</script>

<template>
  <div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-4">
      <h3 class="font-bold text-xl mb-2">{{ box.name }}</h3>
      <p class="text-gray-700 text-base">
        <strong>Description:</strong> {{ box.desc ?? 'Aucune description' }}<br>
        <strong>Lieu:</strong> {{ box.lieux }}<br>
        <strong>Prix:</strong> {{ box.prix }} €<br>
        <strong>Statut:</strong>
        <span :class="box.occupé ? 'text-red-500' : 'text-green-500'">
          {{ box.occupé ? 'Occupé' : 'Libre' }}
        </span>
      </p>
      <div class="mt-4 flex justify-between items-center">
        <Link
          :href="`/boxs/${box.id}`"
          class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Voir détails
        </Link>
        <Link
          :href="`/boxs/${box.id}/edit`"
          class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
        >
          Modifier
        </Link>
        <button
          @click="deleteBox"
          class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
        >
          Supprimer
        </button>
      </div>
    </div>
  </div>
</template>
