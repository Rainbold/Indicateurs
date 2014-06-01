		<section>
			<div class="container-fluid">
				<div class="row-fluid cont">
					<h3><?php if($pole) echo $pole->nom.' 
					<a class="pull-right" href="'.site_url(array('poles', 'edit', $pole->id)).'"><i class="glyphicon glyphicon-pencil"></i></a> 
					<a class="pull-right" href="'.site_url(array('poles', 'del', $pole->id)).'"><i class="glyphicon glyphicon-remove"></i></a>'; else echo 'Accueil'; ?></h3>

					<div class="container-fluid">
						<div class="row-fluid">
							<?php if($sous_poles) { ?>
								<h5>Pôles</h5>

								<ul>
									<?php foreach($sous_poles as $pole) { ?>
									<li><a href="<?php echo site_url(array('welcome', 'index', $pole->id)); ?>"><?php echo_var($pole->nom); ?></a></li>
									<?php } ?>
								</ul>
							<?php } ?>
						</div>
					</div>

					<?php if(isset($ind_noms) && $ind_noms != NULL) { ?>
					<div class="container-fluid">
						<div class="row-fluid">
								<h5>Indicateurs</h5>

								<ul>
									<?php foreach($ind_noms as $ind) { ?>
									<li><a href="<?php echo site_url(array('ind', 'del', $ind->id)); ?>"><i class="glyphicon glyphicon-remove"></i></a> 
										<a href="<?php echo site_url(array('ind', 'edit', $ind->id)); ?>"><i class="glyphicon glyphicon-pencil"></i></a> 
										<a href="<?php echo site_url(array('ind', 'display', $ind->id)); ?>"><?php echo_var($ind->nom) ?></a></li>
									<?php } ?>
								</ul>
						</div>
					</div>
					<?php } ?>
				</div>
				<br/>
				<br/>
				<br/>
				<?php if(isset($orphelins) && $orphelins != NULL) { ?>
				<div class="row-fluid cont">
					<h3>Pôles orphelins</h3>

					<div class="container-fluid">
						<div class="row-fluid">
								<h5>Pôles</h5>

								<ul>
									<?php foreach($orphelins as $pole) { ?>
									<li><a href="<?php echo site_url(array('welcome', 'index', $pole->id)); ?>"><?php echo_var($pole->nom) ?></a></li>
									<?php } ?>
								</ul>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</section>