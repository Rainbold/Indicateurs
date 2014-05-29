			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<br/>
						<br/>
						<?php $action = (isset($pole_edit)) ? site_url(array('poles', 'edit', $pole_edit->id)):site_url(array('poles', 'add')); ?>
						<form action="<?php echo $action; ?>" method="post" role="form">
							<div class="form-group">
								<label>Nom du pôle</label>
								<input class="form-control" type="text" name="nom" value="<?php if(isset($pole_edit)) echo $pole_edit->nom ?>"  />
							</div>
							<div class="form-group">
								<label>Pôle parent</label>
								<select name="parent" class="form-control">
									<option value="-1">/</option>
									<?php foreach($poles as $pole) { ?>
									<option <?php if(isset($pole_edit) && $pole_edit->parent == $pole['id']) echo 'selected'; elseif( isset($parent) && $parent == $pole['id'] ) echo 'selected'; ?> value="<?php echo $pole['id']; ?>"><?php echo $pole['nom']; ?></option>
									<?php } ?>
								</select>
							</div>
							<input type="hidden" name="id" value="<?php if(isset($pole_edit)) echo $pole_edit->id ?>" />
							<button type="submit" class="btn btn-success"><?php if(!isset($pole_edit)) echo 'Ajouter'; else echo 'Editer'; ?></button>
						</form>
						<br/>
						<br/>
					</div>
				</div>
			</div>
