var g_key

function reloadEdit(val) {
	var url = "/admin/account";
	$('#' + val + '-form-wrapper').load(url + ' #' + val + '-text');

	$('#' + val + '-edit-wrapper').load(url + ' #' + val + '-edit', function() {			
		setBtnEdit();
	});
}

function reloadAvatar() {
	var url = "/admin/account";

	$('#avatar-container').load(url + ' #avatar-wrapper');
	$('#user-panel-container'	).load(url + ' #user-panel');
	$('#pp-container').load(url + ' #profile-picture', function() {
		resizeAvatar();
	});
}

function setSubmitFile() {
	$('#img-update-form').off('submit').on('submit', function(e) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		e.preventDefault();
		var url =  $(this).attr('action');
		var formData = new FormData(this);

		$.ajax({
			type:'post',
			url: url,
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function()
			{
				$('.invalid-feedback').hide();
				$('input').removeClass('is-invalid');
				ToastLoader.fire();
			},
			success:function(data){
				if (data.status == 'Success') {
					Toast.fire({
						icon: 'success',
						title: data.message
					});
				} else {
					Toast.fire({
						icon: 'error',
						title: data.message
					});
				}
				reloadAvatar();
				$('#modal-update-pp').modal('hide');
				document.getElementById('img-update-form').reset();
			},
			error: function(request, status, error){
				Swal.close();
				$('#modal-update-pp').modal('show');
				json = $.parseJSON(request.responseText);
				$.each(json.errors, function(key, value) {
					$('#' + key).addClass('is-invalid').focus();
					$('#' + key + '_error').empty().append(value).show();
				});
			}

		});
	});
}

function setSubmitEdit(val) {
	$('#' + val + '-edit-form').off('submit').on('submit', function(e) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		e.preventDefault();

		var url =  $(this).attr('action');

		$.ajax({
			type: "patch",
			url: url,
			data: $(this).serialize(),
			beforeSend: function()
			{
				$('input').removeClass('is-invalid');
				ToastLoader.fire();
			},
			success: function (data)
			{
				if (data.status == 'Success') {
					Toast.fire({
						icon: 'success',
						title: data.message
					});
				} else {
					Toast.fire({
						icon: 'error',
						title: data.message
					});
				}
				reloadEdit(val);
			},
			error: function (request, status, error) {
				Swal.close();
				json = $.parseJSON(request.responseText);
				$.each(json.errors, function(key, value) {
					$('#' + key).addClass('is-invalid').focus();
					$('#' + key + '_error').empty().append(value).show();
				});
			}
		})
	});
}

function setBtnEdit() {
	$('.btn-edit').off('click').on('click', function() {
		if (g_key != '') reloadEdit(g_key);

		g_key = this.getAttribute("value");
		var val = this.getAttribute("value");

		var url = '/admin/account/' + val + '/show-form';

		var data = {
			key: val
		}

		$.ajax({
			type: "get",
			url: url,
			dataType: 'json',
			data: data,
			cache: false,
			beforeSend: function()
			{
				$('#link-' + val + '-edit').css('display', 'none')
				$('#' + val + '-preloader').css('display', 'initial');
			},
			success: function (data)
			{
				$('#' + val + '-form-wrapper').empty().html(data.html).hide().fadeIn('slow', function() {
					setSubmitEdit(val);
				});
				$('#' + val + '-preloader').css('visibility', 'hidden');
			},
			error: function (request, status, error) {

			}
		});
	});
}

function resizeAvatar() {
	window_h = $(window).height();
	pp = document.getElementById('profile-picture');

	// console.log((window_h) + ' < ' + pp.naturalHeight);

	if ((window_h*0.6) < pp.naturalHeight) {
		pp.height = window_h*0.6;
	}
}

$(document).ready(function() {
	setSubmitFile()
	setBtnEdit();
	resizeAvatar();
});