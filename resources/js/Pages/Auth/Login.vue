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
                minlength="3"
                maxlength="16"
                v-model="form.username"
                :class="{ 'error': form.errors.username }"
            >
            <input
                required
                type="password"
                placeholder="Пароль"
                autocomplete="password"
                minlength="8"
                maxlength="64"
                v-model="form.password"
                :class="{ 'error': form.errors.password }"
            >
            <p v-if="form.errors.password" class="error-message">{{ form.errors.password }}</p>
            <button class="primary" :class="{ 'process': form.processing }" :disabled="form.processing" style="width: 50%; margin-top: 10px" type="submit">
                Войти
            </button>
        </form>

        <div class="auth-links">
            <Link :href="route('register.view')">Ещё нет аккаунта?</Link>
            <Link :href="route('forgot-password.view')">Забыли пароль?</Link>
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
    .telegram {
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
    }
    .telegram svg {
        width: 24px;
    }
    .auth-links {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: space-around;
    }
</style>

<script>
import { Head, Link, useForm } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";

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
                _token: this.$page.props.csrf_token,
                username: '',
                password: ''
            }),
        }
    },
    methods: {
        formSubmit() {
            this.form.post(route('login.store'), {
                onFinish: () => this.form.reset('password'),
            });
        },
    }
}
</script>
