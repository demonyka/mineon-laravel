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
            <button class="telegram primary" :class="{ 'process': form.processing }" :disabled="form.processing">Войти через
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <path d="M41.4193 7.30899C41.4193 7.30899 45.3046 5.79399 44.9808 9.47328C44.8729 10.9883 43.9016 16.2908 43.1461 22.0262L40.5559 39.0159C40.5559 39.0159 40.3401 41.5048 38.3974 41.9377C36.4547 42.3705 33.5408 40.4227 33.0011 39.9898C32.5694 39.6652 24.9068 34.7955 22.2086 32.4148C21.4531 31.7655 20.5897 30.4669 22.3165 28.9519L33.6487 18.1305C34.9438 16.8319 36.2389 13.8019 30.8426 17.4812L15.7331 27.7616C15.7331 27.7616 14.0063 28.8437 10.7686 27.8698L3.75342 25.7055C3.75342 25.7055 1.16321 24.0823 5.58815 22.459C16.3807 17.3729 29.6555 12.1786 41.4193 7.30899Z" fill="white"/>
                </svg>
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
