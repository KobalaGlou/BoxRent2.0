<script setup>
import { computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
  <nav class="bg-gray-900 text-white py-5 px-8 flex justify-between items-center">
    <!-- Bloc gauche : Titre et navigation -->
    <div class="flex items-center space-x-12">
      <!-- Nom de l'app -->
      <div class="text-xl font-bold mr-10">BoxRent</div>

      <!-- Liens de navigation -->
      <ul class="flex space-x-5">
        <li><Link href="/" class="hover:text-orange-400">Accueil</Link></li>
      </ul>
    </div>

    <!-- Bloc droit : Nom utilisateur en attendant dropdown -->
    <div class="text-sm text-gray-300">
      <Link href="/login" class="bg-orange-500 hover:bg-orange-600 px-4 py-2.5 rounded mr-3">Connexion</Link>
      <Link href="/register" class="border border-orange-500 px-4 py-2.5 rounded hover:bg-orange-500 ">Inscription</Link>
    </div>
  </nav>
</template>
