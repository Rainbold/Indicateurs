<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>AEI - Indicateurs</title>
		<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo css_url('design'); ?>">
	</head>

	<body>
		<header>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
				    <div class="navbar-header">
			    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        		<span class="sr-only">Toggle navigation</span>
			        		<span class="icon-bar"></span>
			        		<span class="icon-bar"></span>
			        		<span class="icon-bar"></span>
			      		</button>
			      		<a class="navbar-brand" href="<?php echo site_url(); ?>">Indicateurs</a>
			    	</div>

				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      		<ul class="nav navbar-nav navbar-right aa-menu">
			        		<li><a href="">Pôles</a></li>
			        		<?php if( $this->session->userdata('logged_in') ) { ?>
			        		<li>
			        			<form class="form-inline text-center" action="<?php echo site_url(); ?>" method="post">
	                        		<button class="btn btn-warning" type="submit" name="submitForm" value="formSignOut">Déconnexion</button>
			        			</form>
			        		</li>
							<?php } ?>
			      		</ul>
			    	</div>
				</div>
			</nav>
		</header>