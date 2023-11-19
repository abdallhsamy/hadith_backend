import './bootstrap';
import feather from 'feather-icons';

feather.replace();


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
})
