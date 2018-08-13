<!-- main section -->
<section id="main" class="valign-wrapper">
	<!-- container -->
	<div class="container">
		<div class="row">

			<div class="col l3 m2"></div>

			<form action="" method="post" class="card col l6 m8">
				<input type="hidden" name="action" value="insert">

				<h3 class="center">Sign in</h3>

				<div class="input-field padding">
					<input type="text" id="email" name="email" pattern="[a-zA-Z0-9]+@[a-zA-Z0-9.]+" class="validate" autocomplete="off" required>
					<label for="email">email</label>
					<span class="helper-text" data-error="incorrect email" data-success="right"></span>
				</div>

				<div class="input-field padding">
					<input type="text" id="name" name="name" pattern="[a-zA-Z0-9]+" class="validate" autocomplete="off" required>
					<label for="name">name</label>
					<span class="helper-text" data-error="a-z A-Z 0-9" data-success="right"></span>
				</div>

				<div class="input-field padding">
					<input type="password" id="password" name="password" required>
					<label for="password">password</label>
				</div>

				<div class="input-field padding">
					<input type="password" id="confirm" name="confirm" required>
					<label for="confirm">password confirm</label>
				</div>

				<div class="input-field padding">
					<div class="row">
						<div class="col m12">
							<button class="btn col m12">Sign In</button>
						</div>
					</div>
				</div>

			</form>

			<div class="col l3 m2"></div>
		</div>

	</div>
	<!-- container -->
</section>
<!-- main section -->