<?php
require_once './../../classes/Member.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $member = new Member(
        null,
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['email'],
        $_POST['password']
    );
    
    $result = $member->register();
    
    if ($result['success']) {
        header('Location: signin.php?registered=1');
        exit;
    }
    $errors = isset($result['errors']) ? $result['errors'] : array($result['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <title>
    Material Dashboard 3 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>
<body class="">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                <div class="card card-plain">
                    <div class="card-header">
                        <h4 class="font-weight-bolder">Sign Up</h4>
                        <p class="mb-0">Enter your information to register</p>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST">
                            <?php if (isset($errors)): ?>
                                <?php foreach ($errors as $error): ?>
                                    <div class="alert alert-danger text-white"><?= htmlspecialchars($error) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="prenom" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="telephone" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="register" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <p class="mb-2 text-sm mx-auto">
                            Already have an account?
                            <a href="signin.php" class="text-primary text-gradient font-weight-bold">Sign in</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>