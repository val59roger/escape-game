<script setup>
import { ref, defineEmits } from 'vue';

const ingredients = ['Fiole Verte', 'Fiole Rouge', 'Fiole Bleue'];
const selectedIngredients = ref([]);
const correctCombination = ['Fiole Verte', 'Fiole Bleue'];
const message = ref('Trouvez le bon mélange !');
const emit = defineEmits(['gameCompleted']);

// Fonction pour ajouter un ingrédient (max 2)
const selectIngredient = (ingredient) => {
    if (selectedIngredients.value.length < 2 && !selectedIngredients.value.includes(ingredient)) {
        selectedIngredients.value.push(ingredient);
    }
};

// Vérifier la potion et réinitialiser en cas d’échec
const mixPotion = () => {
    if (JSON.stringify(selectedIngredients.value.sort()) === JSON.stringify(correctCombination.sort())) {
        message.value = 'Antidote réussi 🎉 ! Vous pouvez continuer.';
        emit('gameCompleted');
    } else {
        message.value = 'Le mélange est toxique ❌ ! Les ingrédients sont remis à zéro.';
        resetGame(); // Réinitialisation automatique en cas d'échec
    }
};

// Réinitialiser les ingrédients sélectionnés
const resetGame = () => {
    selectedIngredients.value = [];
};
</script>

<template>
    <div class="game-container">
        <h3>Préparez l’Antidote</h3>
        <p>Sélectionnez deux fioles :</p>
        <div class="d-flex justify-content-center">
            <button v-for="ingredient in ingredients" :key="ingredient"
                class="btn btn-warning mx-1"
                @click="selectIngredient(ingredient)">
                {{ ingredient }}
            </button>
        </div>

        <p class="mt-3">Ingrédients choisis : {{ selectedIngredients.join(', ') || 'Aucun' }}</p>

        <button @click="mixPotion" class="btn btn-success mt-2">Mélanger</button>
        <p class="mt-2">{{ message }}</p>
    </div>
</template>
