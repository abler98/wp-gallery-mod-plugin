(function ($) {

    var $gallery = $('.gallery'),
        $window = $(window),
        interval = 1000,
        size = 10;

    $gallery.masonry({
        itemSelector: '.gallery-item',
        columnWidth: '.gallery-item',
        percentPosition: true
    });

    $(function () {
        $gallery.each(function () {
            var start = 0; // Показ первых 10-ти изображений
            showGalleryItems(this, start);
        });
    });

    setInterval(function () {
        $gallery.each(function () {
            if (($window.scrollTop() + $window.outerHeight()) >= ($(this).outerHeight() + $(this).offset().top)) {
                var start = parseInt($(this).data('current'));
                showGalleryItems(this, start);
            }
        })
    }, interval);

    function showGalleryItems(gallery, start) {
        if ($(gallery).find('.gallery-item').length > start) {
            var items = $(gallery).find('.gallery-item').slice(start, start + size);
            $(gallery).data('current', start + items.length);
            items.each(function () {
                var img = $(this).find('img').first();
                img.attr('src', img.attr('data-src'));
            });
            items.addClass('active');
            $(gallery).masonry();
        }
    }

})(jQuery);