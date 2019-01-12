<head>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>


<form class="search-form" action="" style="margin:auto;max-width:400px">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search.." name="class_search">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>
<div class="add-item">
    <a  data-toggle="modal" data-target="#add-excel-modal" style="cursor:pointer;color:rgb(0,0,255)">
        <i style="font-size:30px;" class="fas fa-plus"></i>
    </a>
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
                <form id="form-add-excel" action="">
                    <input type="file" id="file" name="file" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-success">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="data-cuoc-ks" name="cuoc-ks">
    <div class="table-responsive">
        <table class="table table-hover list-monhoc">
            <thead class="table-active">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên khóa học</th>
                <th scope="col">Mã khóa học</th>
                <th scope="col">Tên giảng viên</th>
                <th scope="col">Số SV</th>
                <th scope="col">Đã đánh giá</th>
                <th scope="col">Chưa đánh giá</th>
                <th scope="col" title="Xóa khóa học">Kết quả</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach ($info as $value)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td class="name-subject">{{$value->ten_mh}}</td>
                    <td class="id-subject">{{$value->ma_mh}}</td>
                    <td class="name-teacher">{{$value->gv}}</td>
                    <td class="sum-student-class">{{$value->so_sv}}</th>
                    <td class="evaluated">{{$value->da_danh_gia}}</td>
                    <td class="un-evaluated">{{$value->chua_danh_gia}}</td>
                    <td class="manager"><a target="_blank" href="{{url('admin/result/'.$value->ma_mh)}}"><img class="icon watch-sub" src="{{ asset('images/icon-eye.png') }}"></a></td>
                </tr>
                <?php $i++; ?>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('js/survey_reference_mgm.js') }}"></script>