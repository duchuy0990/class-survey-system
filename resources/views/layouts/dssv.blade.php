<table>
    <thead class="table-active">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Mã sinh viên</th>
            <th scope="col">Lớp khóa học</th>
            <th scope="col">Email</th>
            <th scope="col">Đã đánh giá</th>
        </tr>
    </thead>
    <tbody>
        @php
            $j=1;
        @endphp
        @foreach ($lssv as $student)
            <tr>
                    <th scope="row">{{$j++}}</th>
                    <td class="name-st">{{$student->sv_name}}</td>
                    <td class="id-st">{{$student->sv_msv}}</td>
                    <td class="class-st">{{$student->sv_lop}}</td>
                    <td class="email-st">{{$student->sv_email}}</td>
                    <td class="da_danh_gia">{{$student->da_danh_gia}}</td>
            </tr>
        @endforeach
    </tbody>
</table>