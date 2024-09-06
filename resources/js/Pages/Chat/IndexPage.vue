<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ChatMessage from "@/Components/chat/ChatMessage.vue";
import ChatInput from "@/Components/chat/ChatInput.vue";
import {onMounted, ref, toRefs} from "vue";
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

const lastUpdated = ref(new Date());
const announcedTime = ref(new Date());

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
            lastUpdated.value = new Date();
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


const showTime = (time) => {
    announcedTime.value = new Date(time);

    setTimeout(() => {
        announcedTime.value = null;
    }, 10000);
};

onMounted(async () => {
    refChat.value.scrollTop = refChat.value.scrollHeight;

    lastUpdated.value = new Date();

    /*Chat Subscribe*/
    window.Echo.channel('chat')
        .listen('ChatMessagePublished', (e) => {
            handleRefresh();
            console.log('New message received:', e);
        });

    /*Time Subscribe*/
    window.Echo.channel('time')
        .listen('TimeAnnounce', (e) => {
            showTime(e.time);
            console.log('New time received:', e);
        });
});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Chat</h2>
                <span v-if="announcedTime" class="text-amber-500 bounce-animation" v-text="`guk guk! saat: ${announcedTime.toLocaleTimeString()}`"></span>
            </div>
        </template>



        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-6 space-y-4 overflow-hidden shadow-sm sm:rounded-lg">
                    <!--Chat Refresh-->
                    <div>
                        <chat-refresh-button @refresh="handleRefresh"/>
                        <span class="last-updated" v-text="lastUpdated.toLocaleTimeString()"></span>
                    </div>

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

.last-updated{
    margin-left: 10px;
    font-size: 12px;
    color: #6b7280;
}

.bounce-animation {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-30px);
    }
    60% {
        transform: translateY(-15px);
    }
}

@media (prefers-color-scheme: dark) {
    .chat {
        background-color: #374151;
        color: white;
    }
}
</style>
