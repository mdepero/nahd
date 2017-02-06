@extends('layouts.default')

@section('title', 'Web Portal')

@section('breadcrumbs', 'Log In')

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="block wow fadeInLeft" data-wow-delay=".1s" data-wow-duration="500ms">
                                <h2>
                                Access Your Account
                                </h2>
                                <p>
                                    Once you've had an inspection, you can access your report and other documents through our web portal using your access key.
                                </p>
                                <p>
                                    Always be sure to keep your access key private, otherwise anyone can access your account. If you believe your key has been compromised, or you lost yours, feel free to <a href="/contact">contact us</a> for help.
                                </p>
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="block wow fadeInRight" data-wow-delay=".3s" data-wow-duration="500ms">
                                <h2>&nbsp;</h2>
                                <div class="contact-form">
                                    <form id="contact-form" method="post" action="/login" role="form">

                                        {{ csrf_field() }}
                        
                                        <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".5s">
                                            <input type="text" placeholder="Your Access Key" class="form-control" name="key" id="key">
                                        </div>
                                        <div id="submit" class="wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".7s">
                                            <input type="submit" id="contact-submit" class="btn btn-primary btn-send" value="Submit">
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section> <!-- /#about -->



@stop