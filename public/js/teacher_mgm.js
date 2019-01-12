
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $('.btn-edit').click(function (e) { 
        e.preventDefault();
        username = $(this).attr('data');
        $.get("teacher_mgm/info/"+username,
            function (data, textStatus, jqXHR) {
                teacher = JSON.parse(data);
                $("#edit-modal").find("#username").val(teacher[0].username);
                $("#edit-modal").find("#ho_ten").val(teacher[0].ho_ten);
                $("#edit-modal").find("#email").val(teacher[0].email);
                $("#edit-modal").find("#id").val(teacher[0].id);
            }
        );
    });

    $(".modal").on('hide.bs.modal', function () {
        $(this).find("input").val("");
    });

    $('#form-edit').submit(function (e) {
        e.preventDefault();
        data = $('#form-edit').serialize();
        $.post("teacher_mgm/edit/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("teacher_mgm",
                    function (data) {
                        $('.content').html(data);
                        alert("Thành công");
                        $(".modal-backdrop").remove();
                    }
                );
            }
        );
    });
    
    $('.btn-delete').click(function (e) { 
        e.preventDefault();
        id = $(this).attr('data');
        $("#delete-modal").find("#id").val(id);
    });

    $('#form-delete').submit(function (e) {
        e.preventDefault();
        data = $("#form-delete").serialize();
        $.post("teacher_mgm/delete/submit",
            data,
            function (data, textStatus, jqXHR) {
                $.get("teacher_mgm",
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
        $.get("teacher_mgm/search/"+data,
            function (data, textStatus, jqXHR) {
                teachers = JSON.parse(data);
                rows = null;
                i=1;
                teachers.forEach(function (teacher) {
                    ho_ten = teacher.ho_ten;
                    username = teacher.username;
                    email = teacher.email;
                    row = "<tr>\n"
                                +"<th scope=\"row\">"+i+"</th>\n"
                                +"<td>"+ho_ten+"</td>\n"
                                +"<td>"+username+"</td>\n"
                                +"<td>"+email+"</td>\n"
                                +"<td class=\"action-st\">\n"
                                    +"<button type=\"button\" data=\""+username+"\" class=\"btn btn-success btn-sm btn-edit\" data-toggle=\"modal\" data-target=\"#edit-modal\" data-backdrop=\"true\">Sửa</button>\n"
                                    +"<button type=\"button\" data=\""+username+"\" class=\"btn btn-danger btn-sm btn-delete\" data-toggle=\"modal\" data-target=\"#delete-modal\" data-backdrop=\"true\">Xóa</button>\n"
                                +"</td>\n"
                            +"</tr>\n";
                    rows+=row;
                });
                $("table tbody").html(rows);
            }
        );
    });

    //add
    //excel
    $('#form-add-excel').submit(function (e) { 
        e.preventDefault();
        var formData = new FormData();
        formData.append('file', $('form#form-add-excel input#file')[0].files[0]);
        // var file = new FormData($(this).find("#file")[0].files[0]);
        $.ajax({
            type: "post",
            url: "teacher_mgm/import/excel",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                        alert(data);
                        $.get("teacher_mgm",
                            function (data) {
                                $('.content').html(data);
                                $(".modal-backdrop").remove();
                            }
                        );
                    }
        });
    });
    //add 1 gv
    $('#form-add-1').submit(function (e) { 
        e.preventDefault();
        data = $(this).serialize();
        $.ajax({
            type: "post",
            url: "teacher_mgm/import/1",
            data: data,
            success: function (response) {
                $.get("teacher_mgm",
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
