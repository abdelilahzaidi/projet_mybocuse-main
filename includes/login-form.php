<?php

    session_start();
    if (isset($_SESSION['wrongCredentials'])||isset($_SESSION['unknownCredentials'])){
        unset($_SESSION['wrongCredentials'], $_SESSION['unknownCredentials']);
    }
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $pass = sha1($_POST['pass']);

        include 'dbConnexion.php';

        $sql = "SELECT * FROM people where email= ? ";
        $result = $db->prepare($sql);
        $result->execute(array($_POST['email']));

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll();
            if ($pass === $data[0]["passwords"]) {
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $data[0]["id"];
                $_SESSION['type'] = $data[0]["account_type"];
                $_SESSION['firstname'] = $data[0]["firstname"];
                $_SESSION['lastname'] = $data[0]["lastname"];
                if ($_SESSION['type'] === "chef") {
                   header("location:chefProfile.php");
                } else {
                    header("location:studentProfile.php");
                }
              } else {
                $_SESSION['wrongCredentials'] = array("Your username or password was incorrect.");
                }
         } else{
            $_SESSION['unknownCredentials'] = array('Unknown credentials. 
            Please check your credentials or contact your chef.');   
         }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>My bocuse</title>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section class="hereo has-bg-img-login">


    
    <form action="" method="post" class="container-login is-flex is-flex-direction-column is-justify-content-center is-align-items-center">
    <img class="mt-4"src="../assets/paul_bocuse_logo_form.svg">
    <h1 class="title is-size-1 has-text-black">Login</h1>
    <h2 class="subtitle is-size-3 has-text-black">Sign up to your account</h2>
        <input class="login" type="text" name="email" id="emailInput" placeholder="Your email">
        <input class="login" type="password" name="pass" id="passwordInput" placeholder="Your password">
        
        <?php if (isset($_SESSION['wrongCredentials'])): ?>
            <div class="help form-errors is-danger">
                <?php foreach($_SESSION['wrongCredentials'] as $error): ?>
                    <p><?php echo $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['unknownCredentials'])): ?>
            <div class="help form-errors is-danger">
                <?php foreach($_SESSION['unknownCredentials'] as $error): ?>
                    <p><?php echo $error ?></p>
                <?php endforeach; ?>
            
        <?php endif; ?>

        <button class="button is-rounded mt-5" type="submit" value="login" name="submit">Sign up
    </form>
    </div>
                </section>
    <?php 
include 'footer.php';

?>

</body>

</html>