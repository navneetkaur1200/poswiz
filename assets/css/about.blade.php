@extends('layouts.front')

@section('title') About us page  @endsection
@section('content')

<section class="breadcrumb-area breadcrumb-bg" data-background="{{ URL::asset('/assets/front/img/bg/about_bg.webp') }}
">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content">
                                <h2>About Our Story</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">About Us</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            @if(!$latest->isEmpty())
            <!-- blog-area -->
            <section class="blog-area pt-100 pb-45">
                <div class="container">
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-xl-4 col-lg-6 col-md-10 col-sm-9">
                            <div class="section-title text-center text-md-left title-style-three mb-40">
                                <span class="sub-title">latest updates</span>
                                <h2 class="title">Online shopping defined by Fashion</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                    @foreach($latest as $r)
                        <div class="col-lg-4 col-md-6 col-sm-9">
                            <div class="blog-post-item blog-post-style2 mb-50">
                                <div class="blog-post-thumb mb-25">
                                    <a href="{{ route('blog_view',$r->slug) }}">
                                        <img src="{{ asset('uploads/blog/'.$r->picture) }}" alt="">
                                    </a>
                                </div>
                                <div class="blog-post-content">
                                    <div class="blog-post-meta">
                                        <ul>
                                            <li><i class="far fa-user"></i>By <a href="#">Admin</a></li>
                                            <li><i class="far fa-calendar-alt"></i> {{date('M d, Y',strtotime($r->created_at))}}</li>
                                        </ul>
                                    </div>
                                    <h3><a href="{{ route('blog_view',$r->slug) }}">{{$r->title}}</a></h3>
                                    <p>{{blog_split_string($r->description)}}</p>
                                    <a href="{{ route('blog_view',$r->slug) }}">Read More <span>+</span></a>
                                </div>
                            </div>
                        </div>
                    @endforeach 
                    </div>
                </div>
            </section>
            <!-- blog-area-end -->
            @endif

            <!-- choose-area -->
            <section class="choose-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="choose-wrap">
                                <div class="section-title title-style-three mb-30">
                                    <span class="sub-title">why CHOOSE us</span>
                                    <h2 class="title">SHOPTREND’s brands are trusted to offer artisan style to homes and wardrobes all over the world.</h2>
                                </div>
                                <div class="choose-content">
                                    <p>We have been delivering customers quality products and exceptional service worldwide for over a decade online. As our brands grow, we strive to connect unique, quality crafts with consumers worldwide, without the markups associated with lengthy supply chains. We are committed to improving the lives of our artisans and delighting our customers with well-priced and expertly crafted pieces.</p>
                                    <div class="progress-list">
                                        <div class="progress-item">
                                            <h6> European High Street Fashion</h6>
                                            <p>Our fashion brands focus on modern, versatile, and comfortable clothing. Decades of experience help us to offer quality garments at reasonable prices.
                                            Creating an effortlessly chic look should be, well, effortless. Getting the perfect outfit together is easy with our garments in your wardrobe.
                                            </p>
                                            <a href="/product-category/clothing" class="btn shop_our_btn">Shop our</a>
                                            <!-- <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="80"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 80%"><span>80%</span></div>
                                            </div> -->
                                        </div>
                                        <div class="progress-item">
                                            <h6>Handmade Home Decor</h6>
                                            <p>Our homeware divisions represent three generations of creating bespoke home decor and giftware. Exceptionally designed and expertly made, our pieces help gift-givers and interior design lovers to express their true style. All items are designed in the USA and skillfully crafted by artisans in India.</p>
                                            <a href="/product-category/home-decor" class="btn shop_our_btn">Shop our</a>
                                            <!-- <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="65"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 65%"><span>65%</span></div>
                                            </div> -->
                                        </div>
                                        <div class="progress-item">
                                            <h6>
Home Furnishing 
</h6>
<p>Home environments should be full of comfort, quality, and beauty. We help people feel themselves at home and celebrate their unique style. We curate home furnishing pieces for our customers to create a cohesive but distinctive home style.  </p>
<a href="/product-category/home-decor" class="btn shop_our_btn">Shop our</a>                                
<!-- <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="45"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 45%"><span>45%</span></div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="choose-bg" data-background="{{ URL::asset('/assets/front/img/bg/choose_bg.jpg')}}"></div>
            </section>
            <!-- choose-area-end -->

            <!-- exclusive-services -->
            <section class="exclusive-services pt-100 pb-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="section-title text-center title-style-three mb-60">
                                <span class="sub-title">our services</span>
                                <h2 class="title">Exclusive Services</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters justify-content-center">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="ex-services-item text-center">
                                <div class="overlay-bg" data-background="{{ URL::asset('/assets/front/img/images/ex_services_img.jpg')}}"></div>
                                <div class="content">
                                    <i class="flaticon-customer-support"></i>
                                    <h5>24/7 Customer Support</h5>
                                    <p>Around-the-clock customer care for any requests, queries, or comments.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="ex-services-item yellow text-center">
                                <div class="overlay-bg" data-background="{{ URL::asset('/assets/front/img/images/ex_services_img.jpg')}}"></div>
                                <div class="content">
                                    <i class="flaticon-debit-card"></i>
                                    <h5>Returns and Refunds</h5>
                                    <p>Buy with confidence. Our standard 30 days reliable returns and refunds policies protect all purchases.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="ex-services-item text-center">
                                <div class="overlay-bg" data-background="{{ URL::asset('/assets/front/img/images/ex_services_img.jpg')}}"></div>
                                <div class="content">
                                    <i class="flaticon-recycle-sign"></i>
                                    <h5>Branding and Personalization</h5>
                                    <p>Explore our wholesale opportunities. We offer brand personalization and white label goods.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="ex-services-item orange text-center">
                                <div class="overlay-bg" data-background="{{ URL::asset('/assets/front/img/images/ex_services_img.jpg')}}"></div>
                                <div class="content">
                                    <i class="flaticon-warehouse"></i>
                                    <h5>Inhouse Manufacturing</h5>
                                    <p>We oversee all our manufacturing. We prioritize exceptional craftsmanship and quality to ensure first-rate products ourselves.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="ex-services-item yellow text-center">
                                <div class="overlay-bg" data-background="{{ URL::asset('/assets/front/img/images/ex_services_img.jpg')}}"></div>
                                <div class="content">
                                    <i class="flaticon-truck"></i>
                                    <h5>Global Delivery </h5>
                                    <p>Our customers live all over the world. We have been working hard to provide dependable delivery to every corner of the globe.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="ex-services-item text-center">
                                <div class="overlay-bg" data-background="{{ URL::asset('/assets/front/img/images/ex_services_img.jpg')}}"></div>
                                <div class="content">
                                    <i class="flaticon-box"></i>
                                    <h5>Service Excellence </h5>
                                    <p>From your experience using our website to receiving the pieces, we strive for excellence. We commit to continually improving. If you have any suggestions, let us know.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="ex-services-item orange text-center">
                                <div class="overlay-bg" data-background="{{ URL::asset('/assets/front/img/images/ex_services_img.jpg')}}"></div>
                                <div class="content">
                                    <i class="flaticon-data"></i>
                                    <h5>Designed in USA - Made in India</h5>
                                    <p>Our team of designers keep an eye on trends, and our artisans in India provide the craftmanship to bring these designs to life.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="ex-services-item text-center">
                                <div class="overlay-bg" data-background="{{ URL::asset('/assets/front/img/images/ex_services_img.jpg')}}"></div>
                                <div class="content">
                                    <i class="flaticon-balance"></i>
                                    <h5>40 Years of Manufacturing Expertise </h5>
                                    <p>Our experience is paired with our drive to advance with technology so we can continue surpassing buyer expectations.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- exclusive-services-end -->

            <!-- newsletter-area -->
            <section class="newsletter-area pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="newsletter-bg newsletter-style-two" data-background="{{ URL::asset('/assets/front/img/bg/newsletter_bg02.jpg')}}">
                                <div class="newsletter-title">
                                 <p class="heading_shop_abt">eCommerce allows <span>SHOPTREND</span> to showcase artisans on a global platform. Our experience in online shopping and sales helps us provide:</p>
                                 <ul>
                                    <li>Exceptional around-the-clock customer service.</li>
                                    <li>Reliable returns and refund policies.</li>
                                    <li>Speedy, dependable delivery.</li>
                                 </ul>
                                 <p>Lengthy supply chains harm the environment and the consumers. Our in-house manufacturing cuts out all the go-betweens to bring you products you can trust at affordable prices.</p>
                                 <p>To see our latest offerings</p>
                                 <a href="{{route('category','new-ins-2')}}" class="btn">see our </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endsection