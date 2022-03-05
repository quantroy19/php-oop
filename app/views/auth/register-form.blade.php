@extends('layouts.main')
@section('main-content')

<div class="card card-primary mx-auto col-8">
    <!-- <div class="card-header">
        <h1 class="card-title"></h1>
    </div> -->
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ BASE_URL . 'dang-ky'}}" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
               
                <?php if (isset($_SESSION['error'])) : ?>
                    <div>
                        <sub style="color:red"><?= $_SESSION['error'] ?></sub>
                    </div>
                    <?php unset($_SESSION['error']) ?>
                    <?php endif ?>
                    @if (isset($_SESSION['error']))
                        <div>
                            <sub style="color:red">{{$_SESSION['error']}}</sub>
                        </div>
                        @php
                            unset($_SESSION['error'])
                        @endphp   
                    @endif
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Nhập email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Mật khẩu">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Đăng ký</button>
            <!-- <a href="#" type="submit" class="btn btn-primary">Cannot</a> -->
        </div>
    </form>
</div>
@endsection
