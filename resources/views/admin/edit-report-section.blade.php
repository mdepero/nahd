@extends('layouts.default')

@section('title', $section->fsection->label)

@section('breadcrumbs', '<a href="/admin"><i class="ion-android-options"></i> Dashboard</a> / <a href="/admin/report/'.$section->report->id.'">Report</a> / '.$section->fsection->label)

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <div class="row">

                        <div class="col-lg-10 col-lg-offset-1">
                            <h1>{{ $section->fsection->label }}</h1>
                            <h2>{{ $section->report->fname }} {{ $section->report->lname }}</h2>
                            <h3>{{ $section->report->paddress }}</h3>

                            <form method="post" id="section-form" action="/admin/report/{{ $section->report->id }}/{{ $section->id }}">

                            {{ csrf_field() }}


                            <h2>Physical Descriptions</h2>
                            <table class="table">

                                <tr><th>Area</th><th>Options</th><th>Value</th>

                                @foreach($section->descriptions as $description)

                                <tr><td>{{$description->area->label}}</td>

                                <td>
                                    
                                    @foreach($description->area->options as $option)

                                        <button type="button" class="option btn btn-default" option-for="desc_{{$description->id}}" option-val="{{$option->label}}">{{$option->label}}</button>

                                    @endforeach

                                </td><td><input type="text" class="form-control" id="desc_{{$description->id}}" name="desc_{{$description->id}}" value="{{$description->value}}"></td></tr>

                                @endforeach


                            </table>



                            <h2>Limitations of this Section's Report</h2>
                            <div class="row"><div class="col-sm-6"><textarea class="form-control" name="limitations">{{$section->limitations}}</textarea></div></div>
                            

                            <h2>Areas of Concerns</h2>
                            <table class="table">

                                <tr><th>Area</th><th>Options</th><th style="width:17%;min-width: 100px;">Item</th><th style="width:17%;min-width: 100px;">Location</th><th style="width:17%;min-width: 100px;">Urgency</th><th style="width:0.1%;"></th></tr>

                                @foreach($possible_concern_areas as $area)

                                <tr><td>{{$area->label}}</td>

                                <td style="border-right:1px solid #ddd;">
                                    
                                    @foreach($area->options as $option)

                                        <button type="button" class="add-concern btn btn-default" area-id="{{$area->id}}" option-label="{{$option->label}}">{{$option->label}}</button>

                                    @endforeach

                                    <button type="button" class="add-concern btn btn-default" area-id="{{$area->id}}" option-label="">Other</button>

                                </td><td id="{{$area->id}}_item">
                                    
                                    @foreach($section->concerns as $concern)

                                        @if($concern->area->id == $area->id)

                                            <input type="text" class="form-control x_con_{{$concern->id}}" name="conc_{{$concern->id}}" value="{{$concern->item}}">

                                        @endif

                                    @endforeach

                                </td><td id="{{$area->id}}_loc">

                                    @foreach($section->concerns as $concern)

                                        @if($concern->area->id == $area->id)

                                            <input type="text" class="form-control x_con_{{$concern->id}}" name="conc_loc_{{$concern->id}}" value="{{$concern->location}}">

                                        @endif

                                    @endforeach

                                </td><td id="{{$area->id}}_urg">

                                    @foreach($section->concerns as $concern)

                                        @if($concern->area->id == $area->id)

                                            <input type="text" class="form-control x_con_{{$concern->id}}" name="conc_urg_{{$concern->id}}" value="{{$concern->urgency}}">

                                        @endif

                                    @endforeach

                                </td><td id="{{$area->id}}_del">

                                    @foreach($section->concerns as $concern)

                                        @if($concern->area->id == $area->id)

                                            <button type="button" class="delete-concern btn btn-warning ion-trash-b x_con_{{$concern->id}}" to-delete="{{$concern->id}}"></button>

                                        @endif

                                    @endforeach

                                </td></tr>

                                @endforeach


                            </table>


                            <h2>Section Notes</h2>
                            <div class="row"><div class="col-sm-6"><textarea class="form-control" name="notes">{{$section->notes}}</textarea></div></div>

                            

                            <h2>&nbsp;</h2>

                            <input type="submit" class="btn btn-primary" value="Save"> <a href="/admin/report/{{$section->report->id}}" class="btn btn-default">Cancel</a> *Note: Unsaved edits will be lost

                            </form>

                            <hr />

                            <h1>{{$section->fsection->label}} Images</h1>

                            <form method="post" action="/admin/report/{{ $section->report->id }}/{{ $section->id }}/image" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div>**Any edits made to image section will delete unsaved changes above.</div><br />
                            <p>Image to Add: <input type="file" name="image"></p>
                            <p>Caption: <input type="text" name="caption"></p>
                            <p><input type="submit" class="btn btn-primary" value="Upload"></p>
                            </form>

                            <table class="table">

                                @foreach($section->images as $image)

                                <tr id="img_{{$image->id}}">
                                    <td style="max-width:300px;"><img src="{{$image->file_path}}" class="img-responsive"></td>
                                    <td>{{$image->caption}}</td>
                                    <td><a href="/admin/report/{{$section->report->id}}/{{$section->id}}/image/{{$image->id}}/delete" class="check btn btn-warning ion-trash-b img-del"></a></td>
                                </tr>

                                @endforeach

                            </table>

                        </div>

                    </div>

                </div>
            </section> <!-- /#about -->



@stop