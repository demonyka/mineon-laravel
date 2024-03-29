<template>
    <Head title="Главная" />
    <Navbar/>
</template>

<style scoped>

</style>

<script>
import { Head, Link } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";

export default {
    name: "Index",
    components: {
        Navbar,
        Head,
        Link
    }
}
</script>
