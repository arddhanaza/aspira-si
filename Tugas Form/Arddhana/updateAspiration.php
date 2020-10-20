<?php
$data = array(
    array('idAspirasi' => 1, 'pengirim' => 'Arddhana Zhafran', 'angkatan' => 2018, 'aspirasiText' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam autem consequuntur
                                doloremque expedita magnam, obcaecati optio pariatur quibusdam quod ratione, sunt
                                temporibus voluptate voluptatibus? Consequuntur debitis ipsum maxime quod veniam!', 'tujuan' => 'Lab daspro', 'filePendukung' => 'Tidak Ada File', 'tanggal' => '20/10/2020', 'status' => 'Belum Diproses'),
    array('idAspirasi' => 2, 'pengirim' => 'Nana', 'angkatan' => 2018, 'aspirasiText' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam autem consequuntur
                                doloremque expedita magnam, obcaecati optio pariatur quibusdam quod ratione, sunt
                                temporibus voluptate voluptatibus? Consequuntur debitis ipsum maxime quod veniam!', 'tujuan' => 'Lab EDE', 'filePendukung' => 'Tidak Ada File', 'tanggal' => '19/10/2020', 'status' => 'Process')
);
if (isset($_POST['statusUpdate'])) {
    $row = $_POST['rowData'];
    $idAspirasi = $_POST['idAspirasi'];
    $statusUpdated = $_POST['statusUpdate'];
    $data[$row]['status'] = $statusUpdated;
}
?>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
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
                    <a class="nav-link" href="#">Feed <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">All Aspiration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Announcement</a>
                </li>
                <li class="nav-item font-weight-bold ml-5">
                    <a class="nav-link" href="#">BPM-SI</a>
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
            <div class="card aspiration-card-table">
                <div class="card-body table-responsive">
                    <table class="table table-striped datTable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengirim</th>
                            <th>Angkatan</th>
                            <th>Aspirasi</th>
                            <th>Tujuan</th>
                            <th>File Pendukung</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for ($row = 0; $row < count($data); $row++) {
                            echo '
                            <tr>
                                <td>' . $data[$row]['idAspirasi'] . '</td>
                                <td>' . $data[$row]['pengirim'] . '</td>
                                <td>' . $data[$row]['angkatan'] . '</td>
                                <td>' . $data[$row]['aspirasiText'] . '
                                </td>
                                <td>' . $data[$row]['tujuan'] . '</td>
                                <td>' . $data[$row]['filePendukung'] . '</td>
                                <td>' . $data[$row]['tanggal'] . '</td>
                                <td>' . $data[$row]['status'] . '</td>
                                <td>
                                    <button class="btn btn-primary mb-2" disabled>Detail</button>
                                    <button class="btn btn-outline-info mb-2" data-toggle="modal"
                                            data-target="#modalUpdate' . $row . '">Update
                                    </button>
                                    <button class="btn btn-outline-danger mb-2" disabled>Delete</button>
                                </td>
                            </tr>
                            ';
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--End of Aspiration Card-->
</section>

<?php
for ($row = 0; $row < count($data); $row++) {
    echo '
    <div class="modal fade" id="modalUpdate' . $row . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Status: <span class="badge badge-pill badge-secondary">' . $data[$row]['status'] . '</span></h6>
                <hr>
                <form action="updateAspiration.php" method="post">
                    <input type="hidden" name="rowData" value="' . $row . '">
                    <input type="hidden" name="idAspirasi" value="' . $data[$row]['idAspirasi'] . '">
                    <div class="form-group">
                        <label for="statusUpdate">Status Update</label> <br>';

    if ($data[$row]['status'] == 'Belum Diproses') {
        echo '
        <select name="statusUpdate" id="statusUpdate"
                class="update-selection btn btn-sm btn-outline-dark btn-block btn-lg">
            <option value="' . $data[$row]['status'] . '" selected disabled>' . $data[$row]['status'] . '</option>
            <option value="Di Tinjau">Di Tinjau</option>
            <option value="Process">Process</option>
            <option value="Diteruskan">Diteruskan</option>
            <option value="Done Resolved">Done Resolved</option>
        </select>
        ';
    } elseif ($data[$row]['status'] == 'Di Tinjau') {
        echo '
        <select name="statusUpdate" id="statusUpdate"
                class="update-selection btn btn-sm btn-outline-dark btn-block btn-lg">
            <option value="' . $data[$row]['status'] . '" selected disabled>' . $data[$row]['status'] . '</option>
            <option value="Process">Process</option>
            <option value="Diteruskan">Diteruskan</option>
            <option value="Done Resolved">Done Resolved</option>
        </select>
        ';
    } elseif ($data[$row]['status'] == 'Process') {
        echo '
        <select name="statusUpdate" id="statusUpdate"
                class="update-selection btn btn-sm btn-outline-dark btn-block btn-lg">
            <option value="' . $data[$row]['status'] . '" selected disabled>' . $data[$row]['status'] . '</option>
            <option value="Diteruskan">Diteruskan</option>
            <option value="Done Resolved">Done Resolved</option>
        </select>
        ';
    } elseif ($data[$row]['status'] == 'Diteruskan') {
        echo '
        <select name="statusUpdate" id="statusUpdate"
                class="update-selection btn btn-sm btn-outline-dark btn-block btn-lg">
            <option value="' . $data[$row]['status'] . '" selected disabled>' . $data[$row]['status'] . '</option>
            <option value="Done Resolved">Done Resolved</option>
        </select>
        ';
    } else {
        echo '
        <select name="statusUpdate" id="statusUpdate"
                class="update-selection btn btn-sm btn-outline-dark btn-block btn-lg">
            <option value="' . $data[$row]['status'] . '" selected disabled>' . $data[$row]['status'] . '</option>
        </select>
        ';
    }
    echo '
                    </div>
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    ';
}
?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script src="../../assets/js/dataTable.js"></script>
</body>
</html>