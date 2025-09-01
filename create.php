<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Create New Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Create New Blog Post</h1>
<a href="index.php">⬅ Back to Home</a><br><br>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
        $stmt->execute([
            ':title' => $title,
            ':content' => $content
        ]);
        echo "<p style='color: green;'>Post created successfully!</p>";
    } else {
        echo "<p style='color: red;'>Please fill in all fields.</p>";
    }
}
?>

<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Content:</label><br>
    <textarea name="content" rows="6" cols="40" required></textarea><br><br>

    <button type="submit">Create Post</button>
</form>

</body>
</html>
