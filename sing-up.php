<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <title>Sing Up</title>
    <link rel="stylesheet" href="sing-up.css">
</head>

<body>
    <?php
    session_start();
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // retrieve the form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // perform validation on the form data
      
        if (empty($name)) {
            $error = 'Name is required';
        } elseif (empty($email)) {
            $error = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email format';
        } elseif (empty($password)) {
            $error = 'Password is required';
        } else {

            $servername = "localhost";
            $username = "root";
            $passwordd = "";

            // Create connection
            $conn = new mysqli($servername, $username, $passwordd,'job');

            // Check connection
            if ($conn->connect_error) {

                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO persons (name, email ,password)
VALUES ('$name', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION["logged"] = true;
                header('Location: home.php');
            } else {
                $error='adress email est déja utilisé';
            }

            $conn->close();

          
        }
    }
    ?>
    <div class="container">
        <div class="from-box">
            <h1 id="title">Sing Up</h1>
            <form action="" method="post">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Name" name="name">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-field" id="emailField">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-field" id="passwordField">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="btn-flied" style=" justify-content: center;">
                    <button type="submit">sing up</button>
                </div>
                <p>Lost password <a href="#">Clik Here!</a></p>
                <input type="submit" hidden>
            </form>
            <?php
           if(isset($error)==true && $error!==''){
            echo "<div class='error'>$error</div>";
            }
             ?>
            <div class="btn-flied">
                <button type="button" id="singupBtn">sing up</button>
                <button type="button" id="singinBtn" class="disable">sing in</button>
                <button type="button"> <a class="back" href="home.html">Back</a></button>
            </div>
        </div>
    </div>
    <script>
        let singupBtn = document.getElementById("singupBtn");
        let singinBtn = document.getElementById("singinBtn");
        let nameField = document.getElementById("nameField");
        let title = document.getElementById("title");

        singinBtn.addEventListener("click", function() {
            nameField.style.maxHeight = "0";
            title.innerHTML = "Sign In";
            singinBtn.classList.remove("disable");
            singupBtn.classList.add("disable");
        });

        singupBtn.addEventListener("click", function() {
            nameField.style.maxHeight = "60px";
            title.innerHTML = "Sign Up";
            singupBtn.classList.remove("disable");
            singinBtn.classList.add("disable");

        });
    </script>

</body>

</html>