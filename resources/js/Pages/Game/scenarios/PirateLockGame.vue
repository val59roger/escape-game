<script setup>
import { ref, defineEmits } from 'vue';

const codeCorrect = '1743'; // Code secret du coffre
const userCode = ref('');
const message = ref('Trouvez le code du coffre !');
const emit = defineEmits(['gameCompleted']);

// Indices cachés
const hints = ref([
    { id: 1, text: 'Premier chiffre : 1', found: false },
    { id: 2, text: 'Deuxième chiffre : 7', found: false },
    { id: 3, text: 'Troisième chiffre : 4', found: false }
]);

const allHintsFound = ref(false);

// Fonction pour révéler un indice
const revealHint = (hint) => {
    hint.found = true;
    // Vérifie si tous les indices ont été trouvés
    if (hints.value.every(h => h.found)) {
        allHintsFound.value = true;
        message.value = "Vous avez trouvé tous les indices ! Tentez le code.";
    }
};

// Vérifier le code du coffre
const checkCode = () => {
    if (userCode.value === codeCorrect) {
        message.value = 'Coffre ouvert 🎉 ! Vous avez la clé.';
        emit('gameCompleted');
    } else {
        message.value = 'Code incorrect ❌. Essayez encore.';
    }
};
</script>

<template>
    <div class="game-container">
        <h3>Déverrouillez le Coffre du Pirate</h3>

        <!-- Indices cachés -->
        <h5>Cliquez sur les objets pour trouver des indices :</h5>
        <div class="d-flex justify-content-center">
            <button v-for="hint in hints" :key="hint.id" class="btn btn-outline-warning mx-1"
                @click="revealHint(hint)" :disabled="hint.found">
                {{ hint.found ? hint.text : "?" }}
            </button>
        </div>

        <p class="mt-3">{{ message }}</p>

        <!-- Entrée du code (après découverte des indices) -->
        <div v-if="allHintsFound">
            <h5>Entrez le code :</h5>
            <input v-model="userCode" maxlength="4" class="form-control w-50 mx-auto text-center" />
            <button @click="checkCode" class="btn btn-dark mt-2">Vérifier</button>
        </div>
    </div>
</template>
