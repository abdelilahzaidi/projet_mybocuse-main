<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location:login-form.php');
    }
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>All Recipes</title>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section class="section">
        <div class="container is-flex is-flex-direction-row is-align-items-center">
            <figure class="image is-96x96">
                <img class="is-rounded" src="../assets/Ellipse1.svg" alt="profil pic chef">
            </figure>
            <p class="ml-2">Hello <?php echo $_SESSION['firstname']; ?></p>
        </div>
    </section>

    <!-- <div class="media-left">
        <figure class="image is-128x128">
            <img class="is-rounded" src="../assets/tiramisu.jpg" alt="Placeholder image">
        </figure>
    </div> -->

    <?php
        //session_start(); //NOTE: nécessaire ou pas ?
        header('Content-type: text/html; charset=UTF-8');
        try {
            include 'dbConnexion.php';

            //if (isset($_SESSION['email'])) {
            $request = $db->prepare('SELECT recipe.id, recipe.topic_recip, recipe.fullRecipe, recipe.date_recip, recipe.idStudent, people.firstname, people.lastname FROM recipe INNER JOIN people ON recipe.idStudent = people.id /*WHERE id = ? AND topic_recip = ? AND description = ? AND date_recip = ?*/');
            //if($request){
            $request->execute();

            while ($data = $request->fetch()) {
        
            echo '<div class="container-accordion">';
            echo '<button class="accordion has-text-justified is-capitalized is-size-5 ml-1"><i class="fas fa-plus-circle"></i>' . $data['topic_recip'] . '</button>';
            echo '<div class="panel" style="display: none;">';
            echo '<p>' . nl2br($data['fullRecipe']) . ' <br>' . $data['date_recip'] . '</p>';
            echo '<p class="subtitle is-6">' . $data['firstname'] . ' ' . $data['lastname'] . '</p>';
            echo '</div>';
            echo '</div>';
        
            }
        //}
        //}
        }

        catch(Exception $e){
            die('Error: '.$e->getMessage());
        }
    ?>

    <?php include 'footer.php'; ?>
    <script src="../js/accordion.js"></script>
</body>

</html>