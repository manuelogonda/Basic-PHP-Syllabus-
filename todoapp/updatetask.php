<?php
include 'to-dodb.php';
$task = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
if (isset($_POST['action']) && $_POST['action'] === 'edit_task') {
    $id = $_POST['id'];
    $fetch_query = "SELECT * FROM todo_app WHERE id = :id;";
    $stmt = $pdo->prepare($fetch_query);
    $stmt->bindParam(":id",$id);
    $stmt->execute();
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$task){
        die("No such task");
    }
   
}else if(isset($_POST['action']) && $_POST['action'] === 'update_task'){
    $id = $_POST['id'];
    $newtaskname = $_POST['newname'];
    $newstatus = $_POST['newstatus'];
    
    $update_query = "UPDATE todo_app SET task_name = :name ,status = :status WHERE id= :id;";
    $stmt = $pdo->prepare($update_query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name",$newtaskname);
    $stmt->bindParam(":status",$newstatus);
    $stmt->execute();
    $stmt = null;
    $stmt = null;

    echo "update was successful go back";

}
}
//header("Location: mainindex.php");
//Why redirecting to mainindex.php?
//Because after updating the task status, we want to go back to the main page to see the updated list of tasks.
// header() function is used to send a raw HTTP header to the client
// "Location: mainindex.php" tells the browser to navigate to mainindex.php
//exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update your task</title>
</head>
<body>
    <?php if(!empty($task)): ?>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
       <input type="hidden" name="action" value="update_task">
       <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">
       <label for="name">Name:</label>
       <input type="text" name="newname"> <br> <br>
       <label for="status">Status:</label>
       <select name="newstatus">
        <option value="complete">complete</option>
        <option value="incomplete">incomplete</option>
        <option value="inprogress">inprogress</option>
       </select>
       <button type="submit">Update Task</button>
    </form>
    <?php endif; ?>
</body>
</html>