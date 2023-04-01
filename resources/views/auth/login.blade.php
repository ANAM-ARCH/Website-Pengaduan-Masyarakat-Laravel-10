<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Lapor</title>
    <link href="https://bkad.luwutimurkab.go.id/wp-content/uploads/2022/05/logo-lapor.png" rel="icon">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/my-login.css">
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:300:400);

.waves {
  position:absolute;
  width: 100%;
  height:15vh;
  bottom:1%;
  margin-bottom:-7px; /*Fix for safari gap*/
  min-height:100px;
  max-height:150px;
}

/* Animation */

.parallax > use {
  animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
}
.parallax > use:nth-child(1) {
  animation-delay: -2s;
  animation-duration: 7s;
}
.parallax > use:nth-child(2) {
  animation-delay: -3s;
  animation-duration: 10s;
}
.parallax > use:nth-child(3) {
  animation-delay: -4s;
  animation-duration: 13s;
}
.parallax > use:nth-child(4) {
  animation-delay: -5s;
  animation-duration: 20s;
}
@keyframes move-forever {
  0% {
   transform: translate3d(-90px,0,0);
  }
  100% {
    transform: translate3d(85px,0,0);
  }
}
/*Shrinking for mobile*/
@media (max-width: 768px) {
  .waves {
    height:40px;
    min-height:40px;
  }
  .content {
    height:30vh;
  }
  h1 {
    font-size:24px;
  }
}
.mt-xl {
  margin-top: 13% !important;
}
    </style>
</head>

<body class="my-login-page">
    <div>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(12,118,170,255)" />
        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(129,212,226,255)" />
        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(33,150,193,255)" />
        <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(27,143,190,255)" />
        </g>
        </svg>
    </div>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper mt-xl">
					<div class="card fat">
						<div class="card-body">
                            @if(session()->has('message'))
                            <div class="alert alert-danger">
                            {{ session()->get('message') }}
                            </div>
                            @else
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger">
                                <b>Opps!</b> {{session('error')}}
                            </div>
                            @endif
							<h4 class="card-title">Login</h4>
							<form method="POST" action="{{ route('login') }}" class="my-login-validation" novalidate="">
                                @csrf
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="name" class="form-control" name="username" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="{{ route('password.request') }}" class="float-right">
											Lupa Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>


								<div class="form-group m-0">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Login
                                        </button>
								</div>
								<div class="mt-4 text-center">
									Tidak Punya Akun? <a href="{{ route('register') }}">Buat</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="assets/js/my-login.js"></script>
</body>
</html>
