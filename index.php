<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>My Blog</h1>

<form method="GET" action="search.php">
    <input type="text" name="query" placeholder="Search posts...">
    <button type="submit">Search</button>
</form>

<?php
$limit = 3; // Posts per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$stmt = $conn->prepare("SELECT * FROM posts LIMIT :start, :limit");
$stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
$stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();

foreach ($posts as $post) {
    echo "<h2>{$post['title']}</h2>";
    echo "<p>{$post['content']}</p><hr>";
}

// Total number of posts
$total = $conn->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$pages = ceil($total / $limit);

echo "<div class='pagination'>";
for ($i = 1; $i <= $pages; $i++) {
    echo "<a href='index.php?page=$i'>$i</a> ";
}
echo "</div>";
?>

</body>
</html>
