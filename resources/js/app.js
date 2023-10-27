import './bootstrap';
import Alpine from 'alpinejs'
import 'flowbite';

import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
 

import persist from '@alpinejs/persist'


window.Alpine = Alpine
Alpine.plugin(persist)

Alpine.start()
