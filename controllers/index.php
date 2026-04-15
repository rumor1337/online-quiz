<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz</title>
    <link rel="stylesheet" href="css/quiz.css">
</head>
<body>

<div class="box">

    <div class="dropdown-box">
        
        <h2 class="title">Choose a Topic</h2>

        <button class="dropdown-btn" id="dropdownBtn">
            Select ▼
        </button>

        <div id="dropdown" class="dropdown-content">
            <div data-topic="Math">Math</div>
            <div data-topic="Science">Science</div>
            <div data-topic="History">History</div>
            <div data-topic="Geography">Geography</div>
            <div data-topic="Sports">Sports</div>
        </div>

        <div class="selected" id="selectedTopic">
            No topic selected
        </div>

    </div>
</div>
<script src="js/quiz.js"></script>

</body>
</html>
=======
<?php

    ob_start();
    session_start();
    require "Sessions.php";

    require("views/components/navbar.php");
    
?>

main page

<?php

    $content = ob_get_clean();

    require("views/components/layout.php");

?>
>>>>>>> 5da1286c256c691c71a1e28c3a637dafc2066397
