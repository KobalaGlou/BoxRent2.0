<script setup>
import AnnonymousNavbar from '@/Components/Partials/Navbars/AnnonymousNavbar.vue'
import AppFooter from '@/Components/Partials/Footers/AppFooter.vue'
</script>

<template>
  <div class="min-h-screen flex flex-col bg-gray-100">
    <!-- Navbar -->
    <AnnonymousNavbar />

    <!-- Contenu principal -->
    <main class="flex-1 flex container mx-auto px-4 py-6">
      <slot />
    </main>

    <!-- Footer -->
    <AppFooter />
  </div>
</template>
