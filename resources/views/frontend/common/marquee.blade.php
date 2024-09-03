<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="marqueeContent">
                <div class="ptms_marquee">
                    <marquee onmouseout="this.start()" onmouseover="this.stop()" direction="left" scrolldelay="10"
                        scrollamount="5" style="color:#FF0000;">
                        <?php
                        $news = [];
                        ?>
                        <ul class="olnodesign">
                            @foreach ($news as $p)
                                <li>- <a href="#">{{ $p->title }}</a></li>
                            @endforeach
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
    </div>
</div>
