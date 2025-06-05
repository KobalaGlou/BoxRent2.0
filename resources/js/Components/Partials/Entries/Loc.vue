<script setup>
import { router, Link } from '@inertiajs/vue3'

const props = defineProps({
  locataire: Object,
})

const destroy = () => {
  if (confirm('Voulez-vous vraiment supprimer ce locataire ?')) {
    router.delete(route('locs.destroy', props.locataire.id))
  }
}
</script>

<template>
  <tr>
    <td class="py-2 px-4 border-b text-center">{{ locataire.nom }}</td>
    <td class="py-2 px-4 border-b text-center">{{ locataire.tel }}</td>
    <td class="py-2 px-4 border-b text-center">{{ locataire.email }}</td>
    <td class="py-2 px-4 border-b text-center">{{ locataire.adresse }}</td>
    <td class="py-2 px-4 border-b text-right">
      <Link :href="route('locs.edit', locataire.id)" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
        Modifier
      </Link>
      <button
        @click="destroy"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
      >
        Supprimer
      </button>
    </td>
  </tr>
</template>
