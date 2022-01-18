// VALIDATION
$(document).ready(function(){
	$('input[name="username"]').on('focusout', function(e) {
		e.preventDefault();
		var value = $(this).val();
		var rv_username = /^(?=.{1,24}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/;
		$(this).parents('.form-group').removeClass('error success');

		if (value != '' && rv_username.test(value)) {
			setSuccessFor(this);
		}
		else {
			setErrorFor(this, 'Некорректное имя пользователя');
		}
	})

	$('input[name="email"]').on('focusout', function(e) {
		e.preventDefault();
		var value = $(this).val();
		var rv_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		$(this).parents('.form-group').removeClass('error success');

		if (value != '' && rv_email.test(value)) {
			setSuccessFor(this);
		}
		else{
			setErrorFor(this, 'Некорректный E-mail');
		}
	})

	$('input[name="password"]').on('focusout', function(e) {
		e.preventDefault();
		var value = $(this).val();
		$(this).parents('.form-group').removeClass('error success');

		if (value != '') {
			setSuccessFor(this);
		}
		else {
			setErrorFor(this, 'Введите свой пароль для аккаунта');
		}
	})

	$('input[name="password_repeat"]').on('focusout', function(e) {
		e.preventDefault();
		var password = $('input[name="password"]').val();
		var value = $(this).val();
		$(this).parents('.form-group').removeClass('error success');

		if (value == '') {
			setErrorFor(this, 'Подтвердите свой пароль');
		}
		else if (password != value) {
			setErrorFor(this, 'Пароль не соотвествует');
		}
		else {
			setSuccessFor(this);
		}
	})

	function setErrorFor(input, message){
		$(input).parents('.form-group').addClass('error');
		$(input).parents('.form-group').find('small').text(message);
	}
	function setSuccessFor(input){
		$(input).parents('.form-group').addClass('success');
	}
});