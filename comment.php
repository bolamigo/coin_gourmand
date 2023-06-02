<?php include 'functions.php'?>

<?php
session_start();
$_SESSION['user_id'] = 1;
// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $content = $_POST['comment'];
        $parentCommentId = isset($_POST['parent_comment_id']) ? $_POST['parent_comment_id'] : null ;

        // Insert the comment into the database
        try {
            $query = "INSERT INTO comment (user, recipe, content, date, parent) VALUES (:user,5 , :content, NOW(), :parent)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':user', $userId);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':parent', $parentCommentId);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Database query failed: ' . $e->getMessage());
        }
    }
}
// Retrieve comments from the database
try {
    $query = "SELECT c.*, u.nickname FROM comment c INNER JOIN user u ON c.user = u.id";
    $stmt = $conn->query($query);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Database query failed: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="comment.css">
<body>

    <h1>Commentaires</h1>

    <?php foreach ($comments as $comment) : ?>
        <div class="comment">
            <div class="user"><?php echo $comment['nickname']; ?></div>
            <div class="date"><?php echo $comment['date']; ?></div>
            <div class="content"><?php echo $comment['content']; ?></div>
        </div>
    
        <!-- Reply form -->
        <div class="reply">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="parent_comment_id" value="<?php echo $comment['id']; ?>">
                <textarea name="comment" rows="2" cols="50" required></textarea><br>
                <input type="submit" value="Répondre">
            </form>
        </div>
    <?php endforeach; ?>
    <?php if (isset($_SESSION['user_id'])) : ?>
    <h2>Ajouter un commentaire</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <textarea name="comment" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Submit Comment">
    </form>
<?php else : ?>
    <p>Connectez vous pour laisser un avis</p>
<?php endif; ?>
</body>
</html>