@extends('frontend.layouts.app')

@section('content')
    <?php $tksign = '&#2547; '; ?>
    <div class="container">
        <div class="row">
            <div class="breadcrumb-warp section-margin-two">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <?php
                        if (Request::segment(1) == 'search') {
                            $page_name = 'Search Results';
                        } else {
                            $page_name = get_term_info(Request::segment(2), 'name', $key = true);
                        }

                        $breadcrumbs = new Creitive\Breadcrumbs\Breadcrumbs;

                        $breadcrumbs->setDivider(' » &nbsp;');
                        $breadcrumbs->addCrumb('Home', url('/'))
                            ->addCrumb($page_name, 'product');
                        echo $breadcrumbs->render();
                        ?>
                    </div>
                    <!-- breadcrumb  end-->
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumb-area end  -->

    <div class="main-banner-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    @include('frontend.products.category_sidebar')
                </div>
                <!--breadcrumb-section start-->
                <div class="col-md-9 col-sm-9">
                  <div class="">
                    <div class="identify-product">
                      <div class="col-md-6">
                            <div class="identify">
                                <h1>Solid Wooden Door</h1>
                             </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-cat-icone">
                                <ul class="list-unstyled">
                                    <li><a href="#"><img src="http://103.218.26.178:2145/rfldoor/storage/uploads/fullsize/2018-07/2.png" alt=""></a></li>
                                    <li><a href="#"><img src="http://103.218.26.178:2145/rfldoor/storage/uploads/fullsize/2018-07/1.png" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                     </div>
                    </div>

                    <div class="category-product">
                        <div class="">
                            <?php $i = 1; ?>
                            <div class="exc-item-warp exc-prdt-warp  category-item">
                                @if(!empty($products))

                                    @foreach ($products as $item)

                                        <?php //dd($item->id); ?>
                                        <div class="category-col col-md-3 col-sm-6 col-xs-12">
                                            <div class="singele-exc-prdt">
                                                <div class="compare">
                                                    <a href="javascript:void(0)"
                                                       class="compare-btn"
                                                       onclick="add_to_compare(
                                                               '{{ $item->id }}',
                                                               '{{ $item->product_code }}',
                                                               '{{ $item->seo_url }}');">
                                                        <i class="fa fa-balance-scale"></i>
                                                    </a>
                                                </div>
                                                <div class="exc-prdt-img">
                                                    <a href="{!! product_seo_url($item->seo_url) !!}">

                                                        <?php
                                                        $images = explode(',', $item->images);
                                                        $imgs = App\Image::find($images);
                                                        ?>

                                                        <img src="{{ get_first_product_image($item->id, $item) }}"
                                                             alt="{{ !empty($imgs) ? $imgs[0]['original_name'] : '' }}"/>

                                                    </a>
                                                </div>
                                                <div class="exc-prdt-text">
                                                    <h3>

                                                        <a href="{!! product_seo_url($item->seo_url) !!}">
                                                            {{ $item->sub_title }}
                                                        </a>
                                                        <br/>
                                                        <a class="cat-nane" href="{!! product_seo_url($item->seo_url) !!}">
                                                            {{ $item->title }}
                                                        </a>

                                                    </h3>

                                                    <?php
                                                    $regularprice = $item->local_selling_price;
                                                    $save = ($item->local_selling_price * $item->local_discount) / 100;
                                                    $sp = $regularprice - $save;
                                                    ?>

                                                    <h2>
                                                        <a href="{!! seo_url_by_id($item->id) !!}">

                                                            {!! $tksign . number_format($regularprice) !!}

                                                            @if($item->unit == env('SFT'))
                                                                <span class="unit_p">/sft</span>
                                                            @elseif($item->unit == env('CFT'))
                                                                <span class="unit_p">/cft</span>
                                                            @elseif($item->unit == env('PIECE'))
                                                                <span class="unit_p">/pcs</span>
                                                            @endif

                                                        </a>
                                                    </h2>
                                                    <div class="product-btn">

                                                        <div class="buy-btn">
                                                            @if($item->unit == env('SFT') || $item->unit == env('CFT'))

                                                            @else
                                                                <a type="button"
                                                                   id="buynow"
                                                                   href="javascript:void(0)"
                                                                   class="buy-now"
                                                                   onclick="add_to_cart(
                                                                           '{{ $item->id }}',
                                                                           '{{ $item->product_code }}',
                                                                           '{{ $item->sku }}',
                                                                           '{{ $item->local_selling_price }}',
                                                                           '{{ $save }}',
                                                                           '{{ $sp }}',
                                                                           '{{ $item->delivery_charge }}',
                                                                           null,
                                                                           1);">
                                                                    <i class="fa fa-shopping-cart"></i> Buy
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="detalis-btn">
                                                            <a href="{!! product_seo_url($item->seo_url) !!}">
                                                                details </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                    if (!empty(app('request')->input('q'))) {
                        echo pagination(
                            $products_count,
                            24,
                            app('request')->input('pages'),
                            '?q=' . app('request')->input('q') .
                            '&limit=' . app('request')->input('limit') . '&');
                    } else {
                        echo pagination(
                            $products_count,
                            24,
                            app('request')->input('pages'),
                            '?category_id=' . $category_id .
                            '&search_key=undefined' .
                            '&minprice=' . (!empty(app('request')->input('minprice')) ? app('request')->input('minprice') : 'undefined') .
                            '&maxprice=' . (!empty(app('request')->input('maxprice')) ? app('request')->input('maxprice') : 'undefined') .
                            '&field=' . (!empty(app('request')->input('field')) ? app('request')->input('field') : 'undefined') .
                            '&type=' . (!empty(app('request')->input('type')) ? app('request')->input('type') : 'undefined') .
                            '&material=' . (!empty(app('request')->input('material')) ? app('request')->input('material') : 'all') .
                            '&limit=' . (!empty(app('request')->input('limit')) ? app('request')->input('limit') : 24) . '&');
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
@endsection
@include('frontend.products.search_js')