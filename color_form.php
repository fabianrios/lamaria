<?php
	
	if (isset($_POST[color]) && $_POST[color]!="") {
		$color = $_POST[color];
		$var_str = var_export($color, true);
		$var = "<?php\n\necho $var_str;\n\n?>";
		file_put_contents('variables.php', $var);
	}
?>


<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
 <title>Pick-a-color</title>
 
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/app.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/overrides.css" />
  <link rel="stylesheet" href="css/farbtastic.css" type="text/css" />
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic|Sanchez:400italic,400&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

 <script src="js/vendor/custom.modernizr.js"></script>
 <script type="text/javascript" src="js/vendor/jquery.min.js"></script>
 <script type="text/javascript" src="js/vendor/farbtastic.js"></script>
 
 <script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#demo').hide();
    $('#picker').farbtastic('#color');
    
   function callback(color) { alert('color'); }
    
  });
 </script>
 
</head>

<body>
	<br />
<div class="row">
	<div class="large-6 large-centered columns">
		<form method="post" action="color_form.php">
		  <div class="form-item">
		  	<label for="color">Color:</label>
		  	<input type="text" id="color" name="color" value="<?php include 'variables.php'; ?>" /></div>
		  	<div class="row">
		  		<div class="large-6 columns large-centered text-center">
		  			<div id="picker"></div>
		  		</div>
		  	</div>
		  	<input type="submit" class="button radius right" id="color" value="Enviar" />
		</form>
		</div>
</div>
</body>
</html>
