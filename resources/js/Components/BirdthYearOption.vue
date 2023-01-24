<script setup>
import { ref, onMounted } from 'vue'

const yearsList = ref([])

const getYearsList = () => {
    const startYear = 1924;
    const endYear = new Date().getFullYear() - 11;
    for (let i = startYear; i <= endYear; i++) {
        yearsList.value = [...yearsList.value, i]
    }
}

onMounted(() => {
  getYearsList()
})

</script>

<template>
        <option v-for="(year, y) in yearsList" :key="y" :value="year">
          {{year}}
        </option>
</template>