@extends('layouts.default')

@section('title', 'Edit Form Section')

@section('breadcrumbs', '<a href="/admin"><i class="ion-android-options"></i> Dashboard</a> / <a href="/admin/form/">Report Form</a> / <a href="/admin/form/'.$fdescriptionarea->section->id.'">'.$fdescriptionarea->section->label.'</a> / '.$fdescriptionarea->label)

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <h1>{{$fdescriptionarea->label}}</h1>

                    <div class="row">

                        <div class="col-sm-4 col-sm-push-8">
                            <h2>Add Description Option</h2>
                            <form action="/admin/form/{{ $secid }}/description_area/{{ $id }}" method="post">
                                {{ csrf_field() }}
                                <input type="text" name="label" class="form-control">
                                <input type="submit" id="new" class="btn btn-primary" value="Submit">
                            </form>
                        </div>

                        <div class="col-sm-8 col-sm-pull-4">
                            <h2>Available Description Options</h2>
                            <table class="table table-striped">
                                <tr><th style="width:99%;">Label</th><th>Delete?</th></tr>

                                @foreach ($fdescriptionarea->options as $fdescriptionoption)
                                <tr>
                                    <td>{{ $fdescriptionoption->label }}</td>
                                    <td><a href="/admin/form/{{$fdescriptionarea->section->id}}/description_area/{{$fdescriptionarea->id}}/option/{{ $fdescriptionoption->id }}/delete" class="check"><button class="btn btn-primary ion-trash-b"></button></a></td>
                                </tr>
                                @endforeach
                            </table>

                        </div>

                    </div>

                    
            </section> <!-- /#about -->



@stop