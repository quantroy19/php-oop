@extends('layouts.main')
@section('main-content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
               <div class="col-6">        
                    {{-- <h5>Làm quiz</h5> --}}
                </div>
            </div>
            <div class="card-body">
                <table class="table tabl-stripped">
                    <thead>
                        <th>Tên quiz</th>
                        <th>Số câu hỏi</th>
                        <th>Làm trong</th>
                        <th>Thời gian làm</th>
                        <th>Trạng thái</th>                        
                    </thead>
                    <tbody>
                        @foreach($quizs as $q)
                        
                            <tr>
                                <td>
                                    <a href="{{BASE_URL . 'sv/lam-quiz/' . $q->id}}">{{$q->name}}</a>
                                </td>
                                <td>{{ count($q->question)}}</td>
                                <td>{{$q->duration_minutes}} p</td>
                                <td>
                                    <sub>Bắt đầu: {{ $q->start_time }}</sub><br>
                                    <sub>Kết thúc: {{ $q->end_time }}</sub>
                                </td>
                                <td>
                                    <span>Kích hoạt: {{ ($q->status == 0) ? "Không" : "Có" }}</span>
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection