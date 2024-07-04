@extends('layoutsAdmin.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> أسئلة امتحانية  </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل - {{$question -> id}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل ملف الامتحان الوطني </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                         <form class="form"action="{{route('admin.questions.update',['question'=>$question->id])}}"method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <input type="text" name="question" value="{{$question -> question}}" >
                                                    @error("question")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                </div>
                                                <div class="text-center">
                                                    <input type="text" name="option1" value="{{$question -> option1}}" >
                                                    @error("option1")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                </div>
                                                <div class="text-center">
                                                    <input type="text" name="option2"value="{{$question -> option2}}" >
                                                    @error("option2")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                </div>
                                                <div class="text-center">
                                                    <input type="text" name="option3"value="{{$question -> option3}}" >
                                                    @error("option3")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                </div>
                                                <div class="text-center">
                                                    <input type="text" name="option4" value="{{$question -> option4}}" >
                                                    @error("option4")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                </div>
                                                <div class="text-center">
                                                    <input type="text" name="option5" value="{{$question -> option5}}" >
                                                    @error("option5")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                               
                                                </div>
                                                <div class="text-center">
                                                    <input type="text" name="answer"value="{{$question -> answer}}" >
                                                    @error("answer")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                </div>
                                                <input type="submit" value="تحديث">
                                            </div>
                                        </from>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
