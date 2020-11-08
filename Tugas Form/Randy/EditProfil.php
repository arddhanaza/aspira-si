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
<style>
.avatar{
    position:absolute;
    top: 45%;
    left: 40%
}
.avatar img{
    width:280px;
    height:280px;
    border-radius:100%;
    border: 10px solid white;
}
</style>
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
                <li class="nav-item">
                    <a class="nav-link" href="Announcement.php">Announcement</a>
                </li>
                <li class="nav-item active">
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
                    <h5>Edit Profil</h5>
                </div>
                <div class="card-body aspiration-card-body">
                <table class="table">
                                    <tr>
                                        
                                        <td scope="col" style="text-align:center">Ganti Foto Profil</td>
                                       
                                        <td scope="col" style="text-align:center">Ganti Foto Sampul</td></a>
                                    </tr>
                                    <tr>
                                         <td>
                                            <label for="inputUsername" class="col-sm-5 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="inputUsername" placeholder="Enter Username">
                                            </div>
                                        </td>
                                        <td>
                                            <label for="inputPassword" class="col-sm-5 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                            <input type="password" class="form-control form-control-sm" name="inputPassword" placeholder="Enter Password">
                                            <br>
                                            <button data-toggle="modal" class="btn btn-sm btn-primary" data-target="#Ubah"><span class="glyphicon glyphicon-user"></span>Ubah</a></button>

                                            <!-- Modal daftar -->
                                            <div id="Ubah" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                <table>
                                                    <p scope="col" style="text-align:center">Ubah Password</p>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                <div class="form-group">
                                                <label for="exampleInputEmail1">Password Lama</label>
                                                <input type="Password" class="form-control" id="Password Lama" placeholder="********">
                                                </div>
                                                <div class="form-group">
                                                <label for="exampleInputEmail1">Password Baru</label>
                                                <input type="password" class="form-control" id="Password Baru" placeholder="********">
                                                </div>
                                                <div class="form-group">
                                                <label for="exampleInputEmail1">Konfirmasi Password</label>
                                                <input type="password" class="form-control" id="Konfirmasi Password" placeholder="********">
                                                </div>
                                            </form>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Simpan</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            </table>
                                            <!-- end modal daftar -->
                                        </td>                              
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="inputEmail" class="col-sm-5 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="inputEmail" placeholder="Enter Email">
                                            </div>                     
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>
                                            <label for="inputTentangSsaya" class="col-sm-5 col-form-label">Tentang Saya</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="inputTentangSaya"  >
                                            </div>
                                        </td>
                                        <td>
                                            <label for="inputWebsite" class="col-sm-5 col-form-label">Website</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="inputWebsite" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="inputLokasi" class="col-sm-5 col-form-label">Lokasi</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="inputLokasi" >
                                            </div>
                                        </td>    
                                    </tr>
                                                                       
                            </table>
                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Simpan</button>
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