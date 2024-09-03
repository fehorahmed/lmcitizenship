@section('cusjs')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();
            $(window).ready(function () {
                $('#range, #price_sort, #material').on('click', function () {
                    var category_path = $('input[name="category_path"]').val();

                    var category = $('input[name="category"]').val();
                    var category_seo_url = $('input[name="category_seo_url"]').val();
                    var category_id = $('input[name="category_id"]').val();
                    var pages = $('input[name="pages"]').val();

                    var search_key = $('input[name="search_key"]').val();

                    var minprice = $('input[name="range"]:checked').data('minprice');
                    var maxprice = $('input[name="range"]:checked').data('maxprice');
                    var field = $('input[name="price_sort"]:checked').data('field');
                    var type = $('input[name="price_sort"]:checked').data('type');

                    var material = $('input[name="material"]:checked').val();

                    //alert(field);

                    var limit = 24;

                    //alert(offset);

                    var filters = {
                        'category_id': category_id,
                        'pages': pages,
                        'search_key': search_key,
                        'minprice': minprice,
                        'maxprice': maxprice,
                        'field': field,
                        'type': type,
                        'material': material,
                        'limit': limit
                    };

                    $.ajax({
                        //url: baseurl + '/search_product?search_key=' + data.search_key + '&minprice=' + data.minprice + '&maxprice=' + data.maxprice + '&field=' + data.field + '&type=' + data.type + '&material=' + data.material + '&limit=' + data.limit + '&offset=' + data.offset,
                        url: baseurl + '/' + category_path,
                        method: 'get',
                        data: filters,
                        success: function (data) {

                            window.location.replace(baseurl + '/' + category_path + '?category_id=' + filters.category_id
                                + '&search_key=' + filters.search_key
                                + '&minprice=' + filters.minprice
                                + '&maxprice=' + filters.maxprice
                                + '&field=' + filters.field
                                + '&type=' + filters.type
                                + '&material=' + filters.material
                                + '&limit=' + filters.limit
                                + '&pages=' + filters.pages
                            );
                        },
                        error: function () {
                            showError('Sorry. Try reload this page and try again.');
                            processing.hide();
                        }
                    });
                });
            });
        });
    </script>
@endsection
