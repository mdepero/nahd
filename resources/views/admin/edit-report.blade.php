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

                            <h1>Additional Documents</h1>

                            <form method="post" action="/admin/report/{{ $report->id }}/document" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <p>Document to Add: <input type="file" name="file"></p>
                            <p>Caption: <input type="text" name="caption"></p>
                            <p><input type="submit" class="btn btn-primary" value="Upload"></p>
                            </form>

                            <table class="table">

                                @foreach($report->documents as $doc)

                                <tr id="doc_{{$doc->id}}">
                                    <td></td>
                                    <td><a href="{{$doc->file_path}}" target="_BLANK">{{$doc->caption}}</a></td>
                                    <td><a href="/admin/report/{{$report->id}}/document/{{$doc->id}}/delete" class="check btn btn-warning ion-trash-b img-del"></a></td>
                                </tr>

                                @endforeach

                            </table>

                        </div>

                    </div>

                    <div class="row">
                </div>
            </section> <!-- /#about -->



@stop