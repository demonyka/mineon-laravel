<template>
    <transition-group name="fade">
        <div v-if="isSecurityOpen">
            <h2>Безопасность</h2>
            <div class="main-info">
                <button @click="openChangePassword" class="primary">Смена пароля</button>
                <button disabled class="primary">Привязать Telegram</button>
                <button @click="$inertia.visit(route('auth.logout'))" class="primary">Выход</button>
            </div>
        </div>
        <div v-else-if="isChangePassword">
            <h2 class="opener">Смена пароля
                <span @click="closeChangePassword">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 8L8 16M8.00001 8L16 16" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </h2>
            <form @submit.prevent="formSubmit" class="main-info">
                <input style="display: none" autocomplete="username" :value="$page.props.auth.user.username">
                <input
                    required
                    type="password"
                    placeholder="Текущий пароль"
                    autocomplete="current-password"
                    minlength="8"
                    maxlength="64"
                    v-model="form.password"
                    :class="{ 'error': form.errors.password }"
                >
                <input
                    required
                    type="password"
                    placeholder="Новый пароль"
                    autocomplete="new-password"
                    minlength="8"
                    maxlength="64"
                    v-model="form.new_password"
                    :class="{ 'error': form.errors.new_password }"
                >
                <p style="text-align: center" v-if="form.errors.password" class="error-message">{{ form.errors.password }}</p>
                <p style="text-align: center" v-else-if="form.errors.new_password" class="error-message">{{ form.errors.new_password }}</p>
                <button type="submit" class="primary">Изменить пароль</button>
            </form>
        </div>
    </transition-group>
</template>

<style scoped>
    h2.opener {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    h2.opener span {
        cursor: pointer;
        display: flex;
        align-items: center;
    }
    h2.opener span:hover {
        opacity: .8;
        scale: 1.2;
    }
    h2.opener span:active {
        opacity: .8;
        scale: .9;
    }
</style>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    name: "Security",
    data() {
        return {
            isSecurityOpen: true,
            isChangePassword: false,
            form: useForm({
                _token: this.$page.props.csrf_token,
                password: '',
                new_password: ''
            }),
        }
    },
    methods: {
        openChangePassword() {
            this.isSecurityOpen = false;
            setTimeout(() => {
                this.isChangePassword = true;
            }, 350);
        },
        closeChangePassword() {
            this.isChangePassword = false;
            setTimeout(() => {
                this.isSecurityOpen = true;
            }, 350);
        },
        formSubmit() {
            this.form.post(route('change-password.store'), {
                onFinish: () => this.form.reset('password', 'new_password'),
                onSuccess: () => {
                    this.closeChangePassword();
                    this.form.reset('password', 'new_password');
                }
            });
        },
    }
}
</script>
