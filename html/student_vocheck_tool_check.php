<?php
include('check_studentlogin.php');
include('static/connect-database.php');

// Update-button pressed -> check login data
if (!empty($_POST["vocheck_tool_submit"])) {
    $_input = mysqli_real_escape_string($conn, $_POST["vocheck_tool_input"]);
    $_ids = mysqli_real_escape_string($conn, $_POST["voc_id"]);

    $_vid = explode("-", $_ids)[0];
    $_lid = explode("-", $_ids)[1];

    $_sql = "SELECT meaning_second_language AS msl FROM vocabulary WHERE id = {$_vid}";

    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($_res) == 1) {
        $row = mysqli_fetch_assoc($_res);
        if ($row["msl"] == $_input) {
            // Update statistics to 2 - correct
            $_sql = "UPDATE statistics SET status=2 WHERE student={$_SESSION["user"]["id"]} AND vocab={$_vid} AND list={$_lid}";
            if (!mysqli_query($conn, $_sql)) {
                echo "Error: Could not update statistics! " . mysqli_error($conn);
                exit;
            }

            // Call correct-view
            $_correct = 1;
            include("student_vocheck_tool_step.php");
            mysqli_close($conn);
            exit;
        } else {
            // Update statistics to 2 - seen but incorrect
            $_sql = "UPDATE statistics SET status=1 WHERE student={$_SESSION["user"]["id"]} AND vocab={$_vid} AND list={$_lid}";
            if (!mysqli_query($conn, $_sql)) {
                echo "Error: Could not update statistics! " . mysqli_error($conn);
                exit;
            }

            // Call wrong-view
            $_correct = 0;
            include("student_vocheck_tool_step.php");
            mysqli_close($conn);
            exit;
        }
    } else {
        echo "Error. Did not found vocabulary in DB.";
        mysqli_close($conn);
        exit;
    }
}
