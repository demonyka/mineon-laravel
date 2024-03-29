<template>
    <Head title="Авторизация" />
    <Navbar/>
    <div class="container">
        <form @submit.prevent="formSubmit">
            <div class="title">
                <h2>{{ $page.props.app.name }}<small>ID</small></h2>
                <h3>Авторизация</h3>
            </div>
            <input
                required
                type="text"
                placeholder="Никнейм"
                autocomplete="username"
                maxlength="16"
                v-model="form.username"
                :class="{ 'error': !isEmptyJSON(form.errors) }"
            >
            <input
                required
                type="password"
                placeholder="Пароль"
                autocomplete="password"
                maxlength="64"
                v-model="form.password"
                :class="{ 'error': !isEmptyJSON(form.errors) }"
            >
            <p v-if="form.errors.password" class="error-message">{{ form.errors.password }}</p>
            <button class="primary" :class="{ 'process': form.processing }" :disabled="form.processing" style="width: 100%" type="submit">
                Войти
            </button>
            <div class="media">
                <a class="telegram"/>
            </div>
        </form>

        <div class="auth-links">
            <a style="">Ещё нет аккаунта?</a>
            <a style="">Забыли пароль?</a>
        </div>
    </div>
</template>

<style scoped>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        top: 50px;
        position: relative;
        width: 30%;
    }
    form {

        background-color: var(--gray2);
        padding: 20px;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
    }
    form .title {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }
    form .title h2 {
        display: flex;
        margin: 0;
        font-weight: 600;
    }
    form .title h2 small {
        font-size: 16px;
    }
    form .title h3 {
        margin: 0;
        font-weight: 500;
    }
    .media {
        display: flex;
        align-items: center;
        justify-content: space-around;
        width: 100%;
    }
    .auth-links {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: space-around;
    }
    .media a {
        width: 48px;
        height: 48px;
    }
    .media a.telegram {
        background-image: url("/storage/media/telegram.svg");
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<script>
import { Head, Link, useForm } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import { isEmptyJSON } from '@/utils.js';

export default {
    name: "Login",
    components: {
        Navbar,
        Head,
        Link
    },
    data() {
        return {
            form: useForm({
                username: '',
                password: '',
            }),
        }
    },
    methods: {
        isEmptyJSON,
        formSubmit() {
            this.form.post(route('login.store'), {
                onFinish: () => this.form.reset('password'),
            });
        }
    }
}
</script>
