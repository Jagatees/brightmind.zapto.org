<?php
session_start();
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'])):
    header('Location: login.php');
endif;
?>  

<!DOCTYPE html>
<html lang="en">


<div id="main">

<head>
    <title>Bright Minds Academy</title>
    <?php
        include "inc/head.inc.php";
    ?>
    
</head>
<body>
    <?php
        include "inc/header.inc.php";
    ?>

    <div id="menu">
    <button onclick="approvedLesson()">approvedLesson</button>
    <button onclick="showCreateTeacher()">CreateTeacherAccount</button>

    </div>

    <div id="content">
    <h1>Welcome Page</h1>
    <p>Click the buttons on the left to view different content here.</p>
    </div>
            
 
    <?php
        include "inc/footer.inc.php";
    ?>
</div>

<script>
function showCreateTeacher() {
    document.getElementById('content').innerHTML = '<h1>showCreateTeacher</h1>';
  }


  function approvedLesson() {
  var approvalHTML = `
    <div class="approval-container">
      <div class="approval-header">
        <h4>Approvals</h4>
        <div>2 pending approvals</div>
      </div>
      <div class="approval-list">
        <div class="approval-item" id="request1">
          <span>Requester1 - Marketing Campaign</span>
          <button class="approve" onclick="handleApproval('request1', true)">Approve</button>
          <button class="deny" onclick="handleApproval('request1', false)">Deny</button>
        </div>
        <div class="approval-item" id="request2">
          <span>Requester2 - Marketing Campaign</span>
          <button class="approve" onclick="handleApproval('request2', true)">Approve</button>
          <button class="deny" onclick="handleApproval('request2', false)">Deny</button>
        </div>
      </div>
    </div>
  `;
  
  document.getElementById('content').innerHTML = approvalHTML;
}

function handleApproval(requestId, isApproved) {
  var element = document.getElementById(requestId);
  if (isApproved) {
    // Handle the approval logic here, e.g., updating the database.
    console.log(requestId + ' approved');
  } else {
    // Handle the denial logic here.
    console.log(requestId + ' denied');
  }
  element.style.display = 'none'; // Remove the request from view.
}

</script>

</body>
</html>