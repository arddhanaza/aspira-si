<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ASPIRA-SI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="../../public/assets/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../public/assets/dist/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@700&family=Roboto&display=swap"
          rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light  nav-main mb-5 sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">ASPIRA-SI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="timeline-forBPM.php">Feed <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="Announcement.php">Announcement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="UbahPassword.php">Profil</a>
                </li>
            </ul>
            <!--            <form class="form-inline my-2 my-lg-0">-->
            <!--                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
            <!--                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
            <!--            </form>-->
        </div>
    </div>
</nav>
      <?php
       error_reporting(error_reporting() & ~E_NOTICE);
       $name= $_POST['data'];
       ?>
<section class="container">
    <!--Start of Aspiration Card-->
    <div class="row justify-content-center mb-4">
        <div class="col-12">
            <div class="card aspiration-card">
                <div class="card-header aspiration-card-header">
                    <h3 style="text-align:center">Data Announcement</h3>
                </div>
                <div class="card-body aspiration-card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Announcement</th>
                                    <th scope="col">File Pendukung</th>
                                    <th scope="col">Issue Terkait</th>
                                    <th scope="col">Tanggal</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Aspirasi</td>
                                        <td>Surat Aspirasi.pdf</td>
                                        <td><?php echo $name?></td>
                                        <td><?= date('M/d/Y '); ?></td>
                                        
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <!--End of Aspiration Card-->
</section>

<button class="btn btn-primary feb btn-lg">
    +
</button>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>
</html>