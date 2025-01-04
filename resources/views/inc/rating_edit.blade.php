@for ($i = 1; $i <$rating+1; $i++)<span id="{{ $i }}" class="rate-item rate-input fa fa-2x fa-star checked"></span> @endfor
    @for ($i = $rating+1; $i <8; $i++)<span id="{{ $i }}" class="rate-item rate-input fa fa-2x fa-star"></span> @endfor
        <script>
            $('.rate-input').click(function(e) {
                $(".rate-input").removeClass("checked");
                var index = $(this).index();

                var rating = index + 1;

                for (var i = 0; i < rating; i++) {
                    var id = $('.rate-input')[i].id
                    $('#' + id).addClass('checked')
                }
                document.getElementById('rating').value = rating;

            })

        </script>
