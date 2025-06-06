<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const message = ref('Hello, Vue!')

function updateMessage() {
  message.value = 'You clicked the button!'
}

defineOptions({
    layout: AuthenticatedLayout
})
</script>


<template>
  <div>
    <h1>{{ message }}</h1>
    <button @click="updateMessage">Click Me</button>
  </div>
</template>

