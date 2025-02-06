<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits(['gameCompleted']);
const num1 = ref(Math.floor(Math.random() * 20) + 1);
const num2 = ref(Math.floor(Math.random() * 20) + 1);
const num3 = ref(Math.floor(Math.random() * 20) + 1);
const correctAnswer = ref(num1.value + num2.value + num3.value);
const playerAnswer = ref(null);
const message = ref("Résolvez l'équation suivante :");

const checkAnswer = () => {
    if (playerAnswer.value == correctAnswer.value) {
        message.value = "Bravo 🎉 ! Vous avez résolu l'équation.";
        emit('gameCompleted');
    } else {
        message.value = "Mauvaise réponse ❌. Essayez encore.";
    }
};

const hints = ref([
    `Le premier nombre est ${num1.value}.`,
    `La somme des deux premiers nombres est ${num1.value + num2.value}.`,
    `Le résultat est supérieur à ${correctAnswer.value - 5}.`
]);
const revealedHints = ref(0);

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
        <h3>Énigme Mathématique</h3>
        <p>{{ message }}</p>
        <p class="fw-bold">Quelle est la somme de {{ num1 }} + {{ num2 }} + {{ num3 }} ?</p>
        <input v-model="playerAnswer" type="number" class="form-control w-50 mx-auto" placeholder="Votre réponse" />
        <button @click="checkAnswer" class="btn btn-info mt-2">Valider</button>

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
