@extends('layouts.default')

@section('title', 'Contact')

@section('breadcrumbs', '<a href="/"><i class="ion-ios-home"></i>Home</a> / Contact')

@section('content')


        <!-- 
        ================================================== 
            Contact Section Start
        ================================================== -->
        <section id="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="block">
                            <h2 class="subtitle wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".3s">Contact Us</h2>
                            <p class="subtitle-des wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".5s">
                                Want to schedule an inspection or just have a general question? Feel free to call or fill out the contact form below.
                            </p>
                            <div class="contact-form">
                                <form id="contact-form" method="post" action="/" role="form">
                        
                                    <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".6s">
                                        <input type="text" placeholder="Your Name" class="form-control" name="name" id="name">
                                    </div>
                                    
                                    <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".8s">
                                        <input type="email" placeholder="Your Email" class="form-control" name="email" id="email" >
                                    </div>
                                    
                                    <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1s">
                                        <input type="text" placeholder="Subject" class="form-control" name="subject" id="subject">
                                    </div>
                                    
                                    <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1.2s">
                                        <textarea rows="6" placeholder="Message" class="form-control" name="message" id="message"></textarea>    
                                    </div>
                                    
                                    
                                    <div id="submit" class="wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1.4s">
                                        <input type="submit" id="contact-submit" class="btn btn-default btn-send" value="Send Message">
                                    </div>                      
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <h1>&nbsp;</h1>
                        </div>
                        <div class="col-xs-6">
                            <div class="address wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".3s">
                                <i class="ion-ios-location-outline"></i>
                                <h5>Wadsworth, Ohio</h5>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="email wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".5s">
                                <i class="ion-ios-email-outline"></i>
                                <h5>nahd@gmail.com????</h5>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="phone wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".7s">
                                <i class="ion-ios-telephone-outline"></i>
                                <h5>Jason Jurey</h5>
                                <p>(330)697-6364</p>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="phone wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".9s">
                                <i class="ion-ios-telephone-outline"></i>
                                <h5>Nolan Wickard</h5>
                                <p>(614)226-9974</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



@stop