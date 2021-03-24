<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location:login-form.php');
    }
    if($_SESSION['type'] === "apprenti"){
        header("location:studentProfile.php");
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Personal page</title>
</head>
<body>
<?php include 'navbar.php'; ?>

<section class="section">
  
    <div class="container is-flex is-flex-direction-row is-align-items-center">
        <figure class="image is-96x96">
      <img class="is-rounded" src="../assets/killprofilpic.jpeg" alt="profil pic chef">
      </figure>
      <p class="ml-2">Hello <?php echo $_SESSION['firstname']; ?></p>
    </div>
</section>
  <section class="section is-flex is-flex-direction-row is-flex-wrap-wrap is-justify-content-space-between">
    
        <div class="container card-pointage is-flex is-flex-direction-column is-align-items-center">
            <h3 class="title is-3 has-text-black has-text-centered">Pointages</h3>
            
            <input class="input" type="text" placeholder="Text input">
            <input class="input" type="text" placeholder="Text input">
            <input class="input" type="text" placeholder="Text input">
            
        </div>
        <div class="container card-profil  is-flex is-flex-direction-column is-align-items-center"> 
            <h3 class="title is-3 has-text-black">Student Profiles</h3>

            <?php
            include 'dbConnexion.php';

            $request = $db->prepare("SELECT * FROM `people` WHERE `account_type` = 'apprenti' ORDER BY `account_type` ASC LIMIT 3");

            $request->execute();

            while ($data = $request->fetch()) {
                echo '<div class="container profil-acces is-flex is-flex-direction-row is-align-items-center ">
            <figure class="image is-64x64">
            <img class="is-rounded" src="../assets/Ellipse1.svg" alt="profil pic chef">
            </figure>';
                echo '<p class="title is-4 has-text-black m-0">' . $data['firstname'] . ' ' . $data['lastname'] . '</p>';
                echo '<a href="" target="_blank"> <i class="far fa-user-circle fa-2x ml-3"></i></a>
            </div>';

            }

            ?>

        </div>

        <div class="container card-reciepe  is-flex is-flex-direction-column is-align-items-center">
            <h3 class="title is-3 has-text-black">Receipes</h3>
            <?php
            include 'dbConnexion.php';

            $request = $db->prepare('SELECT recipe.id, recipe.topic_recip, recipe.description,  recipe.date_recip, recipe.idStudent, people.firstname, people.lastname FROM recipe INNER JOIN people ON recipe.idStudent = people.id ORDER BY recipe.id DESC LIMIT 3');

            $request->execute();

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
                echo '<p> ' . $data['firstname'] . ' ' . $data['lastname'] .           '</p>';
                echo '<button class="button is-small"><a href="allRecipes.php">See full reciepe</a></button>

                            </div>
                      </div>
            </div>
            <button class="modal-close is-large" id="modal-close" aria-label="close"></button>
            </div>';
            }

            ?>
        </div>
    </div>
  </section>

<?php include 'footer.php'; ?>
<script src="../js/modal.js"></script>
</body>

</html>