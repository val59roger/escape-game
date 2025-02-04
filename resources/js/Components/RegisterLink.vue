<template>
  <div class="text-center mt-4">
    <p>
      Pas encore inscrit ?
      <Link :href="route('register')" class="text-blue-500 hover:underline">Créer un compte</Link>
    </p>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
