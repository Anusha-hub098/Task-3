<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Search Results</h1>
<a href="index.php">⬅ Back to Home</a><br><br>

<?php
$query = $_GET['query'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE :query OR content LIKE :query");
$stmt->execute([':query' => "%$query%"]);
$results = $stmt->fetchAll();

if ($results) {
    foreach ($results as $post) {
        echo "<h2>{$post['title']}</h2>";
        echo "<p>{$post['content']}</p><hr>";
    }
} else {
    echo "No results found.";
}
?>

</body>
</html>
