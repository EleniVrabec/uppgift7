document.addEventListener('DOMContentLoaded', function() {
    var colorItems = document.querySelectorAll('.color-variable-items-wrapper .variable-item');

    colorItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var color = item.getAttribute('data-value');
            switch(color) {
                case 'black':
                    item.style.backgroundColor = '#000000';
                    break;
                case 'blue':
                    item.style.backgroundColor = '#1e39bf';
                    break;
                case 'golden':
                    item.style.backgroundColor = '#c4b256';
                    break;
                default:
                    item.style.backgroundColor = '#ffffff'; // Default color
            }
            
            // Remove background color from other items
            colorItems.forEach(function(otherItem) {
                if (otherItem !== item) {
                    otherItem.style.backgroundColor = '';
                }
            });
        });
    });
});
