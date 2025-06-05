<script setup>
import { computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import UserDropdown from '@/Components/Partials/Dropdowns/UserDropdown.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
  <nav class="bg-gray-900 text-white py-5 px-15 flex justify-between items-center">
    <!-- Bloc gauche : Titre et navigation -->
    <div class="flex items-center space-x-12">
      <!-- Nom de l'app -->
      <div class="text-xl font-bold">BoxRent</div>

      <!-- Liens de navigation -->
      <ul class="flex space-x-5">
        <li><Link :href="route('boxs.index')" class="hover:text-orange-400">Mes Boxs</Link></li>
        <li><Link :href="route('locataires.index')" class="hover:text-orange-400">Mes Locataires</Link></li>
        <li><Link :href="route('contrats.index')" class="hover:text-orange-400">Mes Contrats</Link></li>
        <li><Link :href="route('templates.index')" class="hover:text-orange-400">Mes Templates</Link></li>
        <li><Link :href="route('factures.impayes')" class="hover:text-orange-400">Mes Factures</Link></li>
        <li><Link :href="route('impots.index')" class="hover:text-orange-400">Mes Impôts</Link></li>

      </ul>
    </div>

    <!-- Bloc droit : Nom utilisateur en attendant dropdown -->
    <!-- Menu déroulant profil -->
    <div class="space-x-4">
      <UserDropdown :username="user?.name" />

    </div>
  </nav>
</template>
