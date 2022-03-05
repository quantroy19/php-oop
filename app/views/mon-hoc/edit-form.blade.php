@extends('layouts.main')
@section('main-content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= BASE_URL . 'mon-hoc/cap-nhat/' . $model->id ?>" method="post">
                    <div class="col-6 offset-3">
                        <div class="form-group">
                            <label for="">Tên môn học</label>
                            <input type="text" name="name" class="form-control" value="<?= $model->name ?>">
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">Lưu</button>
                            &nbsp;
                            <a href="<?= BASE_URL . 'mon-hoc' ?>" class="btn btn-sm btn-dark">Hủy</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
