<?php 

session_start();

if(isset($_SESSION['user_id'])){//if the user_is is in the session then you don't need sign in page
  header('location:blog.php');
}
require_once 'backend/helpers.php';

$page_title = 'Sign-in';
$error =['email' =>'', 'password'=>'','submit'=>''];

if(isset($_POST['submit'])){//if he get the submit mining he send the form 
  $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);//against xss attack + validate email
  $email = trim($email);
  $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
  $password = trim($password);
  $form_valid = true;
  
  if(!$email ){
    $error['email'] = '* Valid email is required.';   
    $form_valid = false;
  }
  if(!$password){
    $error['password'] = '* Valid password is required.';
    $form_valid = false;
  }

  if($form_valid){
    $link =  mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PWD,MYSQL_DB);
    $email = mysqli_real_escape_string($link,$email);//against sql injection 
    $password = mysqli_real_escape_string($link,$password);
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($link,$sql);
    
    if($result && mysqli_num_rows($result) ==1){//how many rows did i get- for hackers checking if its found 1 email 
      $user = mysqli_fetch_assoc($result);
      
      if(password_verify($password,$user['password'])){//checking is the hash password is equal to user password true/false
        $_SESSION['user_id']= $user['id'];//super global variable
        $_SESSION['user_name'] = $user['name'];
        header('location: blog.php');//send an header build in function
        
      }else{
        $error['submit'] = ' * Invalid email or password.';
      }
      
    }else{
      $error['submit'] = ' * Invalid email or password.';
    }
  }
}

?>
<?php include 'tpl/header.php'; ?>
<main class="mt-3 fill">
  <div class="container">
    <section id="top-content">
      <div class="row">
        <div class="col-12">
          <h1 class="display-4 mb-3">Sign-in with your account.</h1>
          <p><a href="signup.php">Open new account!</a></p>
        </div>
      </div>
    </section>
    <section id="signin-form">
      <div class="row">
        <div class="col-lg-6 mt-3">
          <form action="" method="POST" novalidate="novalidate">
            <div class="form-group">
              <label for="email">Email:</label>
              <input value="<?= old('email'); ?>" type=" email" name="email" class="form-control" id="email">
              <span class="text-danger"><?= $error['email'] ?></span>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" name="password" class="form-control" id="password">
              <span class="text-danger"><?= $error['password'] ?></span>
            </div>
            <span class="text-danger d-block"> <?= $error['submit']; ?></span>
            <button class="btn btn-primary mt-2" type="submit" name="submit">Sign-in</button>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include 'tpl/footer.php'; ?>