<script>
export default {
    name: "FlashMessage",
    data() {
        return {
            isVisible: false
        };
    },
    mounted() {
        setTimeout(() => {
            this.isVisible = true;
        }, 100);
        setTimeout(() => {
            this.isVisible = false;
        }, 5000);
    }
}
</script>

<template>
    <transition name="fade">
        <div v-if="isVisible" class="flash" :class="`${$page.props.flash.message.type}`">
            {{ $page.props.flash.message.text }}
        </div>
    </transition>
</template>

<style scoped>
    .flash {
        position: fixed;
        padding: 30px;
        right: 50%;
        transform: translateX(50%);
        bottom: 20px;
        background-color: var(--gray2);
        border-radius: 20px;
        color: var(--white);
        max-width: 40vw;
        text-align: center;
    }
    .flash.success {
        background-color: var(--green1);
    }
</style>
