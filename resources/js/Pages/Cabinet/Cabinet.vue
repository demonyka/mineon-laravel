<template>
    <Head :title="$page.props.auth.user.username" />
    <Navbar/>
    <transition name="fade">
        <div v-if="uploadMessage.message" id="uploadMessage" class="flash" :class="`${uploadMessage.type}`">
            {{ uploadMessage.message }}
        </div>
    </transition>
    <div class="cabinet">
        <div class="column">
            <div class="row">
                <h2>Персонализация</h2>
                <div class="skin3d">
                    <canvas ref="skinContainer"></canvas>
                    <div class="upload">
                        <input @change="handleFileUpload('skin')" ref="skinInput" type="file" accept="image/png" style="display: none">
                        <button :disabled="isLoading.skin" @click="triggerFileInput('skinInput')" type="button" class="primary" style="width: 100%">Загрузить скин</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="row">
                <h2>{{ getGreeting() }}</h2>
                <div class="main-info">
                    <p>{{ getDayPassed() }}</p>
                    <p>Последний вход {{ formatDate($page.props.auth.user.last_login) }}</p>
                </div>
            </div>
        </div>
        <div class="column">
            <Balance/>
            <div class="row" style="min-height: 190px">
                <Security/>
            </div>

        </div>
    </div>
</template>

<style scoped>
@media screen and (max-width: 1150px) {
    canvas {
        width: 250px !important;
        height: 250px !important;
    }
}
</style>

<script>
import { Head, Link } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import * as skinview3d from 'skinview3d';
import FlashMessage from "@/Components/FlashMessage.vue";
import Security from "@/Pages/Cabinet/Components/Security.vue";
import Balance from "@/Pages/Cabinet/Components/Balance.vue";

export default {
    name: "Cabinet",
    components: {
        Security,
        Balance,
        FlashMessage,
        Navbar,
        Head,
        Link
    },
    data() {
        return {
            uploadMessage: {},
            isLoading: {
                skin: false,
                cape: false
            },
        }
    },
    methods: {
        formatDate(date) {
            const months = [
                'января', 'февраля', 'марта',
                'апреля', 'мая', 'июня',
                'июля', 'августа', 'сентября',
                'октября', 'ноября', 'декабря'
            ];

            const formattedDate = new Date(date);

            const day = formattedDate.getDate();
            const month = months[formattedDate.getMonth()];
            const year = formattedDate.getFullYear();
            const hours = formattedDate.getHours();
            const minutes = formattedDate.getMinutes();

            return `${day} ${month} ${year}г. в ${hours}:${minutes < 10 ? '0' : ''}${minutes}`;
        },
        setUploadMessage(text, type) {
            this.uploadMessage.message = text;
            this.uploadMessage.type = type;

            setTimeout(() => {
                this.uploadMessage = {}
            }, 5000);
        },
        handleFileUpload(type) {
            this.isLoading[type] = true;
            const file = event.target.files[0];
            if (!file) return this.isLoading[type] = false;
            if (!file.name.endsWith('.png')) {
                this.setUploadMessage('Файл должен быть в формате .png', 'error');
                this.isLoading[type] = false;
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const validDimensions = (img.width === 64 && img.height === 64) ||
                        (img.width === 64 && img.height === 32);
                    if (!validDimensions) {
                        this.isLoading[type] = false;
                        this.setUploadMessage('Размер изображения должен быть 64x64 или 64x32 пикселей', 'error');
                        return;
                    }
                    const formData = new FormData();
                    formData.append(type, file);

                    axios.post(route(`cabinet.${type}-upload`), formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        },
                    })
                        .then(response => {
                            this.isLoading[type] = false;
                            this.loadSkin();
                            this.setUploadMessage(response.data.success, 'success');
                        })
                        .catch(error => {
                            this.isLoading[type] = false;
                            this.setUploadMessage(error.response.data[type], 'error');
                        });
                };
                img.onerror = () => {
                    this.isLoading[type] = false;
                    this.setUploadMessage('Произошла ошибка при загрузке файла', 'error');
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        triggerFileInput(refName) {
            this.$refs[refName].click();
        },
        getGreeting() {
            const currentTime = new Date();
            const currentHour = currentTime.getHours();
            const currentMonth = currentTime.getMonth() + 1;
            if (currentMonth === 12 && currentTime.getDate() === 31) {
                return `С Новым Годом, ${this.$page.props.auth.user.username}!🎄`;
            } else if (currentMonth === 4 && currentTime.getDate() === 1) {
                return `Ваш аккаунт заблокирован!⛔️`;
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
