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

    
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- bootstrap js -->
    <script type= "text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                        <a class="nav-link" href="#">Announcement</a>
                    </li>
                </ul>
                <!--            <form class="form-inline my-2 my-lg-0">-->
                <!--                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
                <!--                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
                <!--            </form>-->
            </div>
        </div>
    </nav>

    <!--MODAL ADD-->
    <div aria-hidden="true" aria-labelledby="exampleModalCenterTitle" class="modal fade" id="exampleModalCenter"
        role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Aspiration</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- disini -->
                    <form action="#" method="post" enctype="multipart/form-data">
                        <label for="judul">Topik Aspirasi</label>
                        <input class="form-control " id="judul" placeholder="Fasilitas Praktikum" type="text" name="a">
                        <label for="kepada">Kepada</label>
                        <input class="form-control" id="kepada" placeholder="BPMSI/Lab X/Dosen X" type="text" name="b">
                        <label for="aspirasi">Aspirasi</label>
                        <textarea class="form-control" name="c" id="aspirasi" cols="30" rows="3" placeholder="Mohon maaf, PC di integra ada yang rusak"></textarea>
                        <label for="fil">File Pendukung</label>
                        <input class="form-control-file" id="fil" multiple type="file" name="file[]">

                    <!-- sampe sini -->
                </div>
                <div class="modal-footer">
                    <form method="post" action="#">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit" name="save" id="btn_upload">Save changes</button>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <?php

    if(isset($_POST['save'])){ ?>
        <section class="container">
        <!--Start of Aspiration Card-->
        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <div class="card aspiration-card">
                    <div class="card-header aspiration-card-header">
                        <div class="row">
                            <div class="col-9">
                                <h3><?= $_POST['a']; ?></h3>
                                <!-- Posted on September, 23rd 2020. 15.34pm  'l, M dS Y.', time()-->
                                <span class="span-time">Posted on <?= date('l, M dS Y. h:ia'); ?></span>
                            </div>
                            <div class="col-3 text-right">
                                <button class="btn btn-sm btn-outline-danger">Down Vote</button>
                                <button class="btn btn-sm btn-primary">Up Vote</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body aspiration-card-body">
                        <div class="aspiration-card-body-content">
                            <div class="row mb-4">
                                <div class="col-1 col">
                                    <img alt="" class="img-thumbnail img-icon" src="../../assets/img/telkom.jpg"
                                        style="width: 50px">
                                </div>
                                <div class="col-11 col">
                                    <span class="span-asal">
                                        ***4143
                                    </span>
                                    <br>
                                    <span class="span-tujuan">
                                        Kepada: <?= $_POST['b']; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <p><?= $_POST['c']; ?></p>
                                </div>
                                <div class="col-10">

                                    <!-- <button class="btn btn-outline-info">File Pendukung</button> -->
                                    <!-- <span>File Pendukung</span> -->
                                    <!-- <button class="btn btn-outline-info">  -->
                                        <?php
                                            $countfiles = count($_FILES['file']['name']);
                                            for($i=0; $i < $countfiles; $i++){
                                                $filename = $_FILES['file']['name'][$i];
                                                $dir="upload/";

                                                $uploaded = move_uploaded_file($_FILES['file']['tmp_name'][$i], 'upload/'.$filename);
                                                
                                                if ($uploaded) {
                                                    // echo "Upload berhasil!<br/>";
                                                // echo "<a target=_blank href='".$dir.$filename."'>".$filename."</a>";//link _blank
                                                echo "<img src='".$dir.$filename."' width=\"200px\">";
                                                } else {
                                                    echo "Upload Gagal!";
                                                }
                                            }                                            
                                        ?>
                                    <!-- </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer aspiration-card-footer">
                        <div class="row">
                            <div class="col-1 col">
                                <img alt="" class="img-thumbnail img-icon" src="../../assets/img/telkom.jpg"
                                    style="width: 50px;">
                            </div>
                            <div class="col-11 col">
                                <input class="form-control aspiration-comments" placeholder="add comments" type="text">
                            </div>
                            <div class="col-12 text-right">
                                <a href="">see more comments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Aspiration Card-->
    </section>

    <?php } ?>


    <button class="btn btn-primary feb btn-lg" data-target="#exampleModalCenter" data-toggle="modal">
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