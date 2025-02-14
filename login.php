<?php 
    include_once "db.php";

    # Dohvatiti podatke iz inputa i proveriti da li postoji takav korisnik
    $greska_password = "";
    $greska_email = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_REQUEST['password'])){
            $greska_password = "Please, enter password...";
        }if(empty($_REQUEST['email'])){
            $greska_email = "Please, enter email...";
        }

        if(!empty($_REQUEST['email'] && !empty($_REQUEST['password']))){
            # Sada proveravam da li postoji takav korisnik u sistemu 
            $podaci = $pdo->query("SELECT * FROM users")->fetchAll();
            foreach($podaci as $korisnik){
                
                if($_REQUEST['password'] == $korisnik['password'] && $_REQUEST['email'] == $korisnik['email']){
                    session_start();
                    $_SESSION['user'] = $korisnik['username'];
                    header("Location: home.php");
                }else{
                    $greska_password = "User not found.";
                }
            }
        }
    }
?>


<?php include "moduli/head.php" ?>

<div class="container">
    <br>
    <br>
    <div class="col-md-12 d-flex justify-content-center">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email address</label>
                <input type="email" id="form2Example1" class="form-control" name="email" value="<?php if(isset($_REQUEST['email']))echo $_REQUEST['email'] ?>" />
                <span class="greska"><?= $greska_email ?></span>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Password</label>
                <input type="password" id="form2Example2" class="form-control" name="password" />
                <span class="greska"><?= $greska_password ?></span>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
                </div>

                <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign in</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Not a member? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</div>

<?php include "moduli/foot.php" ?>