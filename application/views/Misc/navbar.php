		<nav>
			<div class="container-fluid">
				<div class="row-fluid pull-right">
					<div class="col-md-12">
						<a class="btn btn-danger" href="<?php echo site_url(array('poles', 'add', $this->uri->segment(3))); ?>">+ Pôle</a>
						<a class="btn btn-danger" href="<?php echo site_url(array('ind', 'add', $this->uri->segment(3))); ?>">+ Indicateur</a>
						<button class="btn btn-danger">+ Courbe</button>
					</div>
				</div>
			</div>
		</nav>

		<br/>
		<br/>
		<br/>

		<nav>
			<div class="container-fluid">
				<div class="row-fluid pull-left">
					<div class="col-md-12">
						<a href="<?php echo base_url(); ?>">Pôles</a>

						<?php foreach($navbar as $pole) { ?>
							<span class="glyphicon glyphicon-chevron-right"></span>
							<a href="<?php echo site_url(array('welcome', 'index', $pole['id'])); ?>"><?php echo_var($pole['nom']); ?></a>
						<?php } ?>
						
					</div>
				</div>
			</div>
		</nav>