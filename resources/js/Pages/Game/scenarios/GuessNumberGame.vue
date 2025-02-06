<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits(['gameCompleted']);
const secretNumber = ref(Math.floor(Math.random() * (70 / 5 - 4)) * 5 + 20);
const guess = ref(null);
const message = ref("Devinez un nombre entre 1 et 100.");
const hints = ref([
    "Le nombre secret est supérieur à 20.",
    "Le nombre secret est un multiple de 5.",
    "Le nombre est inférieur à 70."
]);
const revealedHints = ref(0);

const checkGuess = () => {
    if (guess.value == secretNumber.value) {
        message.value = "Bravo 🎉 ! Vous avez trouvé le bon nombre.";
        emit('gameCompleted');  // 🔥 Émission de l’événement quand le joueur gagne
    } else if (guess.value > secretNumber.value) {
        message.value = "Trop haut 🔼 ! Essayez encore.";
    } else {
        message.value = "Trop bas 🔽 ! Essayez encore.";
    }
};

// Révéler les indices un par un et appliquer une pénalité
const revealHint = () => {
    if (revealedHints.value < hints.value.length) {
        revealedHints.value++;
        emit('penaltyApplied', 5);  // Émettre un événement avec la pénalité
    }
}
</script>

<template>
    <div>
        <h3>Devinez le Nombre</h3>
        <p>{{ message }}</p>
        <input v-model="guess" type="number" placeholder="Votre nombre" class="form-control w-50 mx-auto" />
        <button @click="checkGuess" class="btn btn-success mt-2">Valider</button>

        <!-- Indices révélés un par un -->
        <div class="hints mt-4">
            <h5>Indices :</h5>
            <ul>
                <li v-for="(hint, index) in hints.slice(0, revealedHints)" :key="index">
                    <span class="badge bg-info text-white">{{ hint }}</span>
                </li>
            </ul>
            <button v-if="revealedHints < hints.length" @click="revealHint" class="btn btn-warning mt-3">
                Afficher un indice (-5 points)
            </button>
        </div>
    </div>
</template>
