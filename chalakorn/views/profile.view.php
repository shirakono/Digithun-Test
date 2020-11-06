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
        <title>Profile - Chalakorn Website</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Chalakorn</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
					<?php  if(isset($_SESSION['USERDATA']) && !empty($_SESSION['USERDATA'])) { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="/profile">Home <span class="sr-only">(current)</span></a>
                    </li>
					<?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
					<?php } ?>
                </ul>
				<?php  if(isset($_SESSION['USERDATA']) && !empty($_SESSION['USERDATA'])) { ?>
				<ul class="navbar-nav my-2 my-lg-0">
					<li class="nav-item">
                        <a class="nav-link" href="#" onclick="Logout()">Logout</a>
                    </li>
				</ul>
				<?php } ?>
            </div>
        </nav>
		
		<div class="container mt-4">
			<?php
			if(isset($_SESSION['USERDATA']) && !empty($_SESSION['USERDATA'])) 
			{
				if($user_info['profile_name'] == NULL)
				{
					$placeholder = "Please enter you name";
					$name = "";
				}
				else
				{
					$placeholder = "Profile Name";
					$name = $user_info['profile_name'];
				}
			?>
				<div class="row">
					<div class="col-3">
					</div>
					<div class="col-6">
						<div class="card">
							<div class="card-header bg-dark text-white">
								Profile Member
							</div>
							<div class="card-body">
								<form id="profile-form" autocomplete="off">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Profile Name</span>
										</div>
										<input type="text" name="profile" class="form-control" placeholder="<?php echo $placeholder; ?>" value="<?php echo $name; ?>">
									</div>
									<button type="submit" class="btn btn-block btn-success">Update Profile</button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-3">
					</div>
				</div>
			<?php
			}
			else
			{	
				SweetAlertTime("error", "Chalakorn", "Please login before use!", 1000, "/login");
			}
			?>
		</div>
        <!-- jQuery and Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="/resources/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		
        <!-- Optional JavaScript; choose one of the two! -->
        <script src="/resources/js/chalakorn.utils.js"></script>
        <script src="/resources/js/chalakorn.profile.js"></script>
    </body>
</html>
