<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
	    // for debugging
	    // print_r($_POST); 
		// exit();
		
		// keep track validation errors
		$termError = null;
		$definitionError = null;
		$exampleError = null;
		
		// keep track post values
		$term        = $_POST['term'];
		$definition  = $_POST['definition'];
		$example     = $_POST['example'];
		$discussion  = $_POST['discussion'];
		$source_link = $_POST['source_link'];
		$update_info = $_POST['update_info'];
		$school      = $_POST['school'];
		$course      = $_POST['course'];
		$school      = "SVSU";
		$course      = "cs116";
		
		// validate input
		$valid = true;
		if (empty($term)) {
			$termError = 'Please enter Term';
			$valid = false;
		}
		if (empty($definition)) {
			$definitionError = 'Please enter Definition';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO cards (term,definition,example,discussion,
			    source_link,update_info,school,course) 
				values(?, ?, ?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($term,$definition,$example,$discussion,
			    $source_link,$update_info,$school,$course));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a New Card</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($termError)?'error':'';?>">
					    <label class="control-label">Term</label>
					    <div class="controls">
					      	<input name="term" type="text"  placeholder="Term" value="<?php echo !empty($term)?$term:'';?>">
					      	<?php if (!empty($termError)): ?>
					      		<span class="help-inline"><?php echo $termError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($definitionError)?'error':'';?>">
					    <label class="control-label">Definition</label>
					    <div class="controls">
					      	<input name="definition" type="text"  placeholder="Definition" value="<?php echo !empty($definition)?$definition:'';?>">
					      	<?php if (!empty($definitionError)): ?>
					      		<span class="help-inline"><?php echo $definitionError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="control-group ">
					    <label class="control-label">Example</label>
					    <div class="controls">
						<textarea style="font-family:Courier;width:100%" name="example" rows=10 cols=400 
						    placeholder="Example code" wrap="hard"></textarea>
					    </div>
					  </div>
					  
					  <div class="control-group ">
					    <label class="control-label">Discussion</label>
					    <div class="controls">
						<textarea style="width:100%" name="discussion" rows=5 cols=400 
						    placeholder="Why needed? How might this be confused?" 
							wrap="hard"></textarea>
					    </div>
					  </div>
					  
					  <div class="control-group ">
					    <label class="control-label">Source Link</label>
					    <div class="controls">
						<input style="width:100%" name="source_link" placeholder="URL where this info was found" value="<?php echo !empty($source_link)?$source_link:'';?>">
					    </div>
					  </div>
					  
					  <div class="control-group ">
					    <label class="control-label">Update Info</label>
					    <div class="controls">
						<input style="width:100%" name="update_info" placeholder="Who created/updated this info" value="<?php echo !empty($update_info)?$update_info:'';?>">
					    </div>
					  </div>
					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>