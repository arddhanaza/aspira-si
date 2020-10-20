<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ASPIRA-SI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Feed <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Aspiration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Announcement.html">Announcement</a>
                </li>
            </ul>
            <!--            <form class="form-inline my-2 my-lg-0">-->
            <!--                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
            <!--                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
            <!--            </form>-->
        </div>
    </div>
</nav>


<section class="container">
    <!--Start of Aspiration Card-->
    <div class="row justify-content-center mb-4">
        <div class="col-12">
            <div class="card aspiration-card">
                <div class="card-header aspiration-card-header">
                    <div class="row">
                        <div class="col-9">
                            <h3>Proses Registrasi surat izin lambat</h3>
                            <span class="span-time">Posted on September, 23rd 2020. 15.34pm</span>
                        </div>
                        <div class="col-3 text-right">
                            <div class="dropdown">
                                <button class="btn btn-outline-danger btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ...
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Details</a>
                                    <a class="dropdown-item bg-danger" href="#">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body aspiration-card-body">
                    <div class="aspiration-card-body-content">
                        <div class="row mb-4">
                            <div class="col-1 col">
                                <img alt="" class="img-thumbnail img-icon" src="../assets/img/telkom.jpg"
                                     style="width: 50px">
                            </div>
                            <div class="col-11 col">
                            <span class="span-asal">
                                ***4143
                            </span>
                                <br>
                                <span class="span-tujuan">
                                Kepada: Laboratorium A
                            </span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam doloremque enim
                                    facere iure perferendis placeat quam repellendus vel? Amet atque consequuntur est
                                    exercitationem expedita illum, labore molestiae nisi velit voluptatum.
                                </p>
                            </div>
                            <div class="col-10">
                                <button class="btn btn-outline-info">File Pendukung</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer aspiration-card-footer">
                    <div class="row">
                        <div class="col-8">
                        <form action="Announcement.php" method="post">
                            <select name="data" id="" class="update-selection btn btn-sm btn-outline-light">
                                <option disabled selected>Resolve Status</option>
                                <option >Di Tinjau</option>
                                <option >Process</option>
                                <option >Diteruskan</option>
                                <option >Done Resolved</option>
                            </select>
                            <button class="btn btn-sm btn-primary" name="submit" type="submit" class="nav-link">Update</button>
                            </form>
                        </div>
                        <div class="col-4 text-right">
                            <a href="">see all comments</a>
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