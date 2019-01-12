<head>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<div id="data-phieu-ks" name="phieu-ks"> 
    <div>
        @foreach ($result as $category)
            <div class="row category-survey">
                <h3 class="col-9">{{ key($category) }}</h3>
                <div class="col-3">
                    <button type="button" class="btn btn-success btn-sm btn-edit-category" data="{{ key($category) }}" data-toggle="modal" data-target="#category-edit-modal">Sửa</button>
                    <button type="button" class="btn btn-danger btn-sm btn-delete-category" data="{{ key($category) }}" data-toggle="modal" data-target="#category-delete-modal">Xóa</button>
                </div>
            </div>
                @foreach ($category as $survey)
                    @foreach ($survey as $value)
                        <div class="row item-survey">
                            <p class="col-8"> {{$value['ndung_phieu_ks']}}</p>
                            <div class="col-4">
                                <button type="button" data="{{ $value['ma_phieu'] }}" class="btn btn-success btn-sm btn-edit-item" data-toggle="modal" data-target="#item-edit-modal">Sửa</button>
                                <button type="button" data="{{ $value['ma_phieu'] }}" class="btn btn-danger btn-sm btn-delete-item" data-toggle="modal" data-target="#item-delete-modal">Xóa</button>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            <div class="row">
                <p class="col-8"></p>
                <div class="col-4">
                    <button type="button" class="btn_add_item btn btn-primary" data="{{key($category)}}" data-toggle="modal" data-target="#item-add-modal">Thêm nội dung</button>
                </div>
            </div>
            <div class="line-pri-bottom"></div>
        @endforeach
        <div class="row">
            <button type="button" class="btn_add_category btn btn-info" data-toggle="modal" data-target="#category-add-modal">Thêm danh mục</button>
        </div>
    </div>

    <!--  Modal add item -->
    <div class="modal fade" id="item-add-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" style="margin-bottom:15px" class="close" data-dismiss="modal">&times;</button>
                    <form id="form-add-item" action="">
                        <input type="hidden" id="ma_category" name="ma_category">
                        <div class="form-group">
                            <input type="text" class="form-control" id="ndung_phieu_ks" placeholder="Nhập nội dung" name="ndung_phieu_ks">
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--  Modal add category -->
    <div class="modal fade" id="category-add-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" style="margin-bottom:15px" class="close" data-dismiss="modal">&times;</button>
                    <form id="form-add-category" action="">
                        <div class="form-group">
                            <input type="text" class="form-control" id="ten_category" placeholder="Nhập nội dung" name="ten_category">
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--  Modal edit category -->
    <div class="modal fade" id="category-edit-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" style="margin-bottom:15px" class="close" data-dismiss="modal">&times;</button>
                    <form id="form-edit-category" action="">
                        <input type="hidden" id="ma_category" name="ma_category">
                        <div class="form-group">
                            <input type="text" class="form-control" id="ten_category" placeholder="Enter category" name="ten_category">
                        </div>
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete category -->
    <div class="modal fade" id="category-delete-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">DELETE</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắc muốn xóa không?</p>
                    <form id="form-delete-category" action="">
                        <input type="hidden" id="ma_category" name="ma_category">
                        <button type="submit" class="btn btn-danger form-inline">Xóa</button>
                        <button type="button" class="btn btn-secondary form-inline" data-dismiss="modal">Thôi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--  Modal edit item -->
    <div class="modal fade" id="item-edit-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" style="margin-bottom:15px" class="close" data-dismiss="modal">&times;</button>
                    <form id="form-edit-item" action="">
                        <input type="hidden" id="ma_phieu" name="ma_phieu">
                        <div class="form-group">
                            <input type="text" class="form-control" id="ndung_phieu_ks" placeholder="Enter item" name="ndung_phieu_ks">
                        </div>
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete item -->
    <div class="modal fade" id="item-delete-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">DELETE</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắc muốn xóa không?</p>
                    <form id="form-delete-item" action="">
                        <input type="hidden" id="ma_phieu" name="ma_phieu">
                        <button type="submit" class="btn btn-danger form-inline">Xóa</button>
                        <button type="button" class="btn btn-secondary form-inline" data-dismiss="modal">Thôi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/survey_item_mgm.js')}}"></script>