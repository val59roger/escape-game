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
const gameCompleted = ref(false);
const timeLeft = ref(60);
const score = ref(100);
let timerInterval = null;

onMounted(() => {
    fetchScenarios();
    startTimer();
});

// Charger les scénarios
const fetchScenarios = () => {
    axios.get('/api/scenarios')
        .then(response => {
            scenarios.value = response.data;
        })
        .catch(error => {
            console.error('Erreur de chargement des scénarios:', error);
        });
};

// Démarrer le timer
const startTimer = () => {
    timeLeft.value = 60;
    score.value = 100; // Score max au début
    if (timerInterval) clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        if (timeLeft.value > 0) {
            timeLeft.value--;
            score.value--; // Réduction du score chaque seconde
        } else {
            clearInterval(timerInterval);
            alert("⏳ Temps écoulé ! Score perdu !");
            resetGame();
        }
    }, 1000);
};

axios.get('/api/user', { withCredentials: true })
    .then(response => {
        console.log('Utilisateur connecté :', response.data);
    })
    .catch(error => {
        console.error("L'utilisateur n'est pas connecté :", error);
    });


// Sauvegarde du score
const saveScore = () => {
    axios.get('/sanctum/csrf-cookie').then(() => {
        axios.post('/api/save-score', {
            scenario_id: scenarios.value[currentScenarioIndex.value].id,
            score: score.value
        }, {
            withCredentials: true,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
    });
};

// Passer au scénario suivant
const nextScenario = () => {
    saveScore(); // Enregistrer le score
    if (currentScenarioIndex.value < scenarios.value.length - 1) {
        currentScenarioIndex.value++;
        gameCompleted.value = false;
        startTimer();
    } else {
        alert("🎉 Félicitations ! Vous avez terminé tous les scénarios.");
        clearInterval(timerInterval);
    }
};

// Réinitialiser le scénario actuel en cas d'échec
const resetGame = () => {
    gameCompleted.value = false;
    startTimer();
};

// Arrêter le timer si le jeu est complété
watch(gameCompleted, (newValue) => {
    if (newValue) {
        clearInterval(timerInterval);
    }
});
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

                            <!-- Timer et Score -->
                            <h5 class="text-danger text-center">⏳ Temps restant : {{ timeLeft }}s</h5>
                            <h5 class="text-success text-center">🏆 Score : {{ score }}</h5>

                            <!-- Mini-jeux dynamiques selon le scénario -->
                            <ChifoumiGame v-if="currentScenarioIndex === 0 && !gameCompleted" @gameCompleted="gameCompleted = true" />
                            <GuessNumberGame v-if="currentScenarioIndex === 1 && !gameCompleted" @gameCompleted="gameCompleted = true" />
                            <EquationGame v-if="currentScenarioIndex === 2 && !gameCompleted" @gameCompleted="gameCompleted = true" />
                            <PirateLockGame v-if="currentScenarioIndex === 3 && !gameCompleted" @gameCompleted="gameCompleted = true" />
                            <PotionMixGame v-if="currentScenarioIndex === 4 && !gameCompleted" @gameCompleted="gameCompleted = true" />

                            <!-- Bouton pour passer au scénario suivant -->
                            <button v-if="gameCompleted" class="btn btn-primary mt-3" @click="nextScenario">
                                Scénario suivant →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
