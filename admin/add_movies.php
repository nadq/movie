
<?php
require_once 'header.php';

$name = "";
$summary = "";
$year = "";
$country = "";
$duration = "";
$quality = "";
$rating = "";
$sql = "";
$errors =[];



if(isset($_POST['submit'])){
    
    if(!mb_strlen($_POST['name'])){
        $errors[] = 'Please enter some movie name';
        
     }else if(mb_strlen($_POST['name']) > 64){ 

        $errors[] = 'between 0 and 64 symbols';
    }else{
        $name = trim($_POST['name']);
    }

    if(!mb_strlen($_POST['summary'])){
        $errors[] = 'Please Enter summary';
    
    }else{
        $lastName = trim($_POST['summary']);
    }

    if(!mb_strlen($_POST['year'])){
        $errors[] = 'Please enter year';
        
     }else if(mb_strlen($_POST['year']) > date('Y', time())){ 

        $errors[] = 'enter valid year';
    }else{
        $name = trim($_POST['year']);
    }
    if(!mb_strlen($_POST['country'])){
        $errors[] = 'Please Enter country';
    
    }else{
        $lastName = trim($_POST['country']);
    }

    if(!mb_strlen($_POST['duration'])){
        $errors[] = 'Please Enter duration';
    
    }else{
        $lastName = trim($_POST['duration']);
    }
    if(!mb_strlen($_POST['quality'])){
        $errors[] = 'Please Enter quality';
    
    }
    else{
        $lastName = trim($_POST['quality']);
    }

    if(!mb_strlen($_POST['rating'])){
        $errors[] = 'Please Enter rating';
    
    }else{
        $lastName = trim($_POST['rating']);
    }


}else{
                 
    if(!count($errors)){ 
       // $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = " INSERT INTO `".TABLE_MOVIES."`
        (
            `name`,
            `summary`,
            `year`,
            `country`,
            `duration`,
            `quality`,
            `rating`
        )VALUES(
            '".mysqli_real_escape_string($conn,$name)."',
            '".mysqli_real_escape_string($conn,$summary)."',
            '".mysqli_real_escape_string($conn,$year)."',
            '".mysqli_real_escape_string($conn,$country)."',
            '".mysqli_real_escape_string($conn,$duration)."',
            '".mysqli_real_escape_string($conn,$quality)."',
            '".mysqli_real_escape_string($conn,$rating)."',
            NOW(),
            NOW()
        )
        ";
    }  
    
}
   

function ShowArray($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}











?>


<div class = "container-fluid">
    <form method ="post">

        <p>Name:</p>
        <input type="text" name="name" value="<?=$name?>"/>
        <p>Summary:</p>
        <input type="text" name="summary" value="<?=$summary?>"/>
        <p>Year:</p>
        <input type="number" name="year" value="<?=$year?>"/>
        <p>Country:</p>
        <input type="text" name="country" value="<?=$country?>"/>
        <p>Duration:</p>
        <input type="number" name="duration" value="<?=$duration?>"/> 
        <p>Quality:</p>
        <input type="text" name="quality" value="<?=$quality?>"/>
        <p>Rating:</p>
        <input type="text" name="rating" value="<?=$rating?>"/>
        
        <br>
        <button type="submit" name="submit"> Send</button>


    </form>
    <br>

<?php


if(isset($_POST['n'])){
    $dir = '../images/';
    
    $name=$dir.basename($_FILES['images']['name']);
    $getType = mime_content_type($_FILES['images']['tmp_name']); 
    //Show($errors);

    if(file_exists($name)){
        $errors[]='File exists alredy';
    }
    if($_FILES['images']['size']>250000){
        $errors[] = 'Your file is over 25MB';
    }
    if($getType =='images/png' && $getType =='images/svg'){
        $errors[]='We don`t support ".svg" and ".png" ';
    }
    if(!count($errors)){
        if(move_uploaded_file($_FILES['images']['tmp_name'],$name)){
            echo 'ok';
        }else{
            Show($errors);
        }
    }
    

}

?>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type ="file" name="images">
        <br>
        <button type = "submit" name="n">Uppload img</button>
    </form>
</div>
<div>
        <ul>
            <?php if(isset($errors) && count($errors)) :?>
            <?php for($i = 0; $i < count($errors) ;$i++) :?>
            <li> <?=$errors[$i];?> </li>
            <?php endfor ?>
            <?php endif ?>
        </ul>
    </div>
<?php
require_once 'footer.php';

?>