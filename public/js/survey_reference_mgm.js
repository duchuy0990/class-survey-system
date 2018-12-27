$(document).ready(function () {
    $("form.search-form").submit(function (e) { 
        e.preventDefault();
        data = $("form.search-form").find("input").val();
        $.get("survey_ref_mgm/search/"+data,
            function (data, textStatus, jqXHR) {
                classes = JSON.parse(data);
                rows = null;
                i=1;
                classes.forEach(function (lop) {
                    ten_mh = lop.ten_mh;
                    gv = lop.gv;
                    ma_mh = lop.ma_mh;
                    so_sv = lop.so_sv;
                    da_danh_gia = lop.da_danh_gia;
                    chua_danh_gia = lop.chua_danh_gia;
                    row = "<tr>\n"
                                +"<th scope=\"row\">"+i+"</th>\n"
                                +"<td>"+ten_mh+"</td>\n"
                                +"<td>"+ma_mh+"</td>\n"
                                +"<td>"+gv+"</td>\n"
                                +"<td>"+so_sv+"</td>\n"
                                +"<td>"+da_danh_gia+"</td>\n"
                                +"<td>"+chua_danh_gia+"</td>\n"
                                +"<td class=\"manager\">"
                                    +"<a href=\"\">Xem kết quả</a>"
                                +"</td>"
                            +"</tr>\n";
                    rows+=row;
                });
                $("table.list-monhoc tbody").html(rows);
        });
    });
});

$(document).ajaxStart(function(){
    $(".loader").css("display", "block");
});

$(document).ajaxComplete(function(){
    $(".loader").css("display", "none");
});