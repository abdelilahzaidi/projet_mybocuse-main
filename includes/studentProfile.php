<!--TODO: move head, header & footer to a more general page. "Profile" page and include specific profiles to that one page ? -->
<?php
    session_start();
    if(!isset($_SESSION['id'])){
    header('Location:login-form.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>My bocuse student profil</title>
</head>
<body>


<?php 
include 'navbar.php';
?>
 <section class="section">
  
  <div class="container is-flex is-flex-direction-row is-align-items-center">
      <figure class="image is-96x96">
    <img class="is-rounded" src="../assets/Ellipse1.svg" alt="profil pic chef">
    </figure>
    <p class="ml-2">Hello <?php echo $_SESSION['firstname']; ?></p>
  </div>
</section>
 <section class="section is-flex is-flex-direction-row is-flex-wrap-wrap is-justify-content-space-around">
    
    <div class="container card-pointage-student is-flex is-flex-direction-column is-align-items-center">
        <h3 class="title is-3 has-text-black has-text-centered">Pointages</h3>
        <h3 class="subtitle is-4 has-text-black has-text-centered">Please check the right button</h3>
        <button class="button pointage">ARRIVAL</button>
        <button class="button pointage">DEPARTURE</button>
        
    </div>

    <div class="container card-reciepe  is-flex is-flex-direction-column is-align-items-center">
        <div class="container-title is-flex is-flex-direction-row is-align-items-center">
        <h3 class="title is-3 has-text-black">Receipes</h3>
        <a href="recipes.php"><i class="fas fa-plus fa-2x ml-4"></i></a>
        </div>
            <?php
            include 'dbConnexion.php';

            $request = $db->prepare('SELECT recipe.id, recipe.topic_recip, recipe.description,  recipe.date_recip, recipe.idStudent, people.firstname, people.lastname FROM recipe INNER JOIN people ON recipe.idStudent = people.id WHERE recipe.idStudent = ? ORDER BY recipe.id DESC LIMIT 3');

            $request->execute(array($_SESSION['id']));

            while ($data = $request->fetch()) {

                echo '<button class="button is-medium modal-open has-text-justified is-lowercase is-size-7" id="button">' . $data['topic_recip'] .'</button>';
                echo '<div class="modal" id="page-modal">
            <div class="modal-background" id="modal-bg"></div>
            <div class="modal-content">
            <div class="card">
                            <div class="card-content">
                              <p class="title ">' . $data['topic_recip'] . '</p>';
                echo '<p class="subtitle">' . $data['description'] .
                              '</p>';
                /*echo '<p> ' . $data['firstname'] . ' ' . $data['lastname'] .           '</p>';*/
                echo '<button class="button is-small"><a href="allRecipes.php">See full reciepe</a></button>

                            </div>
                      </div>
            </div>
            <button class="modal-close is-large" id="modal-close" aria-label="close"></button>
            </div>';
            }

            ?>
        </div>

</section>

<?php 
include 'footer.php';
?>
</body>
<script src="../js/modal.js"></script>

</html>