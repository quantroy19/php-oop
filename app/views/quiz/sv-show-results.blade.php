@extends('layouts.main')
@section('main-content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
               <div class="col-6">        
                    <h5>{{$subjectName}}</h5>
                </div>
            </div>
            <div class="card-body">
               <table class="table tabl-stripped">
                    <thead>
                        <th>#</th>
                        <th>Quiz</th>
                        <th>Thời gian</th>
                        <th>Đúng</th>
                        <th>Đạt</th>                        
                    </thead>
                    <tbody>
                        @foreach ($resultStudentQuizs as $item)                        
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nameQuiz()}}</td>
                            <td>
                                <small>Bắt đầu: {{date("d-m-Y H:i:s", strtotime($item->start_time))}}</small><br>
                                <small>Hoàn thành: {{ date("d-m-Y H:i:s", strtotime($item->end_time))}}</small>
                            </td>
                            <td>{{ $item->count_asnwer_correct}} / {{$item->count_asnwer}}</td>
                            <td>{{$item->score}} đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>           
            </div>
        </div>
    </div>
</div>
@endsection