<?php 

session_start();

if(isset($_SESSION['user_id'])){
  header('location:blog.php');
}
require_once 'backend/helpers.php';

$page_title = 'Sign-up';
$error =['name'=>'','email' =>'', 'password'=>'','submit'=>'',];

if(isset($_POST['submit'])){
  $link =  mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PWD,MYSQL_DB);
  mysqli_query($link,"SET NAMES utf8");//function that make utf-8 
  
  $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $name  = trim($name);
  $name = mysqli_real_escape_string($link,$name);
  
  $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
  $email  = trim($email);
  $email = mysqli_real_escape_string($link,$email);
  
  $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
  $password  = trim($password);
  $password = mysqli_real_escape_string($link,$password);

  $form_valid = true;

  if(!$name|| mb_strlen($name) < 2 ||mb_strlen($name) > 30 ){
    $error['name']= '* Name is required 2-30 chars';
    $form_validate = false;
  }

  if(! $email ){
    $error['email']= '* Valid email is required.';
    $form_validate = false;
  }else if(email_exist($link,$email)){//from helpers function
    $error['email']= '* Email already exist.';
    $form_validate = false;
  }

  if(!$password || strlen($password) < 6 || strlen($email) > 20){
    $error['password']= '* Password is required 6-20 chars.';
    $form_validate = false;
  }

  if($form_valid){
    $profile_image = 'default-profile.png';
    
      if(isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0){

        if(validate_image($_FILES)){
          $profile_image = date('d.m.Y.H.i.s') . '-' . str_rand(5) . '-' . $_FILES['image']['name'] ;        
           move_uploaded_file($_FILES['image']['tmp_name'],'images/'. $profile_image );//moving file from tmp file to images file (from where - to where)
           
        }      
      }
    
    $password = password_hash($password,PASSWORD_BCRYPT);
    $sql = "INSERT INTO users VALUES(null,'$name','$email','$password','$profile_image')";
    $result= mysqli_query($link,$sql);
    
    if($result && mysqli_affected_rows($link)){
      $_SESSION['user_id'] = mysqli_insert_id($link);//get the data from the link
      $_SESSION['user_name'] = $name;
      header('location: blog.php');//send an header build in function
      
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
          <h1 class="display-4 mb-3">Sign-up for free.</h1>
          <p>Open new account to Pet's Blog for free!</p>
          <a href="signin.php">Back to Sign In</a>
        </div>
      </div>
    </section>
    <section id="signup-form">
      <div class="row mt-3">
        <div class="col-lg-6 mt-3">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">* Name:</label>
              <input value="<?= old('name'); ?>" type="text" name="name" class="form-control" id="name">
              <span class="text-danger"><?= $error['name'] ?></span>
            </div>
            <div class="form-group">
              <label for="email">* Email:</label>
              <input value="<?= old('email'); ?>" type=" email" name="email" class="form-control" id="email">
              <span class="text-danger"><?= $error['email'] ?></span>
            </div>
            <div class="form-group">
              <label for="password">* Password:</label>
              <input type="password" name="password" class="form-control" id="password">
              <span class="text-danger"><?= $error['password'] ?></span>
            </div>
            <div class="form-group">
              <label for="image">Profile Image:</label>
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" id="image" name="image" class="custom-file-input">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file...</label>
                </div>
              </div>
            </div>
            <span class="text-danger d-block"> <?= $error['submit']; ?></span>
            <button class="btn btn-primary mt-2 mb-4" type="submit" name="submit">Sign-up</button>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include 'tpl/footer.php'; ?>