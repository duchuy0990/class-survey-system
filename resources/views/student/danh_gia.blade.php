@extends('layouts.app')
@section('guard')
    <a class="navbar-brand" href="{{ route('student.home') }}">STUDENT</a>
@stop
@section('username'){{ Auth::user()->ho_ten }}@endsection
@section('link_logout'){{url('student/logout')}}@endsection
@section('content')
    <div class="text-center" id="name-class">{{$info_mh[0]->ten_mh}} - {{$info_mh[0]->ma_mh}}</div>
    <form class="list-criteria" action="@if ($da_danh_gia == 0)
                                            {{url('student/danh_gia/post_danh_gia')}}@else
                                            {{url('student/danh_gia/post_danh_gia_lai')}}@endif" method="POST">
        @csrf
        <input type="hidden" name="ma_mh" value="{{$info_mh[0]->ma_mh}}">
        @php
            $i=1;
        @endphp
        @if (empty($phieu_khao_sat))    {{--nếu không có phiếu khảo sát nào tồn tại--}}
            Không có phiếu khảo sát nào!
        @else
            @foreach ($phieu_khao_sat as $category => $items)
                <div class="branch-criteria">
                    <div class="title-branch">
                        <h3>{{$i++}}. {{$category}}</h3>
                    </div>
                    <div class="node-branch">
                        <ul>
                            <li class="gr-point">
                                <label class="point-cri">2</label>
                                <label class="point-cri">4</label>
                                <label class="point-cri">6</label>
                                <label class="point-cri">8</label>
                                <label class="point-cri">10</label>
                            </li>
                            @foreach ($items as $item)
                                <li class="item-criteria">
                                    <span>{{$item->ndung_phieu_ks}}</span>
                                    <div class="gr-radio justify-content-end">
                                        <div class="c-inputs-stacked">
                                            <label class="radio-item">
                                                <input id="r-s-1" name="_{{$item->ma_phieu}}" type="radio" value="2">
                                            </label>
                                            <label class="radio-item">
                                                <input id="r-s-2" name="_{{$item->ma_phieu}}" type="radio" value="4">
                                            </label>
                                            <label class="radio-item">
                                                <input id="r-s-3" name="_{{$item->ma_phieu}}" type="radio" value="6">
                                            </label>
                                            <label class="radio-item">
                                                <input id="r-s-4" name="_{{$item->ma_phieu}}" type="radio" value="8">
                                            </label>
                                            <label class="radio-item">
                                                <input id="r-s-5" name="_{{$item->ma_phieu}}" type="radio" value="10">
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
            <!-- <div class="branch-criteria">
				<div class="title-branch">
					<h3>Phản hồi :</h3>
				</div>
				<div class="node-branch">
					<textarea class="cri-feedback" placeholder="Bạn có suy nghĩ, ý kiến gì về môn học ..."></textarea>
				</div>
			</div> -->
			<div class="progress progress-cri">
  				<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
            <button type="submit" class="btn btn-primary" id="send-result-st">Nộp kết quả!</button>
        @endif
    </form>
    <script type="text/javascript">

        $('.list-criteria').ready(function() {
            $('.radio-item #r-s-1').hover(function() {
                $(this).attr('title', 'Hoàn toàn không đồng ý');
            }, function() {
                $(this).removeAttr('title');
            });
            $('.radio-item #r-s-2').hover(function() {
                $(this).parent($(this)).attr('title', 'Không đồng ý');
            }, function() {
                $(this).removeAttr('title');
            });
            $('.radio-item #r-s-3').hover(function() {
                $(this).parent($(this)).attr('title', 'Bình thường');
            }, function() {
                $(this).removeAttr('title');
            });
            $('.radio-item #r-s-4').hover(function() {
                $(this).parent($(this)).attr('title', 'Đồng ý');
            }, function() {
                $(this).removeAttr('title');
            });
            $('.radio-item #r-s-5').hover(function() {
                $(this).parent($(this)).attr('title', 'Hoàn toàn đồng ý');
            }, function() {
                $(this).removeAttr('title');
            });

            var countItem = $('.list-criteria .item-criteria');
            var i = 0;
            $.each(countItem, function (index,el) {
                i++;
            })
            // xử lý progress
            var valProgress = 0;
            var countChecked = function() {	
                var count = $( "input:checked" ).length;
                valProgress = (count/i)*100 + '%';
                $('.progress-bar').css('width', valProgress);
                $('.progress-bar').text(valProgress);
                if (valProgress == '100%') {
                    $('.progress-bar').text('');
                    $('.progress-bar').text("Hoàn thành !")
                    $('.progress-bar').css('font-weight','bold');
                }
            };
            countChecked();
            $('input[type=radio]').on( "click", countChecked);

            // end progres

            $.get("mark_info/{{$info_mh[0]->ma_mh}}",
                function (data, textStatus, jqXHR) {
                    mark_info = JSON.parse(data);
                    if(mark_info.length != 0) {
                        for (let i = 0; i < mark_info.length; i++) {
                            phieu = mark_info[i].ma_phieu;
                            diem = mark_info[i].diem;
                            $(".radio-item input[name = '_"+ phieu+"'][value = '"+diem+"']").attr('checked', true);
                        }
                        countChecked();
                    }
                    // else {
                    //     $(".radio-item input[value = '10']").attr('checked', true);
                    // }
                }
            );
        });
    </script>
@endsection