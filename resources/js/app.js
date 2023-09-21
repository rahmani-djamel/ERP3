import './bootstrap';
import Alpine from 'alpinejs'
import 'flowbite';

import persist from '@alpinejs/persist'

window.Alpine = Alpine
Alpine.plugin(persist)

Alpine.start()
