<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Contact Manager</title>
        <link rel="icon" type="image/x-icon" href="assets/img/icon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <?php require_once "process.php"; ?>
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert text-center alert-<?=$_SESSION['msg_type']?>" style="font-size: 2rem;">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">Contact Manager</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/icon.jpg" alt="Contact Icon" /></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contacts">Contacts</a></li>
                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- Home-->
            <section class="resume-section" id="home">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        Contact
                        <span class="text-primary">Manager</span>
                    </h1>
                    <div class="subheading mb-5">
                        Welcome to my simple application that allows you to create, read, update and delete contacts.
                    </div>
                    <div>
                        <form action="process.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Enter their First Name." value="<?php echo $first; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Enter their Last Name" value="<?php echo $last; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter their Email" value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <br>
                                <input type="number" name="day" placeholder="01" min="01" max="31" value="<?php echo $day; ?>">
                                <input type="number" name="month" placeholder="01" min="01" max="12" value="<?php echo $month; ?>">
                                <input type="number" name="year" placeholder="2020" min="1900" max="2020" value="<?php echo $year; ?>">
                            </div>
                            <div class="form-group">
                                <?php if($update == true): ?>
                                    <button type="submit" class="btn-primary" name="update">Update</button>
                                <?php else: ?>
                                    <button type="submit" class="btn-primary" name="save">Save</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <hr class="m-0" />

            <!-- Contacts -->
            <section class="resume-section" id="contacts">
                <div class="resume-section-content">
                    <h2 class="mb-5">Contacts</h2>
                    <?php 
                        $mysqli = new mysqli("localhost", "root", "15uBgvhgCXy5e2f2", "ContactManager") or die(mysqli_error($mysqli));
                        $result = $mysqli->query("SELECT * FROM contacts");
                    ?>
                    <div class="row justify-content-center">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Date of Birth</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <?php
                                while($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $row['First']; ?></td>
                                <td><?php echo $row['Last']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['D.O.B']; ?></td>
                                <td>
                                    <a href="index.php?edit=<?php echo $row['ID'];?>" class="btn btn-secondary">Edit</a>
                                    <a href="process.php?delete=<?php echo $row['ID'];?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
