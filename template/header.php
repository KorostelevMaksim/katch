<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?get_head()?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<link href="<?=__BASEURL__?>bootstrap/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link href="<?=__BASEURL__?>bootstrap/css/style.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="<?=__BASEURL__?>bootstrap/js/script.js" type="text/javascript"></script>
</head>
<body>

<div class="container">    

<div id="header">
<br>
	<?global $user,$acl;?>
	<div id="menu" class="row">
		<div class="span10">
			<ul class="nav nav-pills">
				<?
				$menu = array('post'=>'Посты','place'=>'Места','admin'=>'Admin');
				foreach ($menu as $key => $value) {
					if ($acl->is_allow($key)) {
						$item = '<li ';
						$class=(getModule() == $key) ? 'active' : '' ;
						$item .= (isset($class)) ? 'class="'.$class.'" >': '>';
						$item .= '<a href='.__BASEURL__.$key.'/>'.$value.'</a></li>';
						echo $item;
					}
				}?>
			</ul>
		</div>
		<div class="span2">
			<?=($user->is_login()) ? "<a href=".__BASEURL__."login/out/>Log out</a>" : "<a href=".__BASEURL__."login/>Login</a>" ?>
		</div>
	</div>
</div>