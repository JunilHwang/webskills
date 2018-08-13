	<!-- main section -->
	<section id="main">
		<!-- container -->
		<div class="container">

			<!-- subtitle -->
			<div class="row">
				<h4>Project List</h4>
			</div>

			<!-- list -->
			<div class="row">
				<?php
					foreach ($list as $data):
				?>
				<div class="col m4">
					<div class="card">
						<div class="card-image blue-grey lighten-4">
							<?php
								if ($data->icon != 0) {
									$uri = URL."/{$data->uri}";
									echo "<img src=\"{$uri}\" alt=\"{$data->name}\">";
								}
							?>
							<span class="card-title">
								<a href="<?php echo URL."/project/view/{$data->idx}/{$data->version}/{$data->root}"?>"><?php echo $data->title?></a>
							</span>
						</div>
						<div class="card-content">
							<p><?php echo $data->description ?></p>
							<br>
							<p><?php echo $data->date?></p>
						</div>
					</div>
				</div>
				<?php endforeach ?>
			</div>
			<!-- list -->

		</div>
		<!-- container -->
	</section>
	<!-- main section -->