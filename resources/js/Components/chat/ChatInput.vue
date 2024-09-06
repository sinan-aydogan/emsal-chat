<script setup lang="ts">
import {computed, ref, toRefs} from "vue";

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
        default: '',
    },

})
const {modelValue} = toRefs(props)

defineEmits(['update:modelValue','submit'])

const isDisabled = computed(() => 10>modelValue.value?.length)
</script>

<template>
    <div class="wrapper">
        <textarea :value="modelValue"  @keydown.enter="!isDisabled ? $emit('submit') : null" @input="(e)=>$emit('update:modelValue', e.target.value)" class="input" placeholder="Mesajınızı buraya yazınız..."></textarea>
        <button @click="$emit('submit') " :disabled="isDisabled" class="submit-button">Gönder</button>
    </div>
</template>

<style scoped>
.wrapper {
    display: flex;
    flex-direction: column;
    align-items: end;
}

.input {
    width: 100%;
    height: 64px;
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.submit-button{
    width: fit-content;
    height: 36px;
    padding: 6px 10px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
}

.submit-button:disabled {
    opacity: 0.5;
    pointer-events: none;
}

/*Dark Mode*/
@media (prefers-color-scheme: dark) {
    .input {
        background-color: #374151;
        color: white;
    }

    ::placeholder {
        color: #ccc;
        opacity: 1;
    }
}
</style>
