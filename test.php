<?php
session_start();

if (!isset($_SESSION['pseudo'])) {
?>
<form action="server/connection.php" method="post">
    <input type="text" name="pseudo" placeholder="Pseudo">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="submit" value="Ok">
    <input type="hidden" name="page" value="<?php echo  $_SERVER['REQUEST_URI']; ?>" >
</form>
<?php
} else {
    ?>
        <h2>Welcome <?php echo $_SESSION['pseudo'] ?></h2>
    <?php
}
 ?>
