<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/resources/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/resources/css/style.css?t=<?php echo time(); ?>" />
        <!-- Option CSS -->
        <link rel="stylesheet" href="/resources/css/all.min.css" />
        <link rel="stylesheet" href="/resources/css/sweetalert2.min.css" />
        <!-- Option JS -->
        <script src="/resources/js/sweetalert2.min.js"></script>
        <title>Register - Chalakorn Website</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Chalakorn</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
					<?php  if(isset($_SESSION['USERDATA']) && !empty($_SESSION['USERDATA'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">Home <span class="sr-only">(current)</span></a>
                    </li>
					<?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </nav>
		
		<div class="container mt-4">
			<?php
			if(isset($_SESSION['USERDATA']) && !empty($_SESSION['USERDATA'])) 
			{
				SweetAlertTime("error", "Chalakorn", "Already Login!", 1000, "/profile");
			}
			else
			{
			?>
			<div class="row">
				<div class="col-3">
				</div>
				<div class="col-6">
					<div class="card">
						<div class="card-header bg-dark text-white">
							Register Member
						</div>
						<div class="card-body">
							<form id="register-form" autocomplete="off">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">E-Mail</span>
									</div>
									<input type="text" name="username" class="form-control" placeholder="E-Mail">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">Password</span>
									</div>
									<input type="password" id="password" name="password" class="form-control" placeholder="Password">
								</div>
								<button type="submit" class="btn btn-block btn-danger">Register</button>
							</form>
							<div class="row">
								<div class="col-5">
									<hr/>
								</div>
								<div class="col-2 text-center">
									OR
								</div>
								<div class="col-5">
									<hr/>
								</div>
							</div>
							<a href="/login" class="btn btn-block btn-dark">Login</a>
						</div>
					</div>
				</div>
				<div class="col-3">
				</div>
			</div>
			<?php
			}
			?>
		</div>
        <!-- jQuery and Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="/resources/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		
        <!-- Optional JavaScript; choose one of the two! -->
        <script src="/resources/js/chalakorn.utils.js"></script>
        <script src="/resources/js/chalakorn.register.js"></script>
    </body>
</html>
