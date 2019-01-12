@extends('layouts.app')

@section('guard')
    <a class="navbar-brand" href="{{ route('admin.home') }}">ADMIN</a>
@stop

@section('link_logout'){{url('admin/logout')}}@endsection

	
@section('content')
        <div class="container">
            <div class="container-create">
                <div class="btn-manager">
                    <button type="button" class="btn btn-outline-secondary" id="ql-phieu-ks" name="phieu-ks">
                        Quản lý phiếu
                    </button>
                    <button type="button" class="btn btn-outline-primary" id="ql-tk-sv" name="tk-sv">
                        Quản lý sinh viên
                    </button>
                    <button type="button" class="btn btn-outline-success" id="ql-tk-gv" name="tk-gv">
                        Quản lý giảng viên
                    </button>
                    <button type="button" class="btn btn-outline-warning" id="ql-cuoc-ks" name="cuoc-ks">
                        Quản lý Khảo sát
                    </button>
                </div>
            </div>
            <div class="content append-data"></div>
        </div>
    
<script type="text/javascript" src="{{ asset('js/ui_ux.js') }}"></script>
@stop