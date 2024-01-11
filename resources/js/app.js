import './bootstrap';
import 'flowbite';
import 'flowbite-datepicker';
import 'flowbite/dist/datepicker.turbo.js';
import Chart from 'chart.js/auto';

import Alpine from 'alpinejs';

window.Chart = Chart; 
window.Alpine = Alpine;

Alpine.start();
