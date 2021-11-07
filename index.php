<?php
/**
 * host
 * user
 * password
 * datbase name
 */
    // connection to databasse
    $host = 'localhost';
    $user ="root";
    $password ="";
    $dbName = "crud";

    $con = mysqli_connect($host,$user,$password,$dbName);
        if(isset($_POST['send'])){
            $name = $_POST['username'];
            $salary = $_POST['salary'];

            $insert = "INSERT INTO users VALUES(NULL,'$name',$salary)";
            $i = mysqli_query($con,$insert);

        }
    $select = "SELECT * FROM users";
    $s = mysqli_query($con,$select);
    ############### update
    $name = "";
    $salary = "";
    $update = false;
     if(isset($_GET['edit'])){
         $update = true;
         $id= $_GET['edit'];
         $select = "SELECT * FROM users WHERE id = $id";
         $ss = mysqli_query($con , $select);
         $row = mysqli_fetch_assoc($ss);
         $name = $row['name'];
         $salary = $row['salary'];



         if(isset($_POST['update'])){
            $name = $_POST['username'];
            $salary = $_POST['salary'];
             $update = "UPDATE users SET name= '$name' , salary =$salary WHERE id = $id";
             $u = mysqli_query($con,$update);
             if($u){
                 echo "true update";
                header('location:/crud/index.php'); 
             }else{
                 echo" wrong";
             }
            
         }
     }
######## delet
if(isset($_GET['delet'])){
    $id = $_GET['delet'];
    $delete = "DELETE FROM users WHERE id = $id";
    $d = mysqli_query($con , $delete);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="/CRUD/index.css">
</head>
<body>
    <div class="container  text-center col-md-6 mt-3">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for=""> user name</label>
                        <input type="text" value ="<?php echo $name?>" name="username" placeholder="user name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for=""> salary</label>
                        <input type="text" value ="<?php echo $salary?>" name="salary"  placeholder="salary" class="form-control">
                    </div>
                    <?php if($update) : ?>
                    <button class="btn btn-primary" name="update"> update data</button>
                    <?php else : ?>
                    <button class="btn btn-info" name="send"> send data</button>
                    <?php endif ?>
                    
                  
                </form>
            </div>
        </div>
    </div>
    <div class="container  text-center col-md-6 mt-3">
        <div class="card">
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>SALARY</th>
                        <th>ACTION</th>
                    </tr>
                    <?php foreach($s as $data){ ?>
                    <tr>
                        <th><?php echo $data['id'] ?></th>
                        <th><?php echo $data['name'] ?></th>
                        <th><?php echo $data['salary'] ?></th>
                        <th><a class="btn btn-primary" href="/crud/index.php?edit=<?php echo $data['id'] ?>"> EDIT </a> </th>
                        <th><a class="btn btn-danger" href="/crud/index.php?delet=<?php echo $data['id'] ?>"> remove </a> </th>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
