<template>
    <Head :title="$page.props.auth.user.username" />
    <Navbar/>
    <div class="container">
        <div class="column">
            <div class="row">
                <h2>Персонализация</h2>
                <div class="skin3d">
                    <canvas ref="skinContainer"></canvas>
                    <form class="upload">
                        <button type="button" class="primary" style="width: 100%">Загрузить скин</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="column">
            <div class="row">
                <h2>{{ getGreeting() }}</h2>
                <div class="main-info">
                    <p>{{ getDayPassed() }}</p>
                    <p>Последний вход 1 сентября 1939г.</p>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="row">

            </div>
        </div>
    </div>
</template>

<style scoped>
    .container {
        position: relative;
        top: 40px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        width: 100%;
    }
    .column {
        width: calc(33% - 20px);
    }
    .row {
        width: calc(100% - 70px);
        background-color: var(--gray2);
        padding: 20px 40px;
        border-radius: 20px;
    }
    h2 {
        margin: 0;
        font-weight: 500;
        font-size: 22px;
    }
    p {
        margin: 0;
        font-size: 18px;
    }
    .main-info {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }
    .skin3d {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
        width: 100%;
    }
    .upload {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }
</style>

<script>
import { Head, Link } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import * as skinview3d from 'skinview3d';
import FlashMessage from "@/Components/FlashMessage.vue";

export default {
    name: "Cabinet",
    components: {
        FlashMessage,
        Navbar,
        Head,
        Link
    },
    data() {
        return {
            uploadMessage: {}
        }
    },
    methods: {
        getGreeting() {
            const currentTime = new Date();
            const currentHour = currentTime.getHours();
            const currentMonth = currentTime.getMonth() + 1;

            if (currentMonth === 12 && currentTime.getDate() === 31) {
                return `С Новым Годом, ${this.$page.props.auth.user.username}!🎄`;
            } else if (currentMonth === 1 && currentTime.getDate() === 4) {
                return `${this.$page.props.auth.user.username}, Ваш аккаунт заблокирован!⛔️`;
            } else if (currentHour >= 6 && currentHour < 12) {
                return `Доброе утро, ${this.$page.props.auth.user.username}!☀️`;
            } else if (currentHour >= 12 && currentHour < 18) {
                return `Хорошего дня, ${this.$page.props.auth.user.username}!🎈`;
            } else if (currentHour >= 18 && currentHour < 23) {
                return `Самое время отдохнуть, ${this.$page.props.auth.user.username}!🥂`;
            } else {
                return `Сидите допоздна, ${this.$page.props.auth.user.username}?🌙`;
            }
        },
        getDayPassed() {
            const currentDate = new Date();
            const startDate = new Date(this.$page.props.auth.user.created_at);
            const timeDiff = currentDate.getTime() - startDate.getTime();
            const daysPassed = Math.floor(timeDiff / (1000 * 3600 * 24));

            function pluralize(number, one, few, many) {
                if (number % 10 === 1 && number % 100 !== 11) {
                    return one;
                } else if ([2, 3, 4].includes(number % 10) && ![12, 13, 14].includes(number % 100)) {
                    return few;
                } else {
                    return many;
                }
            }

            const dayString = pluralize(daysPassed, 'день', 'дня', 'дней');

            return `Вы с нами уже ${daysPassed} ${dayString}`;
        },
        async loadSkin() {
            const skinPath = route('storage.get-skin', { username: this.$page.props.auth.user.username });

            const capePath = route('storage.get-cape', { username: this.$page.props.auth.user.username });

            await this.loadImage(skinPath);

            this.skinViewer = new skinview3d.SkinViewer({
                canvas: this.$refs.skinContainer,
                width: 450,
                height: 450,
                skin: skinPath,
                cape: capePath
            });

            this.skinViewer.autoRotate = false;
            this.skinViewer.autoRotateSpeed = 0.25;
            this.skinViewer.animation = new skinview3d.IdleAnimation();
            this.skinViewer.controls.enableZoom = false;
        },
        loadImage(url) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.onload = resolve;
                img.onerror = reject;
                img.src = url;
            });
        },
    },
    mounted() {
        this.loadSkin();
    }
}
</script>
