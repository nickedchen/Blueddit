<!-- Home -->

<!DOCTYPE html>
<html lang="en" class="home">

<?php include 'include/head.php'; ?>

  <main>
    <body>
    <?php
      //Check for login
      session_start();

      if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
            header('Location: auth.php');
            die();
      }
    ?>

      <!-- Navigation bar -->
      <?php include 'include/navbar.php'; ?>

      <!-- Content -->
      <div class="container-fluid">
        <div class="row pt-4">
          <!-- Sidebar -->
          <?php include 'include/sidebar.php'; ?>

          <!-- Posts -->

          <div class="col-md-6 overflow-auto">
            
            <div class="post">
              <img src="res/img/p1.svg" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
              <div class="content">
                <span class="post-title">Mom said my new cat is ugly [OC]</span>
                <span class="post-text">tell her to apologize to your cat. right now.</span>
              </div>
              <div class="icon">→</div>
            </div>

            <div class="post">
              <img src="res/img/p2.svg" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
              <div class="content">
                <span class="post-title">
                  He sleeps like the dead. I have an uncontrollable urge to give him rosary beads, just in case…
                </span>
                <span class="post-text">Meow father, who art in heaven…</span>
              </div>
              <div class="icon">→</div>
            </div>

            <div class="post">
              <img src="res/img/p3.svg" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
              <div class="content">
                <span class="post-title">Oh no, poor kitty ...</span>
                <span class="post-text">
                  I don't think he has one orange brain cell. That's one smart orange tabby.
                </span>
              </div>
              <div class="icon">→</div>
            </div>

            <div class="post">
              <img src="res/img/p4.svg" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
              <div class="content">
                <span class="post-title">meet my new study buddy</span>
                <span class="post-text">Gorgeous! What’s the name?</span>
              </div>
              <div class="icon">→</div>
            </div>

            <div class="post">
              <img src="res/img/p5.svg" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
              <div class="content">
                <span class="post-title">
                  Never had a cat before this little guy. He stole my heart and my thoughts on cats.
                </span>
                <span class="post-text">Watch out. They’ll steal your chair too lol.</span>
              </div>
              <div class="icon">→</div>
            </div>

            <div class="post">
              <img src="res/img/p6.svg" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
              <div class="content">
                <span class="post-title">She's so cute</span>
                <span class="post-text">kittens have a way of capturing our hearts.</span>
              </div>
              <div class="icon">→</div>
            </div>

            <div class="post">
              <img src="res/img/p7.svg" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
              <div class="content">
                <span class="post-title">
                  She’s from the streets but I think she’s taking to couches and blankets quite well
                </span>
                <span class="post-text">They bites!</span>
              </div>
              <div class="icon">→</div>
            </div>

            <div class="post">
              <img src="res/img/p8.svg" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
              <div class="content">
                <span class="post-title">😻❄</span>
                <span class="post-text">😻😻😻😻😻😻😻😻</span>
              </div>
              <div class="icon">→</div>
            </div>
          </div>

          <!-- Panel -->
          <div class="col-md-3">
            <div class="dropdown">
              <button
                class="btn btn-primary border-0 dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                Top
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">New</a></li>
                <li><a class="dropdown-item" href="#">Recommended</a></li>
                <li><a class="dropdown-item" href="#">Hot</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </body>
  </main>
</html>
