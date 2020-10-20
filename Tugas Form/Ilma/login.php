<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row ">
            <div class="col-md-6">
                <h3>ASPIRA <br> -SI</h3>                
                <form>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control shadow p-3 mb-1 bg-white rounded" id="nim" name="inputNim" >                        
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control shadow  mb-1 bg-white rounded" id="password" name="inputPassword">
                    </div>                    
                    <button type="submit" class="btn btn-primary shadow p-3 mb-5 rounded">LOGIN</button>

                </form>                
            </div>

            <div class="col-md-6">
                <img src="../../assets/img/icon.png" alt="coba">
            </div>
        </div>
    </div>
</body>
</html>