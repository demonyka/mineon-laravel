<template>
    <div class="navbar">
        <div class="nav-content">
            <Link :href="route('index.view')" class="title">MiNEON</Link>
            <div class="links">
                <Link :href="route('index.view')">Главная</Link>
                <a>Сервера</a>
                <a>Правила</a>
                <a>Новости</a>
            </div>
            <Link v-if="!this.$page.props.auth.user" :href="route('login.view')" style="padding: 10px 40px" class="btn-primary">Войти</Link>
        </div>
    </div>
</template>

<style scoped>
.navbar {
    border-radius: 30px;
    width: 80vw;
    position: relative;
    background-color: var(--gray2);
}
.nav-content {
    padding: 20px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.links {
    display: flex;
    align-items: center;
    gap: 40px;
    font-size: 20px;
}
a.title {
    font-size: 30px;
    margin: 0;
    font-weight: 500;
}
a.head {
    width: 40px;
    height: 40px;
    background-size: cover;
    border-radius: 10px;
}
</style>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    name: "Navbar",
    components: {
        Link,
    },
    methods: {
    }
}
</script>
