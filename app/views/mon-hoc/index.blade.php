@extends('layouts.main')
@section('main-content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-6">
                           
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table tabl-stripped">
                    <thead>
                        <th>Mã môn</th>
                        <th>Tên môn</th>
                        <th>Số quiz</th>
                        <th>Người tạo</th>
                        <th>
                            <a href="{{BASE_URL . 'mon-hoc/tao-moi'}}" class="btn btn-sm btn-success">Tạo mới</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($subjects as $sub)
                        
                            <tr>
                                <td><?= $sub->id ?></td>
                                <td>
                                    <a href="{{BASE_URL . 'quiz/danh-sach-quiz/' . $sub->id}}"><?= $sub->name ?></a>
                                </td>
                                <td>{{ count($sub->quizs)}}</td>
                                <td><?= $sub->teacher_name ?></td>
                                <td>
                                    <a href="{{BASE_URL . 'mon-hoc/cap-nhat/' . $sub->id}}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="javascript:;" onclick="confirm_remove('{{ BASE_URL . 'mon-hoc/xoa/' . $sub->id }}', '{{$sub->name}}')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
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