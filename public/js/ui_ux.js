
// xóa khóa học
$('.delete-subject').click(function() {
	var idSub = $(this).parent().siblings('.id-subject').text();
	var id = idSub.toUpperCase();
	swal({
	  	title: "Bạn có chắc chắn muốn xóa?",
	  	text: "Khi bạn xác nhận, khóa học "+ id+ " sẽ KHÔNG CÒN TỒN TẠI ở bất cứ đâu trên hệ thống!",
	  	icon: "warning",
	  	buttons: true,
	  	dangerMode: true,
	})
	.then((willDelete) => {
	  	if (willDelete) {
	    	swal("Bạn đã xóa thành công khóa học!", {
	      	icon: "success",
	    	});
	  	} else {
	    	swal("Khóa học chưa bị xóa!");
	  	}
	});
});


//sửa khóa học,tính năng tạm thời,sẽ dùng json đổ dữ liệu sau
$('#btn-edit').click(function() {
	window.open("../BTL_PTUD_WEB/adminPageView.html");
});

// Tắt gửi form nếu xảy ra trường hợp chưa được điền
(function checkCreate() {
  	'use strict';
  	window.addEventListener('load', function() {

	    // lấy tất cả các input trong form
	    var forms = document.getElementsByClassName('needs-validation');
	    // lặp và ngăn k được gửi nếu chưa được điền
	    var validation = Array.prototype.filter.call(forms, function(form) {
	      	form.addEventListener('submit', function(event) {
		        if (form.checkValidity() === false) {
		          	event.preventDefault();
		          	event.stopPropagation();
		        }
	        	form.classList.add('was-validated'); 
	      	}, false);
	    });
  	}, false);
  	
})();

$('.btn-create-course').click(function() {
	
	swal({
	  title: "Bạn có chắc chắn muốn thêm khóa học?",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	    swal("Bạn đã thêm thành công khóa học!", {
	      icon: "success",
	    });
	  } else {
	    swal("Khóa học chưa được thêm!");
	  }
	});
});

$('.div-check').children('.checked, .unchecked').click(function () {
    $(this).toggleClass('checked');
    $(this).toggleClass('unchecked');
});


//button quản lý
// $(document).ready(function () {
// 	$('.btn-manager button').click(function() {
// 		var valueBtn = $(this).attr('name');
// 		var valueName = $('.append-data > div');
// 		$.each(valueName,function (index,item) {
// 			if (valueBtn == $(item).attr('name')) {
// 				$(item).fadeIn();
// 			}else{
// 				$(item).fadeOut();
// 			}
// 		});
// 	});
// });


//hết button quản lý


$(document).ready(function () {
	
	$('#ql-tk-sv').click(function (e) { 
		e.preventDefault();
		$(".content").html("");
		$(".btn-manager > button").removeClass("active");
		$(this).addClass("active");
		$.get("student_mgm",
			function (data) {
				$('.content').html(data);
			}
		);
	});
	$('#ql-phieu-ks').click(function (e) { 
		e.preventDefault();
		$(".content").html("");
		$(".btn-manager > button").removeClass("active");
		$(this).addClass("active");
		$.get("survey_item_mgm",
			function (data) {
				$('.content').html(data);
			}
		);
	});

	$('#ql-cuoc-ks').click(function (e) { 
		e.preventDefault();
		$(".content").html("");
		$(".btn-manager > button").removeClass("active");
		$(this).addClass("active");
		$.get("survey_ref_mgm",
			function (data) {
				$('.content').html(data);
			}
		);
	});

	$('#ql-tk-gv').click(function (e) { 
		e.preventDefault();
		$(".content").html("");
		$(".btn-manager > button").removeClass("active");
		$(this).addClass("active");
		$.get("teacher_mgm",
			function (data) {
				$('.content').html(data);
			}
		);
	});

	$(document).ajaxStart(function(){
		$("#loaderModal").modal('show');
	});
	
	$(document).ajaxComplete(function(){
		$("#loaderModal").modal('hide');
	});
});