
<html lang="en">

<!-- begin::Head -->
<head>
	<base href="../../../">
	<meta charset="utf-8" />
	<title>Wedding Cluster | Vendor Login</title>
	<meta name="description" content="Login page example">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

	<link href="{{asset('assets/css/pages/login/login-3.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

	<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico')}}" />
</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-heasudo apt install php7.4-common php7.4-mysql php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd php7.4-imagick php7.4-cli php7.4-dev php7.4-imap php7.4-mbstring php7.4-opcache php7.4-soap php7.4-zip php7.4-intl -y
der--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

	<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
		<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ asset('assets/media/bg/bg-3.jpg')}});">
				<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
					<div class="kt-login__container">
						<div class="kt-login__logo">
							<a href="#">
								<img src="{{ asset('assets/media/logos/logo-5.png')}}">
							</a>
						</div>
						<div class="kt-login__signin">
							<div class="kt-login__head">
								<h3 class="kt-login__title">Sign In To Vendor</h3>
							</div>

								{{-- <div class="login_failed alert alert-danger" role="alert" style="display: none;">
									Wrong Username or Password
								</div>
								--}}
								<div class="login_failed alert alert-danger alert-dismissible" style="display: none;">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Wrong Username or Password!</strong>
								</div>

								<form class="kt-form" action="{{ url('vendor') }}" method="post" id="lgn_form">
									@csrf
									<div class="form-group row">
										<div class="col-lg-12">
											<input class="form-control" type="email" placeholder="Email" name="email" autocomplete="off" id="email">
											@error('email')
												<span style="color: red;">{{ $message }}</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-12">
										<input class="form-control" type="password" placeholder="Password" name="password" id="password">
										@error('password')
											<span style="color: red;">{{ $message }}</span>
										@enderror
										</div>
									</div>
									<div class="row kt-login__extra">
										<div class="col">
											<label class="kt-checkbox">
												<input type="checkbox" name="remember"> Remember me
												<span></span>
											</label>
										</div>
									</div>
									<div class="kt-login__actions">
										<button  class="btn btn-brand btn-elevate kt-login__btn-primary" type="submit">Sign In</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#22b9ff",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>


		<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>
		{{-- <script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}" type="text/javascript"></script> --}}
		<script>
			$(document).ready(function () {

				$("#lgn_form").validate({
					rules:
					{
						email:
						{
							required: true
						},
						password:
						{
							required: true
						}
					},
					messages:
					{
						email:
						{
							required: "Enter Email"
						},
						password:
						{
							required: "Enter password"
						}
					},
					highlight: function (element)
					{
						$(element).closest('.form-control').addClass('has-error');
					},
					unhighlight: function (element)
					{
						$(element).closest('.form-control').removeClass('has-error');
					},
					errorElement: 'div',
					errorClass: 'invalid-feedback',
					errorPlacement: function (error, element)
					{
						if (element.parent('.input-group').length) {
							error.insertAfter(element.parent());
						} else {
							error.insertAfter(element);
						}
					}
				});

			});
		</script>
	</body>
</html>