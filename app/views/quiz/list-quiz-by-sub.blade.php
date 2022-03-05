
@extends('layouts.main')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-6"> 
                             <h5>Môn {{ $name_sub }}</h5>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table tabl-stripped">
                    <thead>
                        <th>Tên quiz</th>
                        <th>Số câu hỏi</th>
                        <th>Làm trong</th>
                        <th>Thời gian làm</th>
                        <th>Trạng thái</th>
                        <th>
                            <a href="{{BASE_URL . 'quiz/' }}" class="btn btn-sm btn-success">Tạo mới quiz</a>
                        </th>
                    </thead>
                    <tbody>
                        <?php foreach ($quizs as $quiz) ?>
                        @foreach ($quizs as $quiz)
                            
                            <!-- get randomNumberForId -->
                            @php
                                $ramdumNumber = mt_rand(10, 100)
                            @endphp
                            <tr>
                                <td>
                                    <a href="{{BASE_URL . 'quiz/chi-tiet/' . $quiz->id  }}">{{$quiz->name }}
                                    </a>
                                </td>
                                <td>{{count($quiz->question)}}</td>
                                <td>{{$quiz->duration_minutes }} p</td>
                                <td>
                                    <sub>Bắt đầu: {{ $quiz->start_time }}</sub><br>
                                    <sub>Kết thúc: {{ $quiz->end_time }}</sub>
                                </td>
                                <td>
                                    <span>Kích hoạt: {{ ($quiz->status == 0) ? "Không" : "Có" }}</span><br>
                                    <span>Đảo trộn {{($quiz->is_shuffle == 0) ? "Không" : "Có" }}</span>
                                </td>
                                <td>
                                    <!-- <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#modal-lg">
                                        Tạo câu hỏi
                                    </button> -->
                                    <a href="{{ BASE_URL . 'quiz/tao-cau-hoi/' . $quiz->id }}" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#modal-lg-{{ $quiz->id}}">
                                        Tạo câu hỏi
                                    </a>
                                    <a href=" {{BASE_URL . 'quiz/cap-nhat/' . $quiz->id }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" onclick="confirm_remove('{{BASE_URL . 'quiz/xoa/' . $quiz->id}}', '{{$quiz->name}}') " class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal add question -->
                            <div class="modal fade" id="modal-lg-{{$quiz->id}}">
                                <div class=" modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{$h4 }} <span>{{ $quiz->name }}</span></h4>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ BASE_URL . 'quiz/tao-cau-hoi/' . $quiz->id }}" method="post">
                                            <!-- get quizId -->
                                            <input type="hidden" name="quiz_id" value="{{$quiz->id }}">
                                            <div class="modal-body row">
                                                <div class="question col-6">
                                                    <div class="form-group">
                                                        <label for="">Câu hỏi</label>
                                                        <textarea class="form-control" name="name" id="" rows="6"></textarea>
                                                    </div>
                                                    <i>Tick ✓ vào đáp án đúng</i>
                                                    <div class="icheck-primary d-block">
                                                        <input type="checkbox" id="checkboxPrimary1-{{$ramdumNumber }}" name="is_correct[0]">
                                                        <label for="checkboxPrimary1-{{$ramdumNumber }}">
                                                            Đáp án A
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary d-block">
                                                        <input type="checkbox" id="checkboxPrimary2-{{$ramdumNumber }}" name="is_correct[1]">
                                                        <label for="checkboxPrimary2-{{$ramdumNumber }}">
                                                            Đáp án B
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary d-block">
                                                        <input type="checkbox" id="checkboxPrimary3-{{$ramdumNumber }}" name="is_correct[2]">
                                                        <label for="checkboxPrimary3-{{$ramdumNumber }}">
                                                            Đáp án C
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary d-block">
                                                        <input type="checkbox" id="checkboxPrimary4-{{$ramdumNumber }}" name="is_correct[3]">
                                                        <label for="checkboxPrimary4-{{$ramdumNumber }}">
                                                            Đáp án D
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="question col-6">
                                                    <div class="form-group">
                                                        <label for="">Đáp án A</label>
                                                        <input type="text" class="form-control" name="answer[0]" id="" aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Đáp án B</label>
                                                        <input type="text" class="form-control" name="answer[1]" id="" aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Đáp án C</label>
                                                        <input type="text" class="form-control" name="answer[2]" id="" aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Đáp án D</label>
                                                        <input type="text" class="form-control" name="answer[3]" id="" aria-describedby="helpId" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
    <script>
        function confirm_remove(url, name) {
            Swal.fire({
                title: `Bạn có thực sự muốn xóa "${name}"?`,
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Huỷ',
                confirmButtonText: 'Đồng ý'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Xoá thành công!',
                        '',
                        'success'
                    )
                    setTimeout(() => {
                        window.location.href = url
                    }, 800);
                }
            })
        }
    </script>
@endsection