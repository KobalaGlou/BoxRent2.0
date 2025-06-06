<script setup>
import { ref, computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import UserDropdown from '@/Components/Partials/Dropdowns/UserDropdown.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
const isMobileMenuOpen = ref(false);
</script>

<template>
  <nav class="bg-gray-900 text-white py-5 px-8 flex justify-between items-center">
    <!-- Partie gauche : burger + logo + liens desktop -->
    <div class="flex items-center space-x-4">
      <!-- Burger menu (mobile uniquement) -->
      <button 
        @click="isMobileMenuOpen = !isMobileMenuOpen" 
        class="lg:hidden focus:outline-none" 
        aria-label="Ouvrir le menu"
      >
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Logo -->
      <div class="text-xl font-bold">BoxRent</div>

      <!-- Liens desktop -->
      <ul class="hidden lg:flex space-x-5 ml-8">
        <li><Link :href="route('boxs.index')" class="hover:text-orange-400">Mes Boxs</Link></li>
        <li><Link :href="route('locs.index')" class="hover:text-orange-400">Mes Locataires</Link></li>
        <li><Link :href="route('test')" class="hover:text-orange-400">Test Vitest</Link></li>
      </ul>
    </div>

    <!-- Dropdown profil -->
    <div class="space-x-4">
      <UserDropdown :username="user?.name" />
    </div>
  </nav>

  <!-- Menu mobile déroulant -->
  <transition name="fade">
    <div 
      v-if="isMobileMenuOpen" 
      class="lg:hidden bg-gray-800 text-white px-8 py-6 grid gap-5"
    >
      <Link 
        :href="route('boxs.index')" 
        class="block text-xl font-semibold py-5 border-b border-gray-700 hover:text-orange-400"
        @click="isMobileMenuOpen = false"
      >
        Mes Boxs
      </Link>
      <Link 
        :href="route('locs.index')" 
        class="block text-xl font-semibold py-5 border-b border-gray-700 hover:text-orange-400"
        @click="isMobileMenuOpen = false"
      >
        Mes Locataires
      </Link>
      <Link 
        :href="route('test')" 
        class="block text-xl font-semibold py-5 border-b border-gray-700 hover:text-orange-400"
        @click="isMobileMenuOpen = false"
      >
        Test Vitest
      </Link>
    </div>
  </transition>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>