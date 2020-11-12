<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <link rel="icon" href="images/favicon.ico">
  <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />

  <title>Pet's Blog | <?= $page_title; ?></title>
</head>

<body class="d-flex flex-column min-vh-100">
  <header class=" sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary shadow">
      <div class="container">
        <a class="navbar-brand text-white" href="index.php">Pet's <img class="logo" width="40"
            src="./images/logoPicture.png" alt="logo">
          Blog&nbsp;
          <span id="line-span">|</span>
          &nbsp;&nbsp;
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="blog.php">Blog</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php if(!isset($_SESSION['user_id']) ): ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="signin.php">Sign-in</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="signup.php">Sign-up</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="user_profile.php">
                <?= htmlentities($_SESSION['user_name']); ?> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="logout.php"> Log-out</a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    </div>
  </header>