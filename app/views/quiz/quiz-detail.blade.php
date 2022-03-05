@extends('layouts.main')
@section('main-content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-6">
                            <!-- <div class="form-group">
                                <input type="text" name="keyword" value="<?= $keyword ?>" class="form-control" placeholder="Tìm kiếm..." aria-describedby="helpId">
                            </div> -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
               <table class="table tabl-stripped">
                    <thead>
                        <th class="col-1">Stt</th>
                        <th class="col-4">Câu hỏi</th>
                        <th class="col-3">Câu trả lời</th>
                        <th class="col-2">Đáp án đúng</th>
                        <th class="col-2">Thao tác</th>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($questions as $question)  
                            @php
                                $i++;

                                // get randomNumberForId
                                $ramdumNumber = mt_rand(10, 100)
                            @endphp                     
                        <tr>
                            <td>Câu {{$i}}</td>
                            <td>{{$question->name}}</td>
                            <td>
                                <ul>
                                    @foreach ($question->answers as $item)
                                    <li>{{$item->content}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                     @foreach ($question->answers as $item)
                                        @if ($item->is_correct === 1)
                                            <li>{{$item->content}}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{BASE_URL . 'quiz/cau-hoi/cap-nhat/' . $question->id }}" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-lg-{{ $question->id}}">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="javascript:;" onclick="confirm_remove('{{BASE_URL . 'quiz/cau-hoi/xoa/' . $question->id}}', '{{$question->name}}')" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal add question -->
                            <div class="modal fade" id="modal-lg-{{$question->id}}">
                                <div class=" modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{$h4}}</span></h4>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ BASE_URL . 'quiz/cau-hoi/cap-nhat/' . $question->id }}" method="post">
                                            <!-- get quiz-id -->
                                            <!-- get question_id -->
                                            <input type="hidden" name="quiz_id" value="{{$quiz_id}}">
                                            <input type="hidden" name="question_id" value="{{$question->id }}">
                                            <div class="modal-body row">
                                                <div class="question col-6">
                                                    <div class="form-group">
                                                        <label for="">Câu hỏi</label>
                                                        <textarea class="form-control" name="name" id=""  rows="6">{{$question->name}}</textarea>
                                                    </div>
                                                    <i>Tick ✓ vào đáp án đúng</i>
                                                    @php
                                                        $a ="A";
                                                        $y=0;
                                                        $k=0;
                                                        $ramdumNumber = mt_rand(10, 100);
                                                    @endphp 

                                                    @foreach ($question->answers as $item)
                                                        {{-- @if ($item->is_correct === 1)
                                                            <li>{{$item->content}}</li>
                                                        @endif --}}
                                                         <div class="icheck-primary d-block">
                                                        <input {{($item->is_correct === 1)? "checked" : ''}} type="checkbox" id="checkboxPrimary{{++$k}}-{{$ramdumNumber }}" name="is_correct[{{$y++}}]">
                                                        <label for="checkboxPrimary{{$k}}-{{$ramdumNumber }}">
                                                            Đáp án {{$a++}}
                                                        </label>
                                                    </div>          
                                                    @endforeach
                                                                                             
                                                </div>
                                                <div class="question col-6">
                                                    @php
                                                        $a ="A";
                                                        $y=0;
                                                    @endphp 
                                                     @foreach ($question->answers as $item)
                                                        <div class="form-group">
                                                            <label for="">Đáp án {{$a++}}</label>
                                                            <input type="text" class="form-control" value="{{$item->content}}" name="answer[{{$y++}}]" id="" aria-describedby="helpId" placeholder="">
                                                        </div>
                                                     
                                                    @endforeach
        
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