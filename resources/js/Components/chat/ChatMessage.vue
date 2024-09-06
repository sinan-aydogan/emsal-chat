<script setup lang="ts">
defineProps({
    message: {
        type: Object,
        required: true,
        default: () => ({
            id: null,
            content: '',
            user: {
                id: null,
                name: '',
            }
        })
    },
});
</script>

<template>
    <div v-if="message?.id" :id="message.id" class="chat-message__wrapper">
        <!--User-->
        <span content="chat-message__user" v-text="message.user.name"></span>

        <!--Content-->
        <span content="chat-message__content" v-text="message.content"></span>
    </div>
</template>

<style scoped>
.chat-message__wrapper {
    display: flex;
    align-content: center;
    justify-content: space-between;
    border: 1px solid #ccc;
    margin-bottom: 12px;
    padding: 12px;
    border-radius: 6px;
}
</style>
