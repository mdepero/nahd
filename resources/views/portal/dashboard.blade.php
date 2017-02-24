@extends('layouts.default')

@section('title', 'Edit Report')

@section('breadcrumbs', '<a href="/admin"><i class="ion-android-options"></i> Dashboard</a> / Report')

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <div class="row">

                        <div class="col-xs-12">

                        <h1>Welcome {{$report->fname}} {{$report->lname}}</h1>
                        <h2>{{$report->paddress}}</h2>

                        <p>Thank you for using New Age Home Detectives. Use the links below to access your full report and any additional documents that may be linked to your account. If you have any questions, feel free to <a href="/contact">contact us</a> at any time with questions.</p>


                        <h3>View/Print Your Inspection Report</h3>

                        <a href="/webportal/print/{{$report->id}}" class="btn btn-large btn-primary">View Report</a>

                        @if(count($report->documents) > 0)

                        <h3>Additional Documents</h3>

                        @endif


                        <table class="table">

                            @foreach($report->documents as $doc)

                            <tr id="doc_{{$doc->id}}">
                                <td><a href="{{$doc->file_path}}" target="_BLANK"><button type="button" class="btn btn-info ion-ios-paper-outline"></button></a></td>
                                <td><a href="{{$doc->file_path}}" target="_BLANK">{{$doc->caption}}</a></td>
                            </tr>

                            @endforeach

                        </table>

                        </div>
                        

                    </div>

                    <div class="row">
                </div>
            </section> <!-- /#about -->



@stop