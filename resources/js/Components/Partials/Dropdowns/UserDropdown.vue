<script setup>
  import { ref } from 'vue'
  import { router } from '@inertiajs/vue3'

  // Props
  defineProps({
    username: {
      type: String,
      required: true,
    }
  })

  const open = ref(false)

  const logoutAction = ref(false)

  const toggleDropdown = function (){
    open.value = !open.value
  }

  router.on('navigate', (event) => {
      open.value = false
  })

  function logout() {
    if(logoutAction.value) return
    logoutAction.value = true

    router.get('/logout');
  }
</script>

<template>
  <div class="relative">
    <!-- Bouton avec pseudo cliquable -->
    <button @click="toggleDropdown" class="focus:outline-none px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 text-white">
      {{ username }}
    </button>

    <!-- Menu déroulant -->
    <div>
        <ul v-if="open" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
        <li>
          <form @submit.prevent="logout">
            <button type="submit" class="w-full text-left text-black px-4 py-2 hover:bg-gray-500 bg-gray-200 hover:text-orange-400">
              Déconnexion
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</template>


