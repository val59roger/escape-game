<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

import ChifoumiGame from '@/Pages/Game/scenarios/ChifoumiGame.vue';
import GuessNumberGame from '@/Pages/Game/scenarios/GuessNumberGame.vue';
import EquationGame from '@/Pages/Game/scenarios/EquationGame.vue';
import PirateLockGame from '@/Pages/Game/scenarios/PirateLockGame.vue';
import PotionMixGame from '@/Pages/Game/scenarios/PotionMixGame.vue';

const scenarios = ref([]);
const currentScenarioIndex = ref(0);
const timeLeft = ref(60);
const score = ref(100); // Le score global
let timerInterval = null;

onMounted(() => {
    fetchScenarios();
    startTimer();
});

// Charger les scénarios depuis l'API
const fetchScenarios = async () => {
    try {
        const response = await axios.get('/api/scenarios');
        scenarios.value = response.data;
    } catch (error) {
        console.error('Erreur lors du chargement des scénarios:', error);
    }
};

// Passer automatiquement au scénario suivant
const nextScenario = () => {
    if (currentScenarioIndex.value < scenarios.value.length - 1) {
        currentScenarioIndex.value++;
        startTimer();
    } else {
        alert("🎉 Félicitations, vous avez terminé tous les scénarios !");
        clearInterval(timerInterval);
        showFinalScore(); // Affiche le score final à la fin de tous les scénarios
    }
};

// Timer
const startTimer = () => {
    timeLeft.value = 60;
    if (timerInterval) clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        if (timeLeft.value > 0) {
            timeLeft.value--;
            score.value--; // Le score diminue à chaque seconde
        } else {
            clearInterval(timerInterval);
            alert("⏳ Temps écoulé !");
            resetScenario();
        }
    }, 1000);
};

// Réinitialiser le scénario actuel
const resetScenario = () => {
    startTimer();
};

// Appliquer la pénalité sur le score
const applyPenalty = (points) => {
    score.value -= points;
};

// Afficher le score final à la fin de tous les scénarios
const showFinalScore = () => {
    alert(`🎉 Félicitations ! Votre score final est : ${score.value}`);
};
</script>

<template>
    <Head title="Game" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Escape Game - {{ scenarios[currentScenarioIndex]?.title }}
            </h2>
        </template>

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>{{ scenarios[currentScenarioIndex]?.title }}</h4>
                        </div>
                        <div class="card-body">
                            <p>{{ scenarios[currentScenarioIndex]?.description }}</p>

                            <h5 class="text-danger text-center">⏳ Temps restant : {{ timeLeft }}s</h5>
                            <h5 class="text-success text-center">🏆 Score : {{ score }}</h5>

                            <!-- Mini-jeux dynamiques -->
                            <ChifoumiGame v-if="currentScenarioIndex === 0" @gameCompleted="nextScenario" @penaltyApplied="applyPenalty" />
                            <GuessNumberGame v-if="currentScenarioIndex === 1" @gameCompleted="nextScenario" @penaltyApplied="applyPenalty" />
                            <EquationGame v-if="currentScenarioIndex === 2" @gameCompleted="nextScenario" @penaltyApplied="applyPenalty" />
                            <PirateLockGame v-if="currentScenarioIndex === 3" @gameCompleted="nextScenario" @penaltyApplied="applyPenalty" />
                            <PotionMixGame v-if="currentScenarioIndex === 4" @gameCompleted="nextScenario" @penaltyApplied="applyPenalty" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
