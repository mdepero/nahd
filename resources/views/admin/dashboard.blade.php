@extends('layouts.default')

@section('title', 'Admin Dashboard')

@section('breadcrumbs', 'Admin Panel')

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <div class="row">

                        <div class="col-xs-6 col-sm-2 col-sm-push-8 text-center">

                            <a href="/admin/new"><img src="{{asset('images/new.png')}}" class="img-responsive" alt="New Report"></a>
                        </div>

                        <div class="col-xs-6 col-sm-2 col-sm-push-8 text-center">

                            <a href="/admin/edit"><img src="{{asset('images/edit.png')}}" class="img-responsive" alt="Edit Form"></a>
                        </div>

                        <div class="col-sm-8 col-sm-pull-4">
                            <h2>Previous Reports</h2>

                        </div>

                    </div>

                    <div class="row">
                </div>
            </section> <!-- /#about -->



@stop