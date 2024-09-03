<h2>Settings</h2>

@foreach($settings as $setting)
    <?php dump($setting->toArray()); ?>
@endforeach

<h2>Payment Settings</h2>
@foreach($paymentsetting as $setting)
    <?php dump($setting->toArray()); ?>
@endforeach

<hr/>
<h2>Pages</h2>
@foreach($pages as $page)
    <?php dump($page->toArray()); ?>
@endforeach
<hr/>
<h2>Posts</h2>
@foreach($posts as $post)
    <?php dump($post->toArray()); ?>
@endforeach
<hr/>
<h2>Widgets</h2>
@foreach($widgets as $widget)
    <?php dump($widget->toArray()); ?>
@endforeach
<hr/>
<h2>Products</h2>
@foreach($products as $product)
    <?php dump($product->toArray()); ?>
    <div style="margin-left: 50px">
        <h3>Product Attributes</h3>
        <?php
        $product_information = product_attributes($product, FALSE);
        $infoss[] = json_decode($product_information['values']);
        $infoss[] = $product_information['id'];
        dump($infoss);
        ?>
    </div>
@endforeach
<hr/>