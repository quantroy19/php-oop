@extends('layouts.main')
@section('main-content')
    <div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
               <div class="col-6">        
                    <h5>{{$subName}}</h5>
                </div>
            </div>
            <div class="card-body pl-4">
                <h2>{{$quiz->name}}</h2>
                <p>Thời gian: {{$quiz->duration_minutes}} phút</p>
                <i>Bắt đầu lúc: {{$start_time}}</i>
                <hr>
                <form action="{{BASE_URL. 'sv/lam-quiz/'.$quiz->id}}" method="POST">
                    <input type="hidden" name="start_time" value="{{$start_time}}">
                    @foreach ($questions as $item)
                    <fieldset>
                        <legend class="text-primary">Câu hỏi {{$loop->iteration}}: {{$item->name}}</legend>
                        <ul>

                            {{-- Show A,B, C, D --}}
                            @php
                                $A='A';
                            @endphp
                            @foreach ($item->answers as $ans)                                
                                <div class="form-group mb-3">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="{{$ans->id}}" name="question_{{$item->id}}" value="{{$ans->id}}">
                                        <label for="{{$ans->id}}" class="custom-control-label">{{$A}}. {{$ans->content}}</label>
                                    </div>
                                </div>   
                                @php
                                    $A++;
                                @endphp                          
                            @endforeach
                        </ul>
                    </fieldset>    
                    @endforeach
                    <button class="btn btn-sm btn-info" type="submit">Nộp bài</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
