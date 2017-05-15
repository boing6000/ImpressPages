/**
 * @package ImpressPages
 *
 */

(function ($) {
    "use strict";

    var methods = {

        pixabay: 'https://pixabay.com/api?key=5341648-daac6fe2420b5fee8b25671aa&lang=pt',
        container: '#ipsModuleRepositoryTabBuyContainer',

        init: function (options) {

            return this.each(function () {
                var $this = $(this);
                var buyTab = this;

                var data = $this.data('ipRepositoryBuy');
                if (!data) {
                    $this.data('ipRepositoryBuy', {});

                    var $popup = $('.ipsModuleRepositoryPopup');

                    $(window).bind("resize.ipRepositoryBuy", $.proxy(methods._resize, this));
                    $popup.bind('ipModuleRepository.close', $.proxy(methods._teardown, this));

                    $popup.find('.ipsBrowserPixabay').on('submit', function (e) {
                        e.preventDefault();
                        methods._getImages();
                    });

                    methods._getImages();
                    $.proxy(methods._resize, this)();
                }
            });
        },

        _getImages: function(page){
            var $this = $(this);
            var term = $('.ipsBrowserPixabay .ipsTerm').val() || null;
            var $container = $('.pixabayImages');
            page = page || 1;

            methods._setTitle(term);

            $.ajax({
                cache: true,
                url: methods.pixabay + '&page=' + page +"&q="+encodeURIComponent(term),
                dataType: "json",
                success: function(data) {
                    if (parseInt(data.totalHits) > 0) {
                        $container.empty();
                        $.each(data.hits, function (i, hit) {
                            /*
                             <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                             <a class="thumbnail" href="#">
                             <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                             </a>
                             </div>
                             */
                            //$('.pixabayImages').append();
                            var $col = $('<div class="thumb" style="display: inline-block; margin: 5px 29px;"></div>');
                            var $a = $('<a class="thumbnail" href="#" data-image="'+hit.webformatURL+'"></a>');
                            var $img = $('<img class="img-responsive" src="'+hit.previewURL+'" alt="'+hit.tags+'">');

                            $container.append($col.append($a.append($img)));
                        });

                        $('.pixabayImages .thumbnail').on('click', function () {
                            var img = {
                                downloadUrl: $(this).data('image'),
                                title: $(this).find('img').attr('alt')
                            };
                            Market.processOrder({images: [img]});
                        });

                        $(document.body).bind('ipMarketOrderComplete', function (e, data) {
                            if (typeof (data.images) !== undefined && data.images.length) {
                                $.proxy(methods._confirm, $this, data.images)();
                            } else {
                                $.proxy(methods._confirm, $this, [])();
                            }
                        });

                        methods._setPagination(data.total, 20, page);
                    }else {
                        console.log('No hits');
                    }
                }
            });
        },

        _setPagination: function(total, perPage, current){
            // <li><a href="#">1</a></li>
            var $this = this;
            var $pagination = $('.ipsModuleRepositoryPopup .pagination');
            var totalPages = Math.ceil(total/perPage);

            $pagination.empty();
            console.log($pagination)

            for(var i = 1; i <= totalPages; i++){
                if(current !== i){
                    $pagination.append(' <li><a href="#" data-page="'+i+'">'+i+'</a></li>');
                }else{
                    $pagination.append(' <li class="active"><a href="#" data-page="'+i+'">'+i+'</a></li>');
                }
            }

            $('.ipsModuleRepositoryPopup .pagination a').bind('click', function(e){
                $.proxy(methods._getImages, $this, $(this).data('page'))();
            })

        },

        _setTitle: function(query){
            var $container = $('.pixabay');
            var title = query === null ? 'Imagens Populares' : 'Resultados para: ' + query;

            $container.find('.page-header').html(title);
        },

        _confirm: function (files) {
            var $this = $(this);
            $('.ipsLoading').addClass('hidden');
            $('.ipsModuleRepositoryPopup').trigger('ipModuleRepository.confirm', [files]);
        },

        // set back our element
        _teardown: function () {
            $(window).unbind('resize.ipRepositoryBuy');
        },

        _resize: function (e) {
            var $popup = $('.ipsModuleRepositoryPopup');
            var $block = $popup.find('.pixabay');
            var tabsHeight = parseInt($popup.find('.ipsTabs').outerHeight());
            $block.outerHeight((parseInt($(window).height()) - tabsHeight));
        }

    };

    $.fn.ipRepositoryBuy = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.ipRepositoryBuy');
        }

    };

})(jQuery);
