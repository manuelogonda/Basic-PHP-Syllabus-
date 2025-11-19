<?php
require_once 'to-dodb.php';
$tasks = [];

$select_query = "SELECT * FROM todo_app;";
$stmt = $pdo->prepare($select_query);
$stmt->execute();
 $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
 echo "<br>";
 print_r($tasks);
 echo "<br>";
 $pdo = null;
 $pdo = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tasks displayed in the browser</title>
</head>
<body>
    <h2>All the Tasks</h2>
    <?php if(empty($tasks)): ?>
    <p>There is no such task!</p>
    <?php else: ?>
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>task_name</th>
            <th>status</th>
            <th>created_at</th>
            <th>take_actions</th>
        </tr>
        </thead>
        
        <tbody>
            <?php foreach($tasks as $task) :?>
            <tr>
                <td><?= htmlspecialchars($task['id']) ?></td>
                <td><?= htmlspecialchars($task['task_name']) ?></td>
                <td><?= htmlspecialchars($task['status']) ?></td>
                <td><?= htmlspecialchars($task['created_at']) ?></td>
                <td>
                    <form action="deletetask.php" method="POST" onsubmit="return confirm('Sure you want to delete this task!')">
                        <input type="hidden" name="action" value="delete_task">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">
                        <button type="submit">Delete Task</button>
                    </form>

                     <form action="updatetask.php" method="POST">
                        <input type="hidden" name="action" value="edit_task">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">
                        <button type="submit">Edit Task</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 <?php endif; ?>
</body>
</html>