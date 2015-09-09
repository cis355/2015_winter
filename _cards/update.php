<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
	
		// keep track validation errors
		$termError = null;
		$definitionError = null;
		
		// keep track post values
		$term        = $_POST['term'];
		$definition  = $_POST['definition'];
		$example     = $_POST['example'];
		$discussion  = $_POST['discussion'];
		$source_link = $_POST['source_link'];
		$update_info = $_POST['update_info'];
		$school      = $_POST['school'];
		$course      = $_POST['course'];
		$school      = "temp";
		$course      = "temp";
		
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
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE cards  set term = ?, definition = ?, example = ?, 
			    discussion = ?, source_link = ?, update_info = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($term,$definition,$example,$discussion,
			    $source_link,$update_info,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM cards where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$term = $data['term'];
		$definition = $data['definition'];
		$example = $data['example'];
		$discussion = $data['discussion'];
		$source_link = $data['source_link'];
		$update_info = $data['update_info'];
		Database::disconnect();
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
		    			<h3>Update a Card</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
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
					  
					  <div class="control-group">
					    <label class="control-label">Example</label>
					    <div class="controls">
						<textarea style="font-family:Courier;width:100%" name="example" rows=10 placeholder="Example code" wrap="hard"><?php echo $data['example'];?></textarea>
					    </div>
					  </div>
					  
					  <div class="control-group ">
					    <label class="control-label">Discussion</label>
					    <div class="controls">
						<textarea style="width:100%" name="discussion" rows=5 placeholder="Why needed? How might this be confused?" wrap="hard"><?php echo $data['discussion'];?></textarea>
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
						<input style="width:100%" name="update_info" placeholder="Who created/updated this info?" value="<?php echo !empty($update_info)?$update_info:'';?>">
					    </div>
					  </div>
					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>