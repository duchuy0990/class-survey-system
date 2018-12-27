$(document).ready(function () {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $(".modal").on('hide.bs.modal', function () {
        $(this).find("input").val("");
    });

    //edit
    $('.btn-edit').click(function (e) { 
        e.preventDefault();
        // lấy id sv
        id = $(this).attr('data');
        //ajax: get thông tin sv 
        $.get("student_mgm/info/"+id,
            function (data, textStatus, jqXHR) {
                student = JSON.parse(data);
                //Đặt thông tin lấy được vào các input
                $("#edit-modal").find("#msv").val(student[0].username);
                $("#edit-modal").find("#ho_ten").val(student[0].ho_ten);
                $("#edit-modal").find("#email").val(student[0].email);
                $("#edit-modal").find("#id").val(student[0].id);
                $("#edit-modal").find("#lop_khoa_hoc").val(student[0].lop_khoa_hoc);
            }
        );
    });

    // submit form edit thông tin sv
    $('#form-edit').submit(function (e) {
        e.preventDefault();
        data = $('#form-edit').serialize();
        $.post("student_mgm/edit/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("student_mgm",
                    function (data) {
                        $('.content').html(data);
                        alert("Thành công");
                        $(".modal-backdrop").remove();
                    }
                );
            }
        );
    });
    
    //delete
    $('.btn-delete').click(function (e) { 
        e.preventDefault();
        // lấy id sv
        id = $(this).attr('data');
        $("#delete-modal").find("#id").val(id);
    });

    $('#form-delete').submit(function (e) {
        e.preventDefault();
        data = $("#form-delete").serialize();
        $.post("student_mgm/delete/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("student_mgm",
                    function (data) {
                        $('.content').html(data);
                        alert("Thành công");
                        $(".modal-backdrop").remove();
                    }
                );
            }
        );
    });

    //search 
    $('.search-form').submit(function (e) { 
        e.preventDefault();
        data = $("form.search-form").find("input").val();
        $.get("student_mgm/search/"+data,
            function (data, textStatus, jqXHR) {
                students = JSON.parse(data);
                rows = null;
                i=1;
                students.forEach(function (student) {
                    ho_ten = student.ho_ten;
                    username = student.username;
                    email = student.email;
                    lop_khoa_hoc = student.lop_khoa_hoc;
                    id = student.id;
                    row = "<tr>\n"
                                +"<th scope=\"row\">"+i+"</th>\n"
                                +"<td>"+ho_ten+"</td>\n"
                                +"<td>"+username+"</td>\n"
                                +"<td>"+email+"</td>\n"
                                +"<td>"+lop_khoa_hoc+"</td>\n"
                                +"<td class=\"action-st\">\n"
                                    +"<button type=\"button\" data=\""+id+"\" class=\"btn btn-success btn-sm btn-edit\" data-toggle=\"modal\" data-target=\"#edit-modal\" data-backdrop=\"true\">Sửa</button>\n"
                                    +"<button type=\"button\" data=\""+id+"\" class=\"btn btn-danger btn-sm btn-delete\" data-toggle=\"modal\" data-target=\"#delete-modal\" data-backdrop=\"true\">Xóa</button>\n"
                                +"</td>\n"
                            +"</tr>\n";
                    rows+=row;
                });
                $("table tbody").html(rows);
            }
        );
    });

    //add
    // form add excel bị lỗi
    $('#form-add-excel').submit(function (e) { 
        e.preventDefault();
        // var formData = new FormData();
        // formData.append('file', $('form#form-add-excel input#file')[0].files[0]);
        var file = new FormData($(this)[0].files);
        $.ajax({
            type: "post",
            url: "student_mgm/import/excel",
            data: file,
            contentType: false,
            processData: false,
            success: function (data) {
                        alert(data);
                        $.get("student_mgm",
                            function (data) {
                                $('.content').html(data);
                                $(".modal-backdrop").remove();
                            }
                        );
                    }
        });
    });

    $('#form-add-1').submit(function (e) { 
        e.preventDefault();
        data = $(this).serialize();
        $.ajax({
            type: "post",
            url: "student_mgm/import/1",
            data: data,
            success: function (response) {
                $.get("student_mgm",
                    function (data) {
                        $('.content').html(data);
                        alert("Thành công");
                        $(".modal-backdrop").remove();
                    }
                );
            },
            error: function(response) {
                var error = JSON.parse(response.responseText);
                let errorText = "";
                $.each(error.errors, function (key,value) {
                    errorText += value +"\n";
                });
                alert(errorText);
            }
        });
    });
});