@extends('layouts.main')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{BASE_URL . 'quiz/tao-moi' }}" method="post">
                    <div class="col-6 offset-3">
                        <div class="form-group">
                            <label for="">Tên quiz</label>
                            <input type="text" name="name" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Môn học</label>
                            <select class="custom-select form-control" id="exampleSelectBorder" name="subject_id"> 
                                @foreach ($subjects as $sub)
                                    <option value="{{$sub->id }}">{{$sub->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Làm trong (phút)</label>
                            <input type="number" class="form-control" value="15" name="duration_minutes" aria-describedby="helpId">
                        </div>
                        <!-- Date and time -->
                        <div class="form-group">
                            <label>Thời gian bắt đầu:</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="start_time" />
                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Thời gian kết thúc:</label>
                            <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime2" name="end_time" />
                                <div class="input-group-append" data-target="#reservationdatetime2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Kích hoạt</label>
                            <select class="form-control" name="status" id="">
                                <option selected value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="is_shuffle" id="" value="1">
                                Đảo trộn câu hỏi
                            </label>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-sm btn-primary" name="submit">Lưu</button>
                            &nbsp;
                            <a href="{{ BASE_URL . 'quiz' }}" class="btn btn-sm btn-dark">Hủy</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        //Date and time picker
        $('#reservationdatetime').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });
        $('#reservationdatetime2').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });
    })
</script>
@endsection