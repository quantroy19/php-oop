@extends('layouts.main')
@section('main-content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= BASE_URL . 'quiz/cap-nhat/' . $quizs->id ?>" method="post">
                    <div class="col-6 offset-3">
                        <div class="form-group">
                            <label for="">Tên quiz</label>
                            <input type="text" name="name" class="form-control" value="<?= $quizs->name ?>" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Môn học</label>
                            <select class="custom-select form-control" id="exampleSelectBorder" name="subject_id">
                                <?php foreach ($subjects as $sub) : ?>

                                    <?php $selected =  ($sub->id == $quizs->subject_id) ? 'selected' : '' ?>
                                    <option <?= $selected ?> value="<?= $sub->id ?>"><?= $sub->name ?></option>

                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Làm trong (phút)</label>
                            <input type="number" class="form-control" value="<?= $quizs->duration_minutes ?>" name="duration_minutes" value="<?= $quizs->duration_minutes ?>" aria-describedby="helpId">
                        </div>
                        <!-- Date and time -->
                        <div class="form-group">
                            <label>Thời gian bắt đầu:</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="start_time" value="<?= date("m-d-Y h:i:a", strtotime($quizs->start_time)) ?>" />
                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Thời gian kết thúc:</label>
                            <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime2" name="end_time" value="<?= date("m-d-Y h:i:a", strtotime($quizs->end_time)); ?>" />
                                <div class="input-group-append" data-target="#reservationdatetime2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Kích hoạt</label>
                            <select class="form-control" name="status" id="">
                                <?php $selected =  ($quizs->status != 1) ? 'selected' : '' ?>

                                <option value="1">Có</option>
                                <option <?= $selected ?> value="0">Không</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <?php $checked =  ($quizs->is_shuffle == 1) ? 'checked' : '' ?>
                                <input type="checkbox" class="form-check-input" name="is_shuffle" <?= $checked ?> value="1">
                                Đảo trộn câu hỏi
                            </label>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-sm btn-primary" name="submit">Lưu</button>
                            &nbsp;
                            <a href="<?= BASE_URL . 'quiz' ?>" class="btn btn-sm btn-dark">Hủy</a>
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