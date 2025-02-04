<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const statistics = ref(null);

onMounted(() => {
    axios.get('/api/user/statistics')
        .then(response => {
            statistics.value = response.data;
        })
        .catch(error => {
            console.error('Erreur lors du chargement des statistiques:', error);
        });
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>Tableau de Bord</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Parties Jouées</th>
                                        <th>Victoires</th>
                                        <th>Défaites</th>
                                        <th>Score Total</th>
                                        <th>Meilleur Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="statistics">
                                        <td>{{ statistics.games_played }}</td>
                                        <td>{{ statistics.games_won }}</td>
                                        <td>{{ statistics.games_lost }}</td>
                                        <td>{{ statistics.total_score }}</td>
                                        <td>{{ statistics.best_score }}</td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="5" class="text-muted">Aucune partie jouée</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
