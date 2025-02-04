<script setup>
import { ref, defineEmits } from 'vue';

const secretNumber = ref(Math.floor(Math.random() * 100) + 1);
const guess = ref(null);
const message = ref("Devinez un nombre entre 1 et 100");
const emit = defineEmits(['gameCompleted']);

const checkGuess = () => {
    if (guess.value == secretNumber.value) {
        message.value = "Bravo 🎉 ! Vous avez trouvé le bon nombre.";
        emit('gameCompleted'); // Passe au scénario suivant
    } else if (guess.value > secretNumber.value) {
        message.value = "Trop haut 🔼 ! Essayez encore.";
    } else {
        message.value = "Trop bas 🔽 ! Essayez encore.";
    }
};
</script>

<template>
    <div class="game-container">
        <h3>Devinez le Nombre</h3>
        <input v-model="guess" type="number" class="form-control w-50 mx-auto" placeholder="Votre nombre" />
        <button @click="checkGuess" class="btn btn-success mt-2">Valider</button>
        <p class="mt-2">{{ message }}</p>
    </div>
</template>
