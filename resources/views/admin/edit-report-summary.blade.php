@extends('layouts.default')

@section('title', 'Report Details')

@section('breadcrumbs', '<a href="/admin"><i class="ion-android-options"></i> Dashboard</a> / <a href="/admin/report/'.$report->id.'">Report</a> / Report Details')

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <div class="row">

                        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                            <h1>Report Summaries</h1>
                            <h2>{{$report->fname}} {{$report->lname}}</h2>
                            <h3>{{$report->paddress}}</h3>

                            <form method="post" action="/admin/report/{{ $report->id }}/summary">

                            {{ csrf_field() }}

                            <table class="table">

                            @foreach($report->sections as $section)

                                <tr><td>{{$section->fsection->label}}</td><td><textarea name="{{$section->id}}" class="form-control">{{$section->summary}}</textarea></td></tr>

                            @endforeach

                            <tr><td><strong>Overall Rating (1-10)</strong></td><td><input type="number" class="form-control" name="rating" value="{{$report->rating}}"></td></tr>

                            <tr><td><strong>Final Remarks</strong></td><td><textarea name="final_remarks" class="form-control">{{$report->final_remarks}}</textarea></td></tr>


                            </table>

                            <input type="submit" class="btn btn-primary" value="Save"> <a href="/admin/report/{{$report->id}}" class="btn btn-default">Cancel</a> *Note: Unsaved edits will be lost

                            </form>

                        </div>

                    </div>

                    <div class="row">
                </div>
            </section> <!-- /#about -->



@stop