<?php  
    include_once "db.php";


    $greska_username = "";
    $greska_email = "";
    $greska_password = "";
    $greska_role = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_REQUEST['username'])){
            $greska_username = "* Username is required! *";
        }if(empty($_REQUEST['email'])) {
            $greska_email = "* Email is required! *";
        }if(empty($_REQUEST['password'])){
            $greska_password = "* Password is required! *";
        }if(empty($_REQUEST['role'])){
            $greska_role = "U did not select a role!";
        }

        if(!empty($_REQUEST['username']) && !empty($_REQUEST['email']) && !empty($_REQUEST['password']) && !empty($_REQUEST['role'])){
            
            # Sada treba da proverim da li korisnik ili email adresa vec postoje u bazi podataka
            $korisnici = $pdo->query("SELECT * FROM users")->fetchAll();
            foreach($korisnici as $korisnik){
                if($korisnik['username'] == $_REQUEST['username']){
                    $greska_username = "Username is already in use!";
                }elseif($korisnik['email'] == $_REQUEST['email']){
                    $greska_email = "Email is already in use!";
                }else{
                    # Upisujem u bazu korisnika!
                    $stmt = $pdo->prepare("INSERT INTO users (username,email,password,role) VALUES (?,?,?,?)");
                    $stmt->execute([$_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'], $_REQUEST['role']]);
                    header("Location: login.php");
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
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-3">
                <label class="form-label" for="form2Example1">Username</label>
                <input type="text" id="form2Example1" class="form-control" name="username" />
                <span class="greska"><?= $greska_username ?></span>
            </div>

            

            <div data-mdb-input-init class="form-outline mb-3">
                <label class="form-label" for="form2Example1">Email address</label>
                <input type="email" id="form2Example1" class="form-control" name="email"  />
                <span class="greska"><?= $greska_email ?></span>
                
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-3">
                
                <label class="form-label" for="form2Example2">Password</label>
                <input type="password" id="form2Example2" class="form-control" name="password" />
                <span class="greska"><?= $greska_password ?></span>
            </div>

            <div data-mdb-input-init class="form-outline mb-3">
                <label for="">Select type of an account</label>
                <select class="form-control" id="sel1" name="role">
                    <option value="admin">Admin</option>
                    <option value="autor">Autor</option>
                    <option value="user">User</option>                   
                </select>
                <span class="greska"><?= $greska_role ?></span>
                
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-3">
                <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                
                </div>

                <div class="col">
                <!-- Simple link -->
                    <a href=""></a>
                </div>
            </div>

            <!-- Submit button -->
            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-3">Sign in</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Already have account? <a href="login.php">Log in</a></p>
            </div>
        </form>
    </div>
</div>



<?php include "moduli/foot.php" ?>