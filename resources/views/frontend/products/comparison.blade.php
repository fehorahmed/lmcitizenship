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
                            ->addCrumb('Comparison', 'product');
                        echo $breadcrumbs->render();
                        ?>
                    </div>
                    <!-- breadcrumb  end-->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="about-text">

                    @if (Session::has('comparison'))
                        <?php
                        $limit = 3;
                        $oldcomparison = Session::get('comparison');

                        if (!empty($oldcomparison->items) && count($oldcomparison->items) > 1) {
                        ?>
                        <div class="compare-content">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="150">Product name</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <th width="25%">{{ product_title($title['item']['productid']) }}</th>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Image</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        <?php //dd($title); ?>
                                        @if($i <= 2)
                                            <th>
                                                <img style="max-height: 220px;width: inherit;"
                                                     src="{{ get_first_product_image($title['item']['productid'], true) }}"/>
                                            </th>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <th>{{ $tksign . get_product_selling_price($title['item']['productid']) }}
                                            </th>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Product code</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <td>{{ get_product_code($title['item']['productid']) }}</td>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Material</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <td>{{ get_product_info_by_key($title['item']['productid'], 'material') }}</td>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Dimension</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <td>{{ get_product_info_by_key($title['item']['productid'], 'dimension') }}</td>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Part Palla</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <td>
                                                {{ get_category_name(get_product_info_by_key($title['item']['productid'], 'part_palla'), 'name') }}
                                            </td>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Locking System</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <td>
                                                {{ get_category_name(get_product_info_by_key($title['item']['productid'], 'locking_system'), 'name') }}
                                            </td>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Opening System</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <td>
                                                {{ get_category_name(get_product_info_by_key($title['item']['productid'], 'opening_system'), 'name') }}
                                            </td>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <td>
                                                {!! get_product_info_by_key($title['item']['productid'], 'description') !!}
                                            </td>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tr>

                                <tr>
                                    <td>Buy Now</td>

                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($oldcomparison->items as $title)
                                        @if($i <= 2)
                                            <td>
                                                <?php
                                                //dump($title);
                                                $product = get_product_by_id($title['item']['productid']);
                                                //dump($product);
                                                ?>
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
                                                   class="btn btn-danger buy-now"
                                                   onclick="add_to_cart(
                                                           '{{ $product->id }}',
                                                           '{{ $product->product_code }}',
                                                           '{{ $product->product_code }}',
                                                           '{{ $regularprice }}',
                                                           '{{ $save }}',
                                                           '{{ $sp }}',
                                                           null,
                                                           null,
                                                           1);">
                                                    BUY NOW
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="btn btn-default" style="background: grey;"
                                                   onclick="remove_compare_product('{{ $product->id }}', '{{ $product->product_code }}');">
                                                    REMOVE
                                                </a>

                                            </td>
                                        @endif
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach

                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php } else { ?>
                        @if (!empty($oldcomparison->items))

                            @php
                                $i = 0
                            @endphp
                            @foreach($oldcomparison->items as $title)
                                <?php //dd($title); ?>
                                @if($i <= 2)
                                    <th>
                                        <img style="max-height: 220px;width: inherit;"
                                             src="{{ get_first_product_image($title['item']['productid'], true) }}"/>
                                    </th>
                                @endif
                                @php
                                    $i++
                                @endphp
                            @endforeach
                            <br/>
                            <h4>
                                @php
                                    $i = 0
                                @endphp
                                @foreach($oldcomparison->items as $title)
                                    @if($i <= 2)
                                        <th width="25%">{{ product_title($title['item']['productid']) }}</th>
                                    @endif
                                    @php
                                        $i++
                                    @endphp
                                @endforeach
                            </h4>

                            @php
                                $i = 0
                            @endphp
                            @foreach($oldcomparison->items as $title)
                                @if($i <= 2)
                                    <?php
                                    $product = get_product_by_id($title['item']['productid']);
                                    ?>
                                    <a href="javascript:void(0)"
                                       class="btn btn-default" style="background: grey;"
                                       onclick="remove_compare_product('{{ $product->id }}', '{{ $product->product_code }}');">
                                        REMOVE
                                    </a>
                                @endif
                            @endforeach

                        @endif
                        <h2>{{ 'Please add at least 2 item to compare' }}</h2>
                        <?php } ?>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection