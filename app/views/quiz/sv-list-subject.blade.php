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
               <div class="row">
                    @foreach ($subjects as $item)
                        <div class="col-md-3">
                            <div class="card card-success">
                            <div class="card-header">
                                {{-- <h3 class="card-title">Success</h3> --}}

                                <div class="card-tools">
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> --}}
                                </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a class="btn" href="{{BASE_URL. "sv/quiz/". $item->id}}">{{$item->name}}</a>       
                                     
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection