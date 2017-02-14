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

                        <h1>{{$report->fname}} {{$report->lname}}</h1>
                        <h2>{{$report->paddress}}</h2>

                        </div>

                        <div class="col-sm-8 col-md-6">
                            <table class="table table-hover">

                                <tr><th style="width:99%;">Section</th><th>Edit</th></tr>

                                <tr><td>Report Details</td><td><a href="/admin/report/{{$report->id}}/details"><button class="btn btn-primary ion-edit"></button></a></td></tr>

                                @foreach ($report->sections as $section)
                                <tr>
                                    <td>{{ $section->fsection->label }}</td><td><a href="/admin/report/{{$report->id}}/{{$section->id}}"><button class="btn btn-primary ion-edit"></button></a></td>
                                </tr>
                                @endforeach

                                <tr><td><strong>Report Summary</strong></td><td><a href="/admin/report/{{$report->id}}/summary"><button class="btn btn-primary ion-edit"></button></a></td></tr>
                            </table>

                        </div>

                    </div>

                    <div class="row">
                </div>
            </section> <!-- /#about -->



@stop