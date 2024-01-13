import './bootstrap';
import { createApp } from 'vue';
import ScanComponent from './components/ScanComponent.vue';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
const app = createApp({
    components: {
        ScanComponent,
    },
}).mount('#app');