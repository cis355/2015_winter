<?php

session_start();
include "CRUDQuestions.php";
include "Functions.php";

$hostname = "localhost";
$username = "student";
$password = "learn";
$dbname = "gpcorser";
$usertable = "questions";
$mysqli = new mysqli($hostname, $username, $password, $dbname);

checkConnect($mysqli); // program dies if no connection
// ---------- if successful connection...
if ($mysqli) {
    // ---------- c. create table, if necessary -------------------------------
    //createTable($mysqli); 
    // ---------- d. initialize userSelection and $_POST variables ------------
    $userSelection = 0;
    $firstCall = 1; // first time program is called
    $InsertAQuestion = 2; // after user clicked InsertAQuestion button on list 
    $UpdateAQuestion = 3; // after user clicked UpdateAQuestion button on list 
    $DeleteAQuestion = 4; // after user clicked DeleteAQuestion button on list 
    $SelectAQuestion = 5;
    $QuestionExecuteInsert = 6; // after user clicked insertSubmit button on form
    $QuestionExecuteUpdate = 7; // after user clicked updateSubmit button on form

    $_SESSION['QuestionID'] = $_POST['uid'];
    $userlocation = $_SESSION['location'];

    $userSelection = $firstCall; // assumes first call unless button was clicked
    if (isset($_POST['InsertAQuestion']))
        $userSelection = $InsertAQuestion;
    if (isset($_POST['UpdateAQuestion']))
        $userSelection = $UpdateAQuestion;
    if (isset($_POST['DeleteAQuestion']))
        $userSelection = $DeleteAQuestion;
    if (isset($_POST['SelectAQuestion']))
        $userSelection = $SelectAQuestion;
    if (isset($_POST['QuestionExecuteInsert']))
        $userSelection = $QuestionExecuteInsert;
    if (isset($_POST['QuestionExecuteUpdate']))
        $userSelection = $QuestionExecuteUpdate;

    switch ($userSelection):
        case $firstCall:
            displayHTMLHead();
            showQuestions($mysqli);
            break;
        case $InsertAQuestion:
            displayHTMLHead();
            showQuestionInsertForm($mysqli);
            break;
        case $UpdateAQuestion :
            $_SESSION['QuestionID'] = $_POST['uid'];
            echo $_SESSION['QuestionID'];
            displayHTMLHead();
            ShowQuestionsUpdateForm($mysqli);
            break;
        case $DeleteAQuestion:
            $_SESSION['QuestionID'] = $_POST['hid'];
            echo $_SESSION['QuestionID'];
            displayHTMLHead();
            deleteQuestionRecord($mysqli);   // delete is immediate (no confirmation)
            header("Location: http://csis.svsu.edu/~gpcorser/mjwalker/Questions.php");
            break;
        case $SelectAQuestion:
            $_SESSION['QuestionID'] = $_POST['uid'];
            echo $_SESSION['QuestionID'] . "     QUIZZES!";
            header("Location: http://csis.svsu.edu/~gpcorser/mjwalker/Options.php");
            break;
        case $QuestionExecuteInsert:
            insertQuestion($mysqli);
            header("Location: http://csis.svsu.edu/~gpcorser/mjwalker/Questions.php");
            break;
        case $QuestionExecuteUpdate:
            updateQuestion($mysqli);
            header("Location: http://csis.svsu.edu/~gpcorser/mjwalker/Questions.php");
            break;
    endswitch;
} // ---------- end if ---------- end main processing ----------


