@extends('layouts.master')

@section('title')
	ClausenFitness - Gym Information
@endsection

@section('css')

@endsection

@section('content')
	<section class="content-header">
      <h1>
        Gym Management
        <small>Gym Information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Gym Management | Information</li>
      </ol>
    </section>
    
     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {!! Session::get('message') !!}
                
                <div class="box box-primary">
                    <div class="box-header with-border"><h4 class="box-title">Gym Information</h3></div>
                    <form method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image_preview">
                                            <label for="image"><i class="fa fa-camera"></i></label>
                                            <img src="{{ asset('dist/img/gym_information/'.$gym_information->logo) }}" class="prodImgPrev" id="prodImgPrev">
                                        </div>
                                        <input type="file" name="image" id="image" class="imgFile hidden" accept="image/x-png,image/gif,image/jpeg" style="display:none;" enctype="multipart/form-data">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <input type="text" class="form-control" placeholder="Gym Name" name="name" value="{{ $gym_information->name }}">
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="row">
                                     <div class="col-xs-12 col-sm-8">
                                        <textarea class="textarea" name="others" placeholder="Other Info" style="width: 100%;  font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; height: 150px">{{ $gym_information->others }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                        <button type="reset" id="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

    $(document).ready(function(){
        var logo = "{{ $gym_information->logo }}";

        $('#reset').on('click', function() {
            $('#image').val('');
            $('#prodImgPrev').attr('src', "{{ asset('dist/img/gym_information/'.$gym_information->logo) }}");
        });

        $('.imgFile').change(function(){
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];  
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) {
                $('.prodImgPrev').attr('src','{{ asset('img/default.jpg') }}');
                return false;
            }
            else {
              var reader = new FileReader();  
              reader.onload = imageIsLoaded;
              reader.readAsDataURL(this.files[0]);
            }
        });

        function imageIsLoaded(e){
            $('.prodImgPrev').attr('src', e.target.result);
        }
    });
</script>
@endsection