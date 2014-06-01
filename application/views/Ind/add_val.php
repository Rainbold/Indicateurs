			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<br/>
						<br/>
						<?php $action = (isset($ind_edit)) ? site_url(array('ind', 'edit_val', $ind_edit->id)):site_url(array('ind', 'add_val', $this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5))); ?>
						<form action="<?php echo $action; ?>" method="post" role="form">
							<div class="form-group">
								<label>Valeur de l'indicateur</label>
								<input class="form-control" type="text" name="valeur" value="<?php if(isset($ind_edit)) echo $ind_edit->valeur ?>"  />
							</div>
							<input type="hidden" name="id" value="<?php if(isset($ind_edit)) echo $ind_edit->id ?>" />
							<input type="hidden" name="parent" value="<?php if(isset($ind_edit)) echo $ind_edit->parent; else echo $this->uri->segment(3) ?>" />
							<input type="hidden" name="mois" value="<?php if(isset($ind_edit)) echo $ind_edit->mois; else echo $this->uri->segment(5) ?>" />
							<input type="hidden" name="annee" value="<?php if(isset($ind_edit)) echo $ind_edit->annee; else echo $this->uri->segment(4) ?>" />
							<button type="submit" class="btn btn-success"><?php if(!isset($ind_edit)) echo 'Ajouter'; else echo 'Editer'; ?></button>
						</form>
						<br/>
						<br/>
					</div>
				</div>
			</div>
