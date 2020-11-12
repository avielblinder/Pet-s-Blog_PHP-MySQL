<?php

session_start();
$page_title = 'Home Page';

?>
<?php include 'tpl/header.php'; ?>

<main class=" fill">
  <div class="container-fluid main-container pt-4  text-white">
    <div class="container">
      <section id="top-content">
        <div class="row">
          <div class="col-12 text-center">
            <h1 class="home-h1 display-4">The Pet's blog site!</h1>
            <p class="home-p">forum for everyone.</p>
            <p><a href="signup.php" class="btn btn-warning btn-lg">Join us now</a></p>
          </div>
        </div>
      </section>
      <section id="main-content">
        <div class="row">
          <div class="col-12 d-flex mt-3">
            <div class="container">
              <article class="main-article-class">
                <p>
                  At this site tou can read, write, and comment on any releated pat's or home animals growth.<br>
                  You can share and learn from other peaple about animals information and care ways.<br>
                  You can read about pet's treatment.<br>
                  This is the best place for pet's owner, but not only pet's treatment also all kind of animal's
                  from the smallest ones as fishes till horses and bear owner's.<br>
                  We welcome you to our great site, to get to know other pet's owner's and animal's owner to get new
                  friends
                  from our great community.<br>
                  We waiting for you and for your friend's, let us get to know your best animal friend!
                </p>
              </article>

            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

</main>

<?php include 'tpl/footer.php'; ?>