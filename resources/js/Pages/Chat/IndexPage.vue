<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ChatMessage from "@/Components/chat/ChatMessage.vue";
import ChatInput from "@/Components/chat/ChatInput.vue";
import {onMounted, ref, toRefs, watch, watchEffect} from "vue";
import {router, useForm} from "@inertiajs/vue3";
import ChatRefreshButton from "@/Components/chat/ChatRefreshButton.vue";

const props = defineProps({
    messages: {
        type: Array,
        required: true,
        default: () => [],
    },
});

const {messages} = toRefs(props);

const form = useForm({
    content: "",
});

const refChat = ref(null);

const handleRefresh = () => {
    router.reload({
        preserveScroll: true,
        only: ['messages'],
        onSuccess: () => {
            refChat.value.scrollTop = refChat.value.scrollHeight;
        },
    });
};

const handleSendMessage = () => {

    form.post(route("chat.store"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            refChat.value.scrollTop = refChat.value.scrollHeight;
        },
    });
};

onMounted(() => {
    refChat.value.scrollTop = refChat.value.scrollHeight;
});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Chat</h2>
        </template>



        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-6 space-y-4 overflow-hidden shadow-sm sm:rounded-lg">
                    <!--Chat Refresh-->
                    <chat-refresh-button @refresh="handleRefresh"/>

                    <!--Chat Body-->
                    <div class="chat" ref="refChat">
                        <chat-message v-for="message in messages" v-bind:message="message" :key="message.id"/>
                    </div>

                    <!--Chat Input-->
                    <chat-input v-model="form.content" @submit="handleSendMessage"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.chat {
    height: 500px;
    overflow-y: scroll;
    padding: 20px;
    scroll-behavior: smooth;
}

@media (prefers-color-scheme: dark) {
    .chat {
        background-color: #374151;
        color: white;
    }
}
</style>
