<table>
    <tr>
        <td>Môn học</td>
        <td>{{$mh_info[0]->ten_mh}}</td>
    </tr>
    <tr>
        <td>Mã môn học</td>
        <td>{{$mh_info[0]->ma_mh}}</td>
    </tr>
    <tr>
        <td>Giảng viên</td>
        <td>{{$ten_gv[0]->ten_gv}}</td>
    </tr>
</table>
<table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu chí</th>
                <th>Điểm TB</th>
                <th>Trên 5</th>
                <th>Dưới 5</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach ($result as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td class="criteria">{{$item->ndung_phieu_ks}}</td>
                    <td class="medium-score">{{$item->dtb}}</td>
                    <td class="up-5">{{$item->greater_5}}%</td>
                    <td class="under-5">{{100-$item->greater_5}}%</td>
                </tr>
            @endforeach
        </tbody>
</table>

<table>
    <tr>
        <td>Điểm TB</td>
        <td>Tổng điểm sinh viên đánh giá cho tiêu chí / số sinh viên</td>
    </tr>
    <tr>
        <td>Trên 5:</td>
        <td>Tỉ lệ sinh viên đánh giá trên 5 điểm</td>
    </tr>
    <tr>
        <td>Dưới 5:</td>
        <td>Tỉ lệ sinh viên đánh giá dưới 5 điểm</td>
    </tr>
</table>