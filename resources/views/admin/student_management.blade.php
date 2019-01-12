<head>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>

<form class="search-form" action="" style="margin:auto;max-width:400px">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search.." name="sv_search">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>
<div class="dropdown add-item">
  <a href="" data-toggle="dropdown"><i style="font-size:30px;" class="fas fa-plus"></i></a>
  <div class="dropdown-menu">
    <a class="dropdown-item" data-toggle="modal" data-target="#add-1-modal" data-backdrop="true">Thêm thủ công</a>
    <a class="dropdown-item" data-toggle="modal" data-target="#add-excel-modal" data-backdrop="true">Thêm bằng file excel</a>
  </div>
</div>
<div class="table-responsive admin-status">
    <table class="table table-hover">
        <thead class="table-active">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Mã sinh viên</th>
            <th scope="col">Email</th>
            <th scope="col">Lớp khóa học</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        @foreach ($students as $student)
            <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$student->ho_ten}}</td>
                <td>{{$student->username}}</td>
                <td>{{$student->email}}</td>
                <td>{{$student->lop_khoa_hoc}}</td>
                <td class="action-st">
                    <button type="button" data="{{ $student->id }}" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#edit-modal" data-backdrop="false">Sửa</button>
                    <button type="button" data="{{ $student->id }}" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#delete-modal" data-backdrop="false">Xóa</button>
                </td>
            </tr>
            <?php $i++; ?>
        @endforeach
        </tbody>
    </table>

    <!--  Modal thêm 1 sv -->
    <div class="modal fade" id="add-1-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">THÊM MỚI</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="form-add-1" action="">
                        <div class="form-group">
                            <label for="msv">MSV:</label>
                            <input type="text" class="form-control" id="msv" placeholder="Enter msv" name="username">
                        </div>
                        <div class="form-group">
                            <label for="ho_ten">Họ Tên:</label>
                            <input type="text" class="form-control" id="ho_ten" placeholder="Enter name" name="ho_ten">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu:</label>
                            <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
                        </div>
                        <div>
                            <label for="lop_khoa_hoc">Lớp khóa học:</label>
                            <input type="text" class="form-control" id="lop_khoa_hoc" placeholder="Enter class" name="lop_khoa_hoc">
                        </div>
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal thêm excel -->
    <div class="modal fade" id="add-excel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ADD</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="form-add-excel" enctype="multipart/form-data" action="">
                        {{ csrf_field() }}
                        <input type="file" id="file" name="file" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-success">Import User Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--  Modal edit -->
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">EDIT</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="form-edit" action="">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="msv">MSV:</label>
                            <input type="text" class="form-control" id="msv" placeholder="Enter msv" name="username">
                        </div>
                        <div class="form-group">
                            <label for="ho_ten">Họ Tên:</label>
                            <input type="text" class="form-control" id="ho_ten" placeholder="Enter name" name="ho_ten">
                        </div>
                        <div>
                            <label for="lop_khoa_hoc">Lớp khóa học:</label>
                            <input type="text" class="form-control" id="lop_khoa_hoc" placeholder="Enter class" name="lop_khoa_hoc">
                        </div>
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">DELETE</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắc muốn xóa không?</p>
                    <form id="form-delete" action="">
                        <input type="hidden" id="id" name="id">
                        <button type="submit" class="btn btn-danger form-inline">Xóa</button>
                        <button type="button" class="btn btn-secondary form-inline" data-dismiss="modal">Thôi</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/student_mgm.js') }}"></script>