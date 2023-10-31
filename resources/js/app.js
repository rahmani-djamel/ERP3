import './bootstrap';
import Alpine from 'alpinejs'
import 'flowbite';

import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
 

import persist from '@alpinejs/persist'

import { Modal } from 'flowbite';



window.Alpine = Alpine
Alpine.plugin(persist)

Alpine.start()
