<!-- Navigation Bar -->
<nav class="navbar sticky-top bg-light border-bottom border-3">
	<!-- Site Page Name / Logo -->
	<div class="col-auto d-flex justify-content-start ms-3">
		<a class="teal_text navbar-brand fw-bolder fs-2" href="landing.php">
			<img class="" src="./assets/images/navbar logo 1 trimmed.png">
		</a>
	</div>
	<!-- End of Site Page Name / Logo -->

	<!-- Search Bar and Icon Button -->
	<div class="col-auto d-inline-flex justify-content-center ms-2 mb-2 me-2">
		<form class="d-flex" action="https://google.com/search" target="_blank" type="GET">
			<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success btn-sm " type="submit">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
				</svg>
			</button>
		</form>
	</div>
	<!-- End of Search Bar and Icon Button -->

	<div class="col-auto d-inline-flex justify-content-end ms-3">
		<a class="btn btn-outline-success me-2 rounded-pill" href="./new_post.php">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
				<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
			</svg>
			Post
		</a>
		<form method="post">
			<button type="submit" name="visit_self_profile" class="btn btn-outline-primary me-2 rounded-pill">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
					<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
					<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
				</svg>
				Profile
			</button>
			<?php
				if (isset($_POST['visit_self_profile'])){
					visit_self_profile();
					echo '<script type="text/javascript">window.location.href = "user_profile.php";</script>';
				}
			?>
		</form>
		<a class="btn btn-danger rounded-pill me-3" href="./partial/logout.php">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
				<path d="M7.5 1v7h1V1h-1z"/>
				<path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
			</svg>
		</a>
	</div>
</nav>
<!-- End of Navigation Bar -->
