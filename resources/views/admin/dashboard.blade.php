@extends('layouts.default')

@section('title', 'Admin Dashboard')

@section('breadcrumbs', '<i class="ion-android-options"></i> Dashboard')

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <div class="row">

                        <div class="col-xs-6 col-sm-2 col-sm-push-8 col-lg-1 col-lg-push-10 text-center">

                            <a href="/admin/new"><img src="{{asset('images/new.png')}}" class="img-responsive" alt="New Report"></a>
                        </div>

                        <div class="col-xs-6 col-sm-2 col-sm-push-8 col-lg-1 col-lg-push-10 text-center">

                            <a href="/admin/form"><img src="{{asset('images/edit.png')}}" class="img-responsive" alt="Edit Form"></a>
                        </div>

                        <div class="col-sm-8 col-sm-pull-4 col-lg-10 col-lg-pull-2">
                            <h2>Previous Reports</h2>
                            <table class="table table-striped">
                                <tr><th>Address</th><th class="hidden-sm hidden-xs">Client</th><th>Report Date</th></tr>
                                @foreach ($reports as $report)
                                    <tr><td>{{ $report->paddress }}</td><td class="hidden-sm hidden-xs">{{ $report->fname }} {{ $report->lname }}</td><td>{{ $report->date_inspection }}</td></tr>
                                @endforeach
                            </table>

                        </div>

                    </div>

                    <div class="row">
                </div>
            </section> <!-- /#about -->



@stop