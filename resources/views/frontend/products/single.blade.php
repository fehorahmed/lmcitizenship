@extends('frontend.layouts.app')

@section('content')
    <?php $tksign = '&#2547; '; ?>

    <div class="container">
        <div class="row">
            <div class="breadcrumb-warp section-margin-two">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <?php
                        $breadcrumbs = new Creitive\Breadcrumbs\Breadcrumbs;

                        $breadcrumbs->setDivider(' » &nbsp;');
                        $breadcrumbs->addCrumb('Home', url('/'))
                            ->addCrumb($product->title, 'product');
                        echo $breadcrumbs->render();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <section class="prosuct-view-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="picZoomer">
                        <img src="{{ get_first_product_image($product->id, $product) }}" alt="{{ $product->title }}"/>
                    </div>
                    <ul class="piclist">
                        <?php
                        $all_img = get_all_product_image($product);
                        foreach ($all_img as $img) :
                            echo '<li><img src="' . $img . '"/></li>';
                        endforeach;
                        ?>
                    </ul>
                </div>

                <div class="col-md-6">
                    <div class="single-product-det one-header-det-pdt1">

                        <div class="sl-pdt-det-header">
                            <h4>{!! $product->sub_title !!}</h4>
                            <h2><strong>{!! $product->title !!}</strong></h2>

                            <div class="price">

                                @if($product->discount == null)
                                    <h5>
                                        Price:
                                        <span class="higileight">
                                            {{ $tksign . number_format($product->local_selling_price) }}
                                        </span>

                                        @if($product->unit == env('SFT'))
                                            <span class="unit_p">/sft</span>
                                        @elseif($product->unit == env('CFT'))
                                            <span class="unit_p">/cft</span>
                                        @elseif($product->unit == env('PIECE'))
                                            <span class="unit_p">/pcs</span>
                                        @endif
                                    </h5>
                                @else
                                    <h4>
                                        Regular Price: <span> {{ $tksign . $product->local_selling_price }}</span>
                                    </h4>
                                    <h5>
                                        <span style="color: blue;">({{ $product->local_discount }}%)</span>
                                        Discounted Price:
                                        <span class="higileight"> {{ $tksign . discounted_price($product, NULL) }}</span>
                                        <small>
                                            (Save {{ $tksign . save_price($product, FALSE) }})
                                        </small>
                                    </h5>
                                @endif

                            </div>
                        </div>
                        <div class="sl-pdt-det-body">
                            <div class="sl-pdt-det-list">
                                <ul>
                                    @if($product->material !== null)
                                        <li>
                                            <b>Material:</b>
                                            <span> {{ $product->material }}</span>
                                        </li>
                                    @endif
                                    @if($product->product_code !== null)
                                        <li>
                                            <b>Product Code:</b>
                                            <span>{{ $product->product_code }}</span>
                                        </li>
                                    @endif
                                    @if($product->color !== null)
                                        <li>
                                            <b>Color:</b> <span> {{ $product->color }}</span>
                                        </li>
                                    @endif
                                    <li>
                                        <b>Delivery Area:</b> <span>{{ $product->delivery_area }}</span>
                                    </li>
                                    <li>
                                        <b>Delivery Times:</b> <span> {{ $product->delivery_time }}</span>
                                    </li>
                                    @if($product->opening_system !== null)
                                        <li>
                                            <b>Opening System:</b>
                                            <span>{{ get_term_info($product->opening_system, 'name') }}</span>
                                        </li>
                                    @endif
                                    @if($product->size !== null)
                                        <li>
                                            <b>Size:</b> <span>{{ get_term_info($product->size, 'name') }}</span>
                                        </li>
                                    @endif
                                    @if($product->locking_system !== null)
                                        <li>
                                            <b>Locking System:</b>
                                            <span>{{ get_term_info($product->locking_system, 'name') }}</span>
                                        </li>
                                    @endif
                                    @if($product->part_palla !== null)
                                        <li>
                                            <b>Part/Palla:</b>
                                            <span>{{ get_term_info($product->part_palla, 'name') }}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>


                            <div class="quantity-number">
                                <label>
                                    <b>
                                        @if($product->unit == env('SFT'))
                                            <span title="W = Width & L = Length">W x L:</span>
                                        @elseif($product->unit == env('CFT'))
                                            <span title="T = Thickness, W = Width & L = Length">T x W x L:</span>
                                        @endif
                                    </b>
                                </label>
                                <div class="quantity-number-btn1">
                                    @if($product->unit == env('SFT'))
                                        <input type="number" id="width" name="width" class="width"/>&nbsp;&nbsp; x
                                        &nbsp;&nbsp;
                                        <input type="number" id="length" name="length" class="length"/> &nbsp;&nbsp; =
                                        &nbsp;&nbsp;
                                        <input type="text" id="show_unit_values" name="show_unit_values"
                                               class="show_unit_values" value="" readonly="readonly"/>&nbsp;&nbsp; SFT
                                    @elseif($product->unit == env('CFT'))
                                        <input type="number" id="width_c" name="width" class="width"/>&nbsp;&nbsp; x
                                        &nbsp;&nbsp;
                                        <input type="number" id="length_c" name="length" class="length"/>&nbsp;&nbsp; x
                                        &nbsp;&nbsp;
                                        <input type="number" id="thickness_c" name="thickness" class="thickness"/>
                                        &nbsp;&nbsp; = &nbsp;&nbsp;
                                        <input type="text" id="show_unit_values" name="show_unit_values"
                                               class="show_unit_values" value="" readonly="readonly"/>&nbsp;&nbsp; CFT
                                    @else
                                        <input type="hidden" id="show_unit_values" name="show_unit_values"
                                               class="show_unit_values" value="1" readonly="readonly"/>
                                    @endif
                                </div>
                            </div>

                            <div class="quantity-number">
                                <div class="">
                                    <span id="unit_msg" class="text-danger"></span>
                                </div>
                            </div>


                            <div class="quantity-number">
                                <label><b>Quantity: </b></label>
                                <div class="quantity-number-btn">

                                    <button id="minus" type="button"
                                            class="quantity-left-minus btn-number ms-btn"
                                            data-type="minus" data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>

                                    <input type="text" id="quantity" name="quantity"
                                           class="input-number"
                                           value="1" min="1" max="15">

                                    <button id="plus" type="button"
                                            class="quantity-right-plus  btn-number ps-btn"
                                            data-type="plus" data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>

                                </div>
                            </div>

                            <div class="sl-pdt-det-footer">
                                <!--sl-pdt-det-footer  -->
                                <div class="sl-pdt-det-btn">

                                    <a href="javascript:void(0)"
                                       type="button" class="btn compare"
                                       onclick="add_to_compare(
                                               '{{ $product->id }}',
                                               '{{ $product->product_code }}',
                                               '{{ $product->seo_url }}');">
                                        <i class="fa fa-balance-scale"></i> COMPARE
                                    </a>

                                    @if($product->local_discount == null)
                                        <?php $regularprice = local_selling_price($product, TRUE); ?>
                                        <?php $save = null; ?>
                                        <?php $sp = local_selling_price($product, TRUE); ?>
                                    @else
                                        <?php $regularprice = local_selling_price($product, TRUE); ?>
                                        <?php $save = save_price($product, TRUE); ?>
                                        <?php $sp = discounted_price($product, TRUE); ?>
                                    @endif

                                    <a id="buynow" type="button" href="javascript:void(0)"
                                       class="btn buy-now single-buy-now"
                                       onclick="add_to_cart(
                                               '{{ $product->id }}',
                                               '{{ $product->product_code }}',
                                               '{{ $product->product_code }}',
                                               '{{ $regularprice }}',
                                               '{{ $save }}',
                                               '{{ $sp }}',
                                               null,
                                               null,
                                               null);">
                                        <i class="fa fa-shopping-cart"></i> BUY NOW
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{--{"product_code":"12345","color":"Grey","material":"uPVC","product_sku":"12345","selling_price":"3000","discount":"10","opening_system":"2","locking_system":"13","part_palla":"16","frame_color":"20","glass_details":"25","lacquered":"28","variation_images":"50, 51"}--}}
                </div>

            </div>
        </div>
        </div>
    </section>

    <!--description-area section  -->
    <section class="description-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="descpition-warp">
                        <div id="exTab1" class="tabs-2">
                            <div class="description-header">
                                <div class="socile-descption pull-right">
                                    <p>share</p>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={!! seo_url_by_id($product->id) !!}"><i
                                                class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </div>
                                <ul class="nav description-tab">
                                    <li class="active"><a href="#b1" data-toggle="tab">Description</a>
                                    </li>
                                    <li><a href="#b2" data-toggle="tab">Comments</a>
                                    </li>
                                    <li><a href="#b3" data-toggle="tab">Reviews</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="b1">
                                    <div class="Description-det">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane" id="b2">
                                    <div class="comment-area">
                                        <div class="row">
                                            <div class="comment-box">
                                                <div class="col-md-6">
                                                    <div class="single-comment-bx">
                                                        <input type="text" placeholder="Name"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-comment-bx">
                                                        <input type="Email" placeholder="Email"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="single-comment-bx">
                                                        <textarea class="form-control"
                                                                  placeholder="Your Comment"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="remamber-btn">
                                                        <a href="#">Send</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="b3">
                                    <div class="row">
                                        <div class="review-det">
                                            <div class="col-md-7">
                                                <div class="main-star">
                                                    <h3>average rating</h3>
                                                    <i class="fa fa-star"></i>
                                                    <p>based on 1 rating</p>
                                                </div>
                                                <div class="lavle-star">

                                                    <div class="single-stare">
                                                        <ul class="list-unstyled">
                                                            <li class="lavle-star-left">
                                                                <p>5 stars</p>
                                                            </li>
                                                            <li class="lavle-star-mid">
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success"
                                                                         role="progressbar"
                                                                         style="width: 100%"
                                                                         aria-valuenow="100"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"></div>
                                                                </div>
                                                            </li>
                                                            <li class="lavle-star-right"><span>(2)</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- single-star end -->
                                                    <div class="single-stare">
                                                        <ul class="list-unstyled">
                                                            <li class="lavle-star-left">
                                                                <p>4 stars</p>
                                                            </li>
                                                            <li class="lavle-star-mid">
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bg-none"
                                                                         role="progressbar"
                                                                         style="width: 100%"
                                                                         aria-valuenow="100"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"></div>
                                                                </div>
                                                            </li>
                                                            <li class="lavle-star-right"><span>(0)</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- single-star end -->
                                                    <div class="single-stare">
                                                        <ul class="list-unstyled">
                                                            <li class="lavle-star-left">
                                                                <p>3 stars</p>
                                                            </li>
                                                            <li class="lavle-star-mid">
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bg-none"
                                                                         role="progressbar"
                                                                         style="width: 100%"
                                                                         aria-valuenow="100"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"></div>
                                                                </div>
                                                            </li>
                                                            <li class="lavle-star-right"><span>(0)</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- single-star end -->
                                                    <div class="single-stare">
                                                        <ul class="list-unstyled">
                                                            <li class="lavle-star-left">
                                                                <p>2 stars</p>
                                                            </li>
                                                            <li class="lavle-star-mid">
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bg-none"
                                                                         role="progressbar"
                                                                         style="width: 100%"
                                                                         aria-valuenow="100"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"></div>
                                                                </div>
                                                            </li>
                                                            <li class="lavle-star-right"><span>(0)</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- single-star end -->

                                                    <div class="single-stare">
                                                        <ul class="list-unstyled">
                                                            <li class="lavle-star-left">
                                                                <p>1 stars</p>
                                                            </li>
                                                            <li class="lavle-star-mid">
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bg-none"
                                                                         role="progressbar"
                                                                         style="width: 100%"
                                                                         aria-valuenow="100"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"></div>
                                                                </div>
                                                            </li>
                                                            <li class="lavle-star-right"><span>(0)</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- single-star end -->
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="remamber text-center">
                                                    <h3>Have you used this product before?</h3>
                                                    <div class="remamber-star">
                                                        <a href="#"><i
                                                                    class="fa fa-star"></i></a>
                                                        <a href="#"><i
                                                                    class="fa fa-star"></i></a>
                                                        <a href="#"><i
                                                                    class="fa fa-star"></i></a>
                                                        <a href="#"><i
                                                                    class="fa fa-star"></i></a>
                                                        <a href="#"><i
                                                                    class="fa fa-star"></i></a>
                                                    </div>
                                                    <div class="remamber-btn">
                                                        <a href="#">write a review</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="similar-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="similar-product-title text-center">
                        <h2>Same product in some different technical variation</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($similar as $item)
                    <?php
                    $current_product_id = (int)Request::segment(2);
                    //dump($current_product_id);
                    ?>
                    @if($item->id === $current_product_id)
                        {{--<h3 class="text-center">No similar product found</h3>--}}
                    @else
                        <div class="similar-warp">
                            <div class="col-md-2">
                                <div class="similar-product-img">
                                    <a href="{!! product_seo_url($item->seo_url) !!}">
                                        <img
                                                src="{{ get_first_product_image($item->id, $item) }}"
                                                alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="similar-product-content">
                                    <div class="row">
                                        <a href="{!! product_seo_url($item->seo_url) !!}">
                                            <div class="col-md-5">
                                            <span class="similar-product-lft">
                                                <div class="sl-pdt-det-header border-none text-center">
                                                    <h2> {!! $item->title !!} </h2>
                                                    <div class="price">

                                                        @if($item->discount == null)
                                                            <h5>
                                                                Price:
                                                                <span class="higileight"> {{ $tksign . number_format($item->local_selling_price) }}</span>

                                                                @if($item->unit == env('SFT'))
                                                                    <span class="unit_p">/sft</span>
                                                                @elseif($item->unit == env('CFT'))
                                                                    <span class="unit_p">/cft</span>
                                                                @elseif($item->unit == env('PIECE'))
                                                                    <span class="unit_p">/pcs</span>
                                                                @endif
                                                            </h5>
                                                        @else
                                                            <h4>
                                                                Regular Price: <span> {{ $tksign . $item->local_selling_price }}</span>
                                                            </h4>
                                                            <h5>
                                                                <span style="color: blue;">
                                                                    ({{ $item->local_discount }}%)
                                                                </span>
                                                                Discounted Price:
                                                                <span class="higileight"> {{ $tksign . discounted_price($item, NULL) }}</span>
                                                                <small>
                                                                    (Save {{ $tksign . save_price($item, FALSE) }})
                                                                </small>
                                                            </h5>
                                                        @endif

                                                    </div>
                                                </div>
                                            </span>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="sl-pdt-det-body similar-body">
                                                    <div class="sl-pdt-det-list similar-list">
                                                        <ul>
                                                            {{--<li>--}}
                                                            {{--@if($item->material !== null || $item->product_code !==--}}
                                                            {{--null)--}}
                                                            {{--<b>Product Code:</b>--}}
                                                            {{--<span>{{ $item->product_code }}</span>--}}
                                                            {{--, <b>Material:</b>--}}
                                                            {{--<span> {{ $item->material }}</span>--}}
                                                            {{--@endif--}}
                                                            {{--</li>--}}
                                                            @if($item->opening_system !== null)
                                                                <li>
                                                                    <b>Opening System:</b>
                                                                    <span> {{ get_term_info($item->opening_system, 'name') }}</span>
                                                                </li>
                                                            @endif
                                                            @if($item->size !== null)
                                                                <li>
                                                                    <b>Size:</b>
                                                                    <span>{{ get_term_info($item->size, 'name') }}</span>
                                                                </li>
                                                            @endif
                                                            @if($item->locking_system !== null)
                                                                <li>
                                                                    <b>Locking System:</b>
                                                                    <span>{{ get_term_info($item->locking_system, 'name') }}</span>
                                                                </li>
                                                            @endif
                                                            @if($item->part_palla !== null)
                                                                <li>
                                                                    <b>Part/Palla:</b>
                                                                    <span>{{ get_term_info($item->part_palla, 'name') }}</span>
                                                                </li>
                                                            @endif

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </section>

    <section class="description-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('frontend.products.comment')
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="more-product-title">
                    <h3>You May also like</h3>
                </div>
            </div>
        </div>
        <div class="">
            <div class="more-product-warp">

                <?php
                $cats = explode(',', $product->categories);

                $default = array(
                    'category_id' => array($cats[0]),
                    'limit' => 6,
                    'post_id' => null
                );

                $ymal = you_may_also_like($default);

                ?>
                @foreach($ymal as $item)
                    <div class="col-md-2">
                        <div class="singele-exc-prdt tab-product-single">
                            <div class="exc-prdt-img tab-product-img">
                                <a href="{!! product_seo_url($item->seo_url) !!}">
                                    <img
                                            src="{!! get_first_product_image($item->id, $item) !!}"
                                            alt="exc-prdt">
                                </a>
                            </div>
                            <div class="exc-prdt-text">
                                <h3>
                                    <a href="{!! product_seo_url($item->seo_url) !!}">
                                        {!! $item->title !!}
                                    </a>
                                </h3>
                                <h2>
                                    <a href="{!! product_seo_url($item->seo_url) !!}">

                                        @if($item->local_discount == null)
                                            {{ $tksign . number_format($item->local_selling_price) }}

                                            @if($item->unit == env('SFT'))
                                                <span class="unit_p">/sft</span>
                                            @elseif($item->unit == env('CFT'))
                                                <span class="unit_p">/cft</span>
                                            @elseif($item->unit == env('PIECE'))
                                                <span class="unit_p">/pcs</span>
                                            @endif

                                        @else
                                            {{ discounted_price($item, NULL) }}
                                            <span> {{ $tksign . $item->local_selling_price }} </span>

                                            @if($item->unit == env('SFT'))
                                                <span class="unit_p">/sft</span>
                                            @elseif($item->unit == env('CFT'))
                                                <span class="unit_p">/cft</span>
                                            @elseif($item->unit == env('PIECE'))
                                                <span class="unit_p">/pcs</span>
                                            @endif
                                        @endif

                                    </a>
                                </h2>
                                <div class="product-btn">
                                    <div class="buyy-btn">
                                        @if($item->local_discount == null)
                                            <?php $regularprice = local_selling_price($item, TRUE); ?>
                                            <?php $save = null; ?>
                                            <?php $sp = local_selling_price($item, TRUE); ?>
                                        @else
                                            <?php $regularprice = local_selling_price($item, TRUE); ?>
                                            <?php $save = save_price($item, TRUE); ?>
                                            <?php $sp = discounted_price($item, TRUE); ?>
                                        @endif

                                        @if($item->unit == env('SFT') || $item->unit == env('CFT'))

                                        @else

                                            <a type="button" href="javascript:void(0)" class="btn buy-now"
                                               onclick="add_to_cart(
                                                       '{{ $item->id }}',
                                                       '{{ $item->product_code }}',
                                                       '{{ $item->product_code }}',
                                                       '{{ $regularprice }}',
                                                       '{{ $save }}',
                                                       '{{ $sp }}',
                                                       null,
                                                       null,
                                                       null);">
                                                <i class="fa fa-shopping-cart"></i>
                                                Buy
                                            </a>
                                        @endif
                                    </div>
                                    <div class="detalis-btn">
                                        <a href="{!! product_seo_url($item->seo_url) !!}">detalis</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <?php //dd($product); ?>
@endsection
@section('cusjs')
    <script type="text/javascript">
        //picZoomer
        jQuery(document).ready(function ($) {
            $.noConflict();
            $('.picZoomer').picZoomer();

            //切换图片
            $('.piclist li').on('click', function (event) {
                var $pic = $(this).find('img');
                var $buynow = $("#buynow").data('imageurl');
                $('.picZoomer-pic').attr('src', $pic.attr('src'));
                $('#buynow').data('imageurl', $buynow.data('imageurl'));
            });

            $('#combinition').on('change', function (event) {
                event.preventDefault();

                var val = $(this).val();
                //var n = val.split('|');

                //var id = n[1];
                //var item = n[0];

                var url = window.location.pathname;
                window.location.replace(url + '?product_code=' + val);

            });

            $('#plus, #minus').on('click', function (e) {

            });


            $('#width, #length').on('change', function () {

                if ($('#length').val() == '') {
                    $('#unit_msg').html('Length can not be left blank');
                    $('#show_unit_values').val('');
                } else if ($('#width').val() == '') {
                    $('#unit_msg').html('Width can not be left blank');
                    $('#show_unit_values').val('');
                } else {
                    var w = $('#width').val();
                    var l = $('#length').val();

                    var sft = w * l;

                    $('#show_unit_values').val(sft);

                }

            });


            $('#width_c, #length_c, #thickness_c').on('change', function () {

                if ($('#length_c').val() == '') {
                    $('#unit_msg').html('Length can not be left blank');
                    $('#show_unit_values').val('');
                } else if ($('#width_c').val() == '') {
                    $('#unit_msg').html('Width can not be left blank');
                    $('#show_unit_values').val('');
                } else if ($('#thickness_c').val() == '') {
                    $('#unit_msg').html('Thickness can not be left blank');
                    $('#show_unit_values').val('');
                } else {
                    var w = $('#width_c').val();
                    var l = $('#length_c').val();
                    var t = $('#thickness_c').val();

                    var cft = w * l * t;

                    $('#show_unit_values').val(cft);

                }

            });


        });
    </script>
@endsection