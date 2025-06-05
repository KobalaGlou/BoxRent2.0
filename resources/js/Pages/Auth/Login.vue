<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";


const loading = ref(false);

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const handleSubmit = () => {
    if (loading.value) return;
    loading.value = true;

    form.post('/login', {
        onFinish: () => {
            loading.value = false;
        }
    });
}
</script>

<template>
    <div class="w-full flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold text-center mb-6">Connexion</h2>

            <form @submit.prevent="handleSubmit" class="space-y-4">

                <!-- Champ email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email / Nom d'utilisateur</label>
                    <input
                        id="email"
                        type="text"
                        v-model="form.email"
                        placeholder="Ton adresse mail"
                        class="mt-1 block w-full rounded border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    />
                    <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                </div>

                <!-- Champ mot de passe -->
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

                <!-- Checkbox Se souvenir -->
                <div class="flex items-center">
                    <input id="remember" type="checkbox" v-model="form.remember" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Se souvenir de moi</label>
                </div>

                <!-- Bouton de connexion -->
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
                        Connexion →
                    </span>
                </button>
                <p class="text-center text-sm mt-2">
                    <Link href="/register" class="text-gray-600 underline">Créer un compte</Link>

                </p>
            </form>
        </div>
    </div>
</template>
