import './bootstrap';
import feather from 'feather-icons';
import Alpine from 'alpinejs'

feather.replace();


window.Alpine = Alpine
Alpine.start()



addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.app-bar-item').forEach(function (item) {
        if(item.getAttribute('href') === window.location.href) {
            item.classList.add('text-primary');
            item.classList.remove('text-gray-500');
        } else {
            item.classList.remove('text-primary');
            item.classList.add('text-gray-500');
        }
    })

    document.querySelectorAll('.sidenav > ul > li > a').forEach(function (item) {
        console.log('item.getAttribute(\'href\') :', item.getAttribute('href'))
        console.log('window.location.href : ', window.location.href)
        if (item.getAttribute('href') === window.location.href) {
            item.parentElement.classList.add('active')
        }
    });

})

