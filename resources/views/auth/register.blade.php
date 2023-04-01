<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Aplikasi Pengaduan Masyarakat</title>
    <link href="https://bkad.luwutimurkab.go.id/wp-content/uploads/2022/05/logo-lapor.png" rel="icon">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/my-login.css">
</head>
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
</style>
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
                <div class="card-wrapper mt-5">
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form method="POST"
                            enctype="multipart/form-data" action="{{ route('register') }}"
                            class="my-login-validation" novalidate="">
                            @csrf

								<input value="0" id="id" type="text" name="id_petugas" hidden>

								<div class="form-group">
									<label for="nik">NIK</label>
									<input id="nik" type="number" value="{{ old('nik') }}"  class="form-control @error('nik') is-invalid @enderror" name="nik" placeholder="berjumlah 16 angka" required autofocus>
									@error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
								</div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
									<input id="nama" type="text" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" name="nama" required autofocus>
									@error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
								</div>

								<div class="form-group">
                                    <label for="name">Username</label>
									<input id="name" type="name" value="{{ old('username') }}"  class="form-control @error('username') is-invalid @enderror" name="username" required>
									@error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
								</div>

								<div class="form-group">
                                    <label for="password">Password</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required data-eye>
									@error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
								</div>

                                <div class="form-group">
                                    <label for="telp">Nomor Telp.</label>
									<input id="telp" type="number" value="{{ old('telp') }}"  class="form-control @error('title') is-invalid @enderror" name="telp" required autofocus>
									@error('telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
										<label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
										<div class="invalid-feedback">
											You must agree with our Terms and Conditions
										</div>
									</div>
								</div>

								<div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Register
									</button>
								</div>
								<div class="mt-4 text-center">
                                    Sudah Punya Akun? <a href="/lapor">Login</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="assets/js/my-login.js"></script>
</body>
</html>
