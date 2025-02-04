<script setup>
import { ref, defineEmits } from 'vue';

const choices = ['Pierre', 'Feuille', 'Ciseaux'];
const playerChoice = ref(null);
const aiChoice = ref(null);
const result = ref('');
const emit = defineEmits(['gameCompleted']);

const playGame = (choice) => {
    playerChoice.value = choice;
    aiChoice.value = choices[Math.floor(Math.random() * choices.length)];
    checkWinner();
};

const checkWinner = () => {
    if (playerChoice.value === aiChoice.value) {
        result.value = "Égalité ! Réessayez.";
    } else if (
        (playerChoice.value === 'Pierre' && aiChoice.value === 'Ciseaux') ||
        (playerChoice.value === 'Feuille' && aiChoice.value === 'Pierre') ||
        (playerChoice.value === 'Ciseaux' && aiChoice.value === 'Feuille')
    ) {
        result.value = "Gagné 🎉 !";
        emit('gameCompleted'); // Déclenche l'événement pour passer au prochain scénario
    } else {
        result.value = "Perdu ❌ ! Essayez encore.";
    }
};
</script>

<template>
    <div class="game-container">
        <h3>Jouez à Pierre-Feuille-Ciseaux</h3>
        <div class="choices">
            <button v-for="choice in choices" :key="choice" @click="playGame(choice)" class="btn btn-primary mx-1">
                {{ choice }}
            </button>
        </div>
        <p>Votre choix : <strong>{{ playerChoice }}</strong></p>
        <p>Choix de l'IA : <strong>{{ aiChoice }}</strong></p>
        <p class="result">{{ result }}</p>
    </div>
</template>
