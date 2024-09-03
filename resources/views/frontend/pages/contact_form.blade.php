<div class="row">
    <div class="col-md-6">
        <div class="google-map-title section-title">
            <h2>
                মন্তব্য / জিজ্ঞাসা
            </h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('frontend.pages.feedback_form')
            </div>
            {{-- <div class="col-md-12">
                <form class="form-horizontal well " action="" method="post">
                    <div class="form-group">
                        <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message"
                            placeholder="Please enter your message here..." rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm pull-right">Submit</button>
                    </div>
                </form>
            </div> --}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="google-map-title section-title">
            <h2>
                {{ $page->title }}
            </h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $widgets[9]->description !!}
                {{-- <div class="adderss-box">
                    <ul class="list-unstyled">
                        <li> <i class="fa fa-caret-right"></i> <strong>জনাব মোঃ কাজী আবু তাহের </strong></li>
                        <li>জেলা প্রশাসক , জেলা পরিষদ, পিরোজপুর</li>
                        <li><i class="fa fa-phone"></i> <a title="Click here to call" href="tel:+8801600000000">
                                ০১৭৩৬-৬৬৬৬৬৬ </a></li>
                        <li><i class="fa fa-envelope"></i> <a title="Click here to send mail"
                                href="mailto:abc@gmail.com">
                                xyz@gmail.com </a> </li>
                    </ul>
                </div>
                <div class="box-devider"></div> --}}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="google-map-title section-title">
            <h2>
                মানচিত্র
            </h2>
        </div>
        <div class="map">
            {!! $widgets[10]->description !!}
        </div>
        {{-- <div class="mapouter">
            <div class="gmap_canvas"><iframe width="960" height="400" id="gmap_canvas"
                    src="https://maps.google.com/maps?q=dhaka&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0"
                    scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                    href="https://www.whatismyip-address.com/divi-discount/"></a><br>
                <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                        height: 400px;
                        width: 100%;
                    }
                </style>
                <a href="https://www.embedgooglemap.net"></a>
                <style>
                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                        height: 400px;
                        width: 100%;
                    }
                </style>
            </div>
        </div> --}}
    </div>
</div>