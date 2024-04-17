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

</style>
