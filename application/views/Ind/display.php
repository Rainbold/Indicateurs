		<section>
			<div class="container-fluid">
				<div class="row-fluid cont">
					<h3><?php if(isset($ind) && $ind != NULL) echo $ind->nom; ?></h3>

					<div class="container-fluid">
						<div class="row-fluid text-center">
							<ul class="pagination">
							  	<li><a href="<?php echo site_url(array( 'ind', 'display', $this->uri->segment(3), ($annee-1) )); ?>">&laquo;</a></li>
							  	<li><a href="<?php echo site_url(array( 'ind', 'display', $this->uri->segment(3), $annee )); ?>"><?php echo $annee; ?></a></li>
							  	<li><a href="<?php echo site_url(array( 'ind', 'display', $this->uri->segment(3), ($annee+1) )); ?>">&raquo;</a></li>
							</ul>
						</div>
					</div>
					<div class="container-fluid">
						<div class="row-fluid">
						<?php
							$mois = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
							for($i=1; $i<=12; $i++)
							{
						?>
							<div class="col-md-3 text-center">
								<strong><?php echo $mois[$i-1]; ?> <?php echo (isset($list[$i])) ? '<a href="'.site_url(array('ind', 'edit_val', $list[$i][1])).'"><i class="glyphicon glyphicon-pencil"></i></a> 
					<a href="'.site_url(array('ind', 'del_val', $list[$i][1])).'"><i class="glyphicon glyphicon-remove"></i></a>':''; ?></strong>
								<?php echo (isset($list[$i])) ? '<h1>'.$list[$i][0].'</h1>':'<br/><a href="'.site_url(array('ind','add_val',$this->uri->segment(3),$annee,$i)).'">NC</a>'; ?>
							</div>

						<?php
							if($i % 4 == 0) {
						?>
						</div>
						<br/><br/>
						<br/><br/>
						<br/><br/>
						<div class="row-fluid">
						<?php
							}
						?>

						<?php
							}
						?>
						</div>
					</div>
				</div>
			</div>
		</section>