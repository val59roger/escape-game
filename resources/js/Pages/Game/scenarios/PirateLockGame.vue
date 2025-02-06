<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits(['gameCompleted']);
const codeCorrect = '1703';
const userCode = ref('');
const message = ref('Trouvez le code du coffre !');
const hints = ref([
    "Le premier chiffre est 1.",
    "Le deuxième chiffre est un multiple de 7.",
    "Le dernier chiffre est 3."
]);
const revealedHints = ref(0);

// Vérification du code
const checkCode = () => {
    if (userCode.value === codeCorrect) {
        message.value = "Coffre ouvert 🎉 ! Vous avez trouvé le trésor.";
        emit('gameCompleted');
    } else {
        message.value = "Code incorrect ❌. Essayez encore.";
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
        <h3>Cadenas Pirate</h3>
        <p>{{ message }}</p>
        <p>Entrez le code à 4 chiffres :</p>
        <input v-model="userCode" maxlength="4" class="form-control w-50 mx-auto text-center" placeholder="Code" />
        <button @click="checkCode" class="btn btn-dark mt-2">Vérifier</button>

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
