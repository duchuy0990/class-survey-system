<form class="search-form" action="" style="margin:auto;max-width:400px">
    <input type="text" placeholder="Search.." name="class_search">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>
<div id="data-cuoc-ks" name="cuoc-ks">
    <div class="table-responsive">
        <table class="table table-hover list-monhoc">
            <thead class="thead-dark">
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