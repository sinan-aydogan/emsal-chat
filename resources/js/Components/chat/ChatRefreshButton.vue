<script setup>
defineEmits(['refresh'])
</script>

<template>
    <button @click="$emit('refresh')" type="button" class="button">Yenile</button>
</template>

<style scoped>
.button{
    width: fit-content;
    height: 36px;
    padding: 6px 10px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
}
</style>
