<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits(['gameCompleted']);
const message = ref("Choisissez Pierre, Feuille ou Ciseaux.");
const iaChoice = ref("");
const playerChoice = ref("");
const outcomes = ["Pierre", "Feuille", "Ciseaux"];
const hints = ref([
    "L'IA choisit souvent Pierre en premier.",
    "Ciseaux est rarement choisi.",
    "Si l'IA vient de choisir Feuille, elle choisira probablement Pierre ensuite."
]);
const revealedHints = ref(0);

const playGame = (choice) => {
    playerChoice.value = choice;
    iaChoice.value = outcomes[Math.floor(Math.random() * 3)];
    if (
        (playerChoice.value === "Pierre" && iaChoice.value === "Ciseaux") ||
        (playerChoice.value === "Feuille" && iaChoice.value === "Pierre") ||
        (playerChoice.value === "Ciseaux" && iaChoice.value === "Feuille")
    ) {
        message.value = `Bravo 🎉 ! Vous avez gagné. L'IA a choisi ${iaChoice.value}.`;
        emit('gameCompleted');  // 🔥 Émission de l’événement quand le joueur gagne
    } else if (playerChoice.value === iaChoice.value) {
        message.value = "Égalité ! Réessayez.";
    } else {
        message.value = `Perdu ❌ ! L'IA a choisi ${iaChoice.value}. Réessayez.`;
    }
};

// Révéler les indices un par un et appliquer une pénalité
const revealHint = () => {
    if (revealedHints.value < hints.value.length) {
        revealedHints.value++;
        emit('penaltyApplied', 5);  // Émettre un événement avec la pénalité
    }
};
</script>

<template>
    <div>
        <h3>Pierre-Feuille-Ciseaux</h3>
        <p>{{ message }}</p>
        <div class="d-flex justify-content-around">
            <button @click="playGame('Pierre')" class="btn btn-info">Pierre</button>
            <button @click="playGame('Feuille')" class="btn btn-info">Feuille</button>
            <button @click="playGame('Ciseaux')" class="btn btn-info">Ciseaux</button>
        </div>

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
