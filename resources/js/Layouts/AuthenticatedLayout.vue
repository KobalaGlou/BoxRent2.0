<script setup>
import LoggedNavBar from '@/Components/Partials/Navbars/LoggedNavBar.vue'
import AppFooter from '@/Components/Partials/Footers/AppFooter.vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

// Récupère l'utilisateur connecté
const user = computed(() => page.props.auth?.user)
const isAuthenticated = computed(() => !!user.value)

// Récupère l'URL courante pour la clé de transition
const currentRoute = computed(() => page.url)
</script>

<template>
  <div class="min-h-screen flex flex-col bg-gray-100">

    <!-- Navbar dynamique -->
    <LoggedNavBar />

    <!-- Contenu principal avec transition -->
    <main class="flex-1 container mx-auto px-4 py-6">
      <Transition
        name="fade"
        mode="out-in"
        appear
      >
        <div :key="currentRoute">
          <slot />
        </div>
      </Transition>
    </main>

    <!-- Footer -->
    <AppFooter />
  </div>
</template>

<style scoped>
/* Transition fade */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.fade-enter-to,
.fade-leave-from {
  opacity: 1;
}
</style>