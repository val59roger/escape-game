<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits(['gameCompleted', 'penaltyApplied']);  // Ajouter l'événement 'penaltyApplied'
const message = ref("Mélangez les bonnes fioles pour créer l’antidote.");
const selectedPotions = ref([]);
const antidote = ['Fiole Verte', 'Fiole Bleue'];

const hints = ref([
    "La Fiole Rouge est toxique.",
    "La Fiole Bleue est toujours utilisée dans l’antidote.",
    "La Fiole Verte neutralise les toxines."
]);
const revealedHints = ref(0);

const checkAntidote = () => {
    if (selectedPotions.value.sort().toString() === antidote.sort().toString()) {
        message.value = "Antidote réussi 🎉 ! Vous avez neutralisé le poison.";
        emit('gameCompleted');
    } else {
        message.value = "Mauvais mélange ❌. Réessayez.";
        selectedPotions.value = [];
    }
};

// Révéler les indices un par un et appliquer une pénalité
const revealHint = () => {
    if (revealedHints.value < hints.value.length) {
        revealedHints.value++;
        emit('penaltyApplied', 5);  // Émettre un événement avec la pénalité
    }
};

// Réinitialiser la liste des potions sélectionnées
const resetPotions = () => {
    selectedPotions.value = [];
};
</script>

<template>
    <div>
        <h3>Mélange de Potions</h3>
        <p>{{ message }}</p>
        <div class="d-flex justify-content-around">
            <button @click="selectedPotions.push('Fiole Rouge')" class="btn btn-danger">Fiole Rouge</button>
            <button @click="selectedPotions.push('Fiole Bleue')" class="btn btn-primary">Fiole Bleue</button>
            <button @click="selectedPotions.push('Fiole Verte')" class="btn btn-success">Fiole Verte</button>
            <button @click="selectedPotions.push('Fiole Jaune')" class="btn btn-warning">Fiole Jaune</button>
        </div>

        <!-- Afficher les potions sélectionnées -->
        <div v-if="selectedPotions.length > 0" class="mt-3">
            <h5>Potions sélectionnées :</h5>
            <ul>
                <li v-for="(potion, index) in selectedPotions" :key="index">
                    <span class="badge bg-secondary">{{ potion }}</span>
                </li>
            </ul>
            <!-- Bouton pour réinitialiser la liste -->
            <button @click="resetPotions" class="btn btn-danger mt-3">Réinitialiser la sélection</button>
        </div>

        <button @click="checkAntidote" class="btn btn-info mt-3">Vérifier le mélange</button>

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
