<?php

session_start();
$hostname = "localhost";
$username = "student";
$password = "learn";
$dbname = "gpcorser";
$usertable = "questions";

# ========== FUNCTIONS ========================================================
# ---------- checkConnect -----------------------------------------------------

function checkConnect($mysqli) {
    if ($mysqli->connect_errno) {
        die('Unable to connect to database [' . $mysqli->connect_error . ']');
        exit();
    }
}

# ---------- showQuestions ---------------------------------------------------------
// this function gets records from a "mysql table" and builds an "html table"

function showQuestions($mysqli) {
    global $usertable;
    echo '<div class="col-md-12">
			<form action="Questions.php" method="POST">
			<table class="table table-condensed" 
			style="border: 1px solid #dddddd; border-radius: 5px; 
			box-shadow: 2px 2px 10px;">
			<tr><td colspan="11" style="text-align: center; border-radius: 5px; 
			color: white; background-color:#333333;">
			<h2 style="color: white;">Questions</h2>
			</td></tr><tr style="font-weight:800; font-size:20px;">
			<td>ID</td><td>Question</td></tr>';
			
    // get count of records in mysql table
    $countresult = $mysqli->query("SELECT COUNT(*) FROM $usertable");
    $countfetch = $countresult->fetch_row();
    $countvalue = $countfetch[0];
    $countresult->close();
	
    // if records > 0 in mysql table, then populate html table, 
    // else display "no records" message
    if ($countvalue > 0) {
        populateQuestions($mysqli); // populate html table, from mysql table
    } else {
        echo '<br><p>No records in database table</p><br>';
    }

    // display html buttons 
    echo '</table> ';
        echo '<input type="hidden" id="hid" name="hid" value="">
            <input type="hidden" id="uid" name="uid" value="">
            <input type="submit" name="InsertAQuestion" value="Add an Entry" 
            class="btn btn-primary"">
            </form></div>';

        echo "<script>
			function setHid(num)
			{
				document.getElementById('hid').value = num;
		    }
		    function setUid(num)
			{
				document.getElementById('uid').value = num;
		    }
		 </script>";
}

# ---------- populateQuestions ----------------------------------------------------
// populate html table, from data in mysql table

function populateQuestions($mysqli) {
    global $usertable;
    $Quizzes = $_SESSION['QuizID'];

    if ($result = $mysqli->query(
	        "SELECT id, question FROM questions WHERE quizzes_id = $Quizzes")) {
        while ($row = $result->fetch_row()) {
            echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>';
            echo '<input type="submit" name="SelectAQuestion" 
			    class="btn btn-primary" value="Select" 
				onclick="setUid(' . $row[0] . ');" />';
            if ($_SESSION['PersonsRole'] == "Teacher" || $_SESSION['PersonsRole'] == "Peer Reviewer" ||
                    $_SESSION['SecRole'] == "Teacher" || $_SESSION['SecRole'] == "Peer Reviewer") {
                echo '</td><td><input name="DeleteAQuestion" type="submit" 
				class="btn btn-danger" value="Delete" onclick="setHid(' . $row[0] . ')" />';
                echo '<input style="margin-left: 10px;" type="submit"  name="UpdateAQuestion" class="btn btn-primary" value="Update"  onclick="setUid(' . $row[0] . ');" />';
            }
        }
    }
    $result->close();
}

function deleteQuestionRecord($mysqli) {
    $index = $_SESSION['QuestionID'];  // "hid" is id of db record to be deleted
    global $usertable;
    $stmt = $mysqli->stmt_init();
    if ($stmt = $mysqli->prepare("DELETE FROM $usertable WHERE id='$index'")) {
        $stmt->bind_param('i', $index);
        $stmt->execute();
        $stmt->close();
    }
}

function ShowQuestionsUpdateForm($mysqli) {
    $index = $_POST['uid'];  // "uid" is id of db record to be updated 
    global $usertable;
    if ($result = $mysqli->query("SELECT id, title, subject, description, resources, search_field FROM $usertable WHERE id = $index")) {
        while ($row = $result->fetch_row()) {
            echo '<div class="col-md-4">
        <form name="basic" method="POST" action="Questions.php" 
        onSubmit="return validate();"> 
        <table class="table table-condensed" style="border: 1px solid #dddddd; 
        border-radius: 5px; box-shadow: 2px 2px 10px;">
        <tr><td colspan="2" style="text-align: center; border-radius: 5px; 
        color: white; background-color:#333333;"> <h2>Insert New Question</h2></td></tr>';

            echo
            '<tr><td>Title: </td><td><input type="edit" name="title" value="' . $row[1] . '" size="30"></td></tr>
	<tr><td>Subject: </td><td><input type="edit" name="subject" value="' . $row[2] . '" size="30"></td></tr>
	<tr><td>Description: </td><td><input type="edit" name="description" value="' . $row[3] . '" size="20"></td></tr>
	<tr><td>Resources: </td><td><input type="edit" name="resources" value="' . $row[4] . '" size="20"></td></tr>
	<tr><td>Search Keywords: </td><td><input type="edit" name="search_field" value="' . $row[5] . '" size="30"></td></tr>';
            echo '
        </td></tr> 
        <tr><td><input type="submit" name="QuestionExecuteUpdate" class="btn btn-primary" value="Update Entry"></td> 
	</table> <input type="hidden" name="uid" value="' . $row[0] . '"> </form> 
        <form action="Questions.php"> <input type="submit" name="updateQuestion" value="Back to Questions" class="btn btn-primary""> </form> <br> </div>';
        }
        $result->close();
    }
}

function showQuestionInsertForm() {
    echo '<div class="col-md-4">
        <form name="basic" method="POST" action="Questions.php" 
        onSubmit="return validate();"> 
        <table class="table table-condensed" style="border: 1px solid #dddddd; 
        border-radius: 5px; box-shadow: 2px 2px 10px;">
        <tr><td colspan="2" style="text-align: center; border-radius: 5px; 
        color: white; background-color:#333333;"> <h2>Insert New Question</h2></td></tr>';

    echo '<tr><td>Title: </td><td><input type="edit" name="title" value="" 
		size="30"></td></tr>
		<tr><td>Subject: </td><td><input type="edit" name="subject" 
		value="" size="30"></td></tr>
		<tr><td>Description: </td><td><input type="edit" name="description" value="" 
		size="20"></td></tr>
		<tr><td>Resources: </td><td><input type="edit" name="resources" value="" 
		size="20"></td></tr>
		<tr><td>Search Keywords: </td><td><input type="edit" 
                                name="search_field" value="" size="30"></td></tr>';

    echo '<tr><td><input type="submit" name="QuestionExecuteInsert" 
        class="btn btn-success" value="Add Entry"></td>
        <td style="text-align: right;"> </table><a href="Questions.php" 
        class="btn btn-primary">Display Questions</a></form></div>';
}

function insertQuestion($mysqli) {
    global $usertable;

    $stmt = $mysqli->stmt_init();
    if ($stmt = $mysqli->prepare("INSERT INTO `CIS355jldevin1`.`Questions` (`id`, `title`, `subject`, "
            . "`description`, `resources`, `persons_id`, `date_created`, `search_field`) VALUES "
            . "(NULL, '" . $_POST['title'] . "', '" . $_POST['subject'] . "', '" . $_POST['description'] . "', '" .
            $_POST['resources'] . "', '" . $_SESSION['PersonID'] . "', '" . date('Y-m-d H:i:s') . "', '" . $_POST['search_field'] . "');")) {

        $stmt->execute();
        $stmt->close();
    }
}

function updateQuestion($mysqli) {
    global $usertable;

    $stmt = $mysqli->stmt_init();
    if ($stmt = $mysqli->prepare("UPDATE  $usertable SET  title =  '" . $_POST['title'] .
            "', subject =  '" . $_POST['subject'] .
            "', description =  '" . $_POST['description'] .
            "', resources =  '" . $_POST['resources'] .
            "', search_field =  '" . $_POST['search_field'] .
            "' WHERE  $usertable .id = " . $_SESSION['QuestionID'])) {
        $stmt->execute();
        $stmt->close();
    }
}
