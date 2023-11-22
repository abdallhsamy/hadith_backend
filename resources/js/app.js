import './bootstrap';
import feather from 'feather-icons';
import Alpine from 'alpinejs'
// import { ar_SA, en_US } from "gridjs/l10n";
import {Grid, html} from "gridjs";


feather.replace();

window.Grid = Grid
// window.ar_SA = ar_SA
window.Alpine = Alpine
window.gridHtml = html
Alpine.start()


addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.app-bar-item').forEach(function (item) {
        if (item.getAttribute('href') === window.location.href) {
            item.classList.add('text-primary');
            item.classList.remove('text-gray-500');
        } else {
            item.classList.remove('text-primary');
            item.classList.add('text-gray-500');
        }
    })

    document.querySelectorAll('.sidenav > ul > li > a').forEach(function (item) {
        if (item.getAttribute('href') === window.location.href) {
            item.parentElement.classList.add('active')
        }
    });

})

