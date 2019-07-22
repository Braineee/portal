<body>

<nav class="site-header navbar navbar-expand-lg navbar-dark bg-darker fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="<?= BASE_URL ?>assets/img/logo_new.png" alt="YABATECH" width="50px"></a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarsExample07" style="">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="?pg=home"><b>Dashboard</b><span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://yabatech.edu.ng"><b>College home</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://portal.yabatech.edu.ng/helpdesk"><b>Helpdesk</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?pg=settings"><b>Settings</b></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Other links</b></a>
          <div class="dropdown-menu" aria-labelledby="dropdown07">
            <a class="dropdown-item" href="?pg=biodata"><img src="<?= BASE_URL ?>assets/icons/user.svg" alt="user_icon" width="20px" height="20px">&ensp;Biodata</a>
            <a class="dropdown-item" href="?pg=fees"><img src="<?= BASE_URL ?>assets/icons/money_2.svg" alt="money" width="20px" height="20px">&ensp;Fee payment & registration</a>
            <a class="dropdown-item" href="?pg=hostel"><img src="<?= BASE_URL ?>assets/icons/hostel.svg" alt="hostel" width="20px" height="20px">&ensp;Hostel &Accomodation</a>
            <a class="dropdown-item" href="?pg=payments"><img src="<?= BASE_URL ?>assets/icons/checklist.svg" alt="check" width="20px" height="20px">&ensp;Payment Confirmation & validation</a>
          </div>
        </li>
      </ul>
      <div class="my-2 my-md-0 inline">
        <img class="inset" src="<?= $_SESSION['student_passport'] ?>" alt="student">&nbsp;
        <b style="color:#fff;"><?= strtolower($_SESSION['student_details']->surname) ?> <?= strtolower($_SESSION['student_details']->firstname) ?></b>&ensp;
        <a href="#" class="logout">
          <img src="<?= BASE_URL ?>assets/icons/logout.svg" alt="logout" width="20px" data-toggle="tooltip" data-placement="bottom" title="Click this button to sign out">
        </a>
      </div>
    </div>
  </div>
</nav>
