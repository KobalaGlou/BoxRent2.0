<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import GuestLayout from '@/Layouts/GuestLayout.vue'
defineOptions({
    layout: GuestLayout
})

const loading = ref(false);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});

const handleSubmit = () => {
    if (loading.value) return;
    loading.value = true;

    form.post('/register', {
        onFinish: () => {
            loading.value = false;
        }
    });
};
</script>

<template>
    <div class="w-full flex items-center justify-center bg-gray-100 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold text-center mb-6">Inscription</h2>

            <form @submit.prevent="handleSubmit" class="space-y-4">
                <!-- Champ nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom d'utilisateur</label>
                    <input
                        id="name"
                        type="text"
                        v-model="form.name"
                        placeholder="Ton nom"
                        class="mt-1 block w-full rounded border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    />
                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                </div>

                <!-- Champ email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        placeholder="Ton adresse mail"
                        class="mt-1 block w-full rounded border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    />
                    <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        placeholder="Ton mot de passe"
                        class="mt-1 block w-full rounded border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    />
                    <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
                </div>

                <!-- Confirmation mot de passe -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirme ton mot de passe</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        placeholder="Répète le mot de passe"
                        class="mt-1 block w-full rounded border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    />
                    <div v-if="form.errors.password_confirmation" class="text-red-500 text-sm mt-1">{{ form.errors.password_confirmation }}</div>
                </div>

                <!-- Bouton d'inscription -->
                <button
                    type="submit"
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 rounded font-semibold flex justify-center items-center"
                >
                    <span v-if="loading" class="flex">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                        </svg>
                        Chargement
                    </span>
                    <span v-else class="flex">
                        Inscription →
                    </span>
                </button>

                <p class="text-center text-sm mt-2">
                    <Link href="/login" class="text-gray-600 underline">Déjà un compte ? Connecte-toi</Link>
                </p>
            </form>
        </div>
    </div>
</template>
