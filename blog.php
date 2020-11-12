<?php

session_start();

require_once 'backend/helpers.php';

$page_title = 'The Blog';

$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
mysqli_query($link, "SET NAMES utf8");

$sql = "SELECT u.name,u.profile_image,p.* FROM posts p 
        JOIN users u ON u.id = p.user_id
        ORDER BY p.date DESC";

$result = mysqli_query($link, $sql);
$uid = $_SESSION['user_id'] ?? null;

?>
<?php include 'tpl/header.php'; ?>

<main class="mt-3 fill">
  <div class="container mb-5">
    <section id="top-content">
      <div class="row">
        <div class="col-12">
          <h1 class="display-4">View all posts</h1>
          <p> Here you can watch and write new posts!</p>
          <p>
            <?php if(isset($_SESSION['user_id'])): ?>
            <a class="btn btn-primary" href="add_post.php">Add new post!</a>
            <?php else: ?>
            <a href="signin.php">Open free account and add your post.</a>
            <?php endif; ?>
          </p>
        </div>
      </div>
    </section>
    <?php if( $result && mysqli_num_rows($result)): ?>
    <section id="posts-content">
      <div class="row">
        <?php while($post = mysqli_fetch_assoc($result)): ?>
        <div class="col-12 mb-3">
          <div class="card">
            <div class="card-header p-2">
              <img class="round ml-2" src="images/<?= $post['profile_image']; ?>" width="45">
              <span class="ml-3 font-weight-bold"><?= htmlentities($post['name']); ?></span>
              <span
                class="float-right m-2 font-weight-bold"><?= date('d/m/Y H:i:s', strtotime($post['date'])); ?></span>
            </div>
            <div class="card-body">
              <h4><?= htmlentities($post['title']); ?></h4> <!-- against < > script/html xss attack -->
              <p><?= str_replace("\n",'<br>',htmlentities($post['article'])); ?></p>
              <!-- replace the \n new line with <br> -->
              <?php if( $uid && $post['user_id'] == $uid ): ?>
              <div class="float-right mr-3">
                <a class="dropdown-toggle no-decoration no-arrow" href="#" role="button" id=" dropdownMenuLink"
                  data-toggle="dropdown">
                  <i class=" fas fa-ellipsis-h"></i>
                </a>
                <div class="dropdown-menu edit-btn">
                  <a class="dropdown-item" href="edit_post.php?pid=<?= $post['id']; ?>">
                    <i class="fas fa-edit"></i>&nbsp;
                    Edit
                  </a>
                  <a class="dropdown-item delete-post-btn" href="delete_post.php?pid=<?= $post['id']; ?>">
                    <i class="fas fa-eraser"></i>&nbsp;
                    Delete
                  </a>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </section>
    <?php endif; ?>
  </div>
</main>

<?php include 'tpl/footer.php'; ?>