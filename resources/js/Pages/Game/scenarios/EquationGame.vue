<script setup>
import { ref, defineEmits } from 'vue';

const num1 = ref(Math.floor(Math.random() * 20) + 1);
const num2 = ref(Math.floor(Math.random() * 20) + 1);
const correctAnswer = ref(num1.value + num2.value);
const playerAnswer = ref(null);
const message = ref("Résolvez l'équation pour avancer !");
const emit = defineEmits(['gameCompleted']);

const checkEquation = () => {
    if (playerAnswer.value == correctAnswer.value) {
        message.value = "Correct 🎉 ! Vous pouvez continuer.";
        emit('gameCompleted'); // Passe au scénario suivant
    } else {
        message.value = "Incorrect ❌ ! Réessayez.";
    }
};
</script>

<template>
    <div class="game-container">
        <h3>Énigme Mathématique</h3>
        <p>Quel est le résultat de {{ num1 }} + {{ num2 }} ?</p>
        <input v-model="playerAnswer" type="number" class="form-control w-50 mx-auto" placeholder="Votre réponse" />
        <button @click="checkEquation" class="btn btn-info mt-2">Valider</button>
        <p class="mt-2">{{ message }}</p>
    </div>
</template>
