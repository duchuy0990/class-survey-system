$(document).ready(function () {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
//category
    //edit category
    $('.btn-edit-category').click(function (e) { 
        e.preventDefault();
        category = $(this).attr('data');
        $.get("survey_item_mgm/category/info/"+category,
            function (data, textStatus, jqXHR) {
                info = JSON.parse(data);
                $("#category-edit-modal").find("#ma_category").val(info[0].ma_category);
                $("#category-edit-modal").find("#ten_category").val(info[0].ten_category);
            }
        );
    });

    $('#form-edit-category').submit(function (e) {
        e.preventDefault();
        data = $('#form-edit-category').serialize();
        $.post("survey_item_mgm/category/edit/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("survey_item_mgm",
                    function (data) {
                        $('.content').html(data);
                        $(".modal-backdrop").remove();
                    }
                );
            }
        );
    });
    
    //delete
    $('.btn-delete-category').click(function (e) { 
        e.preventDefault();
        category = $(this).attr('data');
        $.get("survey_item_mgm/category/info/"+category,
            function (data, textStatus, jqXHR) {
                info = JSON.parse(data);
                $("#category-delete-modal").find("#ma_category").val(info[0].ma_category);
            }
        );
    });

    $('#form-delete-category').submit(function (e) {
        e.preventDefault();
        data = $("#form-delete-category").serialize();
        $.post("survey_item_mgm/category/delete/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("survey_item_mgm",
                    function (data) {
                        $('.content').html(data);
                        alert("Thành công");
                        $(".modal-backdrop").remove();
                    }
                );
            }
        );
    });

    $('#form-add-category').submit(function (e) { 
        e.preventDefault();
        data = $("#form-add-category").serialize();
        $.post("survey_item_mgm/category/add/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("survey_item_mgm",
                    function (data) {
                        $('.content').html(data);
                        alert("Thành công");
                        $(".modal-backdrop").remove();
                    }
                );
            }
        );
    });
//end category

//start item
    //edit item
    $('.btn-edit-item').click(function (e) { 
        e.preventDefault();
        item = $(this).attr('data');
        $.get("survey_item_mgm/item/info/"+item,
            function (data, textStatus, jqXHR) {
                info = JSON.parse(data);
                $("#item-edit-modal").find("input#ma_phieu").val(info[0].ma_phieu);
                $("#item-edit-modal").find("input#ndung_phieu_ks").val(info[0].ndung_phieu_ks);
            }
        );
    });

    $('#form-edit-item').submit(function (e) {
        e.preventDefault();
        data = $('#form-edit-item').serialize();
        $.post("survey_item_mgm/item/edit/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("survey_item_mgm",
                    function (data) {
                        $('.content').html(data);
                        $(".modal-backdrop").remove();
                    }
                );
            }
        );
    });
    
    //delete item
    $('.btn-delete-item').click(function (e) { 
        e.preventDefault();
        item = $(this).attr('data');
        $.get("survey_item_mgm/item/info/"+item,
            function (data, textStatus, jqXHR) {
                info = JSON.parse(data);
                $("#item-delete-modal").find("#ma_phieu").val(info[0].ma_phieu);
            }
        );
    });

    $('#form-delete-item').submit(function (e) {
        e.preventDefault();
        data = $("#form-delete-item").serialize();
        $.post("survey_item_mgm/item/delete/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("survey_item_mgm",
                    function (data) {
                        $('.content').html(data);
                        alert("Thành công");
                        $(".modal-backdrop").remove();
                    }
                );
            }
        );
    });
    
    $('.btn_add_item').click(function (e) { 
        e.preventDefault();
        category = $(this).attr('data');
        $.get("survey_item_mgm/category/info/"+category,
            function (data, textStatus, jqXHR) {
                info = JSON.parse(data);
                $("#item-add-modal").find("#ma_category").val(info[0].ma_category);
            }
        );
    });

    $('#form-add-item').submit(function (e) { 
        e.preventDefault();
        data = $("#form-add-item").serialize();
        $.post("survey_item_mgm/item/add/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("survey_item_mgm",
                    function (data) {
                        $('.content').html(data);
                        alert("Thành công");
                        $(".modal-backdrop").remove();
                    }
                );
            }
        );
    });
//end item
    $(document).ajaxStart(function(){
        $(".loader").css("display", "block");
    });

    $(document).ajaxComplete(function(){
        $(".loader").css("display", "none");
    });
}); // end document.ready

