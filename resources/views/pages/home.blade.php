@extends('layouts.default')

@section('title', 'Home')

@section('content')

        <!--
        ==================================================
        Slider Section Start
        ================================================== -->
        <section id="hero-area" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="block wow fadeInUp" data-wow-delay=".3s">
                            
                            <!-- Slider -->
                            <section class="cd-intro">
                                <h1 class="wow fadeInUp animated cd-headline slide" data-wow-delay=".4s" >
                                <span>NEW AGE HOME DETECTIVES</span>
                                </h1>
                                <h2 class="wow fadeInUp animated cd-headline slide" data-wow-delay=".6s" >
                                <span>COMPREHENSIVE HOME INSPECTIONS PROTECTING YOU FROM </span><br>
                                <span class="cd-words-wrapper">
                                    <b class="is-visible">TERMITES</b>
                                    <b>FIRE RISK</b>
                                    <b>ELECTRICAL FAILURE</b>
                                    <b>ROT AND AGE</b>
                                    <b>LEAKS AND WATER LOSS</b>
                                    <b>HEATING ISSUES</b>
                                </span>
                                </h1>
                                </section> <!-- cd-intro -->
                                <!-- /.slider -->
                                
                                
                                <a class="btn-lines light dark wow fadeInUp animated smooth-scroll btn btn-default btn-primary" data-wow-delay="1.0s" href="#about" data-section="#about" >About Us</a>
                                <a class="btn-lines light dark wow fadeInUp animated smooth-scroll btn btn-default btn-primary" data-wow-delay="1.0s" href="#whyus" data-section="#whyus" >Why Us</a>
                                <br/>
                                <a class="btn-lines dark light wow fadeInUp btn btn-default btn-green" data-wow-delay="1.0s" href="/services" >Schedule an Inspection</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/#main-slider-->
            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="block wow fadeInLeft" data-wow-delay=".3s" data-wow-duration="500ms">
                                <h2>
                                ABOUT US
                                </h2>
                                <p>
                                    New Age Home Detectives was started in 2011 by Jason Jurey and Nolan Wickard. Since then, we've performed dozens of high quality inspections for realtors and home buyers alike and have proudly corrected many important safety concerns in the process. 
                                </p>
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="block wow fadeInRight" data-wow-delay=".3s" data-wow-duration="500ms">
                                <h2>
                                &nbsp;
                                </h2>
                                <p>
                                    We primarily perform in Medina, Summit, Stark, Portage, and Wayne counties, but have traveled as far as Dublin and Westerville in central Ohio. Our goal is to provide fair, comprehensive home inspections to save money, protect your assets, and protect the health and safety of home owners and their families.
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-md-offset-3 col-md-offset-3">
                            <div class="block wow fadeInUp" data-wow-delay=".3s" data-wow-duration="500ms">
                                <img src="images/about.png" alt="House with Magnifying Glass">
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!-- /#about -->
            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="whyus">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="block wow fadeInLeft" data-wow-delay=".3s" data-wow-duration="500ms">
                                <h2>
                                Why US
                                </h2>
                                <p>
                                    From increasing the value of your home to simply providing peace of mind, a legitmate house inspection is valuable to anyone selling, buying, or even just owning a home. Our inspectors have years of experience and training to provide ensure an accurate and fair assessment on your home amenities and integrity. While no inspection will ever be 100%, you can rest assured that our team's expertise will come as close to perfect as possible.
                                </p>
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="block wow fadeInRight" data-wow-delay=".3s" data-wow-duration="500ms">
                                <img src="images/whyus.png" alt="House with Check Mark">
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!-- /#whyus -->


@stop