<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
        exit;
    }
    require_once("conn.php");
    $sql = "SELECT * FROM produit";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Sales management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  
<link rel="stylesheet" href="CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Roboto', sans-serif;
}

</style>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Products <b>Details</b></h2></div>
                    <div class="col-sm-2">
                        <?php
                            if($_SESSION['login'][2] == "administrateur"){
                                ?>
                                    <div style="margin-top: 0;" class="row container d-flex justify-content-center"> <button type="button" onclick="annimation()" id="animatebutton" class="btn btn-info btn-icon-text animatebutton" style="color: white; font-weight: bold;">  New Product </button> </div>
                                    
                                
                                <?php
                            }
                        ?>
                    </div>
                    <div class="col-sm-2">
                        <div style="margin-top: 0;" class="row container d-flex justify-content-center"> 
                            <button type="button" id="animatebutton" class="btn btn-warning btn-block mb-2" style="font-weight: bold;"  data-toggle="modal" data-target="#modal-backdrop-dark">Disconnection </button> 
                            <div id="modal-backdrop-dark" class="modal bg-dark fade" data-backdrop="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title text-md"></div>
                                            <button class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="p-4 text-center">
                                                <p>Do you really want to disconnect?</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer"><button type="button" class="btn btn-light" data-dismiss="modal">Close</button> <button type="button" onclick="deconnexion()" class="btn btn-danger" data-dismiss="modal">Disconnect</button></div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Product photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?=$row['refPdt']?></td>
                                <td><?=$row['libPdt']?></td>
                                <td><?=$row['prix']?></td>
                                <td><?=$row['qte']?></td>
                                <td><?=$row['description']?></td>
                                <td><?=$row['type']?></td>
                                <td><img src="Images/<?=$row['image']?>" width="80px" alt=""></td>
                                <td>
                                    <a href="#"  class="view" title="View" data-toggle="modal" data-target="#modal-view<?=$row['refPdt']?>"><i class="material-icons">&#xE417;</i></a>
                                    <div class="modal bg-dark fade" id="modal-view<?=$row['refPdt']?>" data-backdrop="false">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <?php
                                            $ref = $row['refPdt'];
                                            $sql2 = "SELECT * FROM produit WHERE refPdt = '$ref'";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $row2 = mysqli_fetch_assoc($result2);
                                        ?>
                                            <!-- Modal Header -->
                                            <div class="modal-header"  style="text-align: center;">
                                            <h4 class="modal-title"><?=$row2['libPdt']?></h4>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="container">
                                                <h6>Item Details</h6>
                                                <div class="row">
                                                    <div class="col-5">
                                                    <img width="250px" class="img-fluid" src="Images/<?=$row2['image']?>">
                                                    </div>
                                                    <div class="col-7" style="padding-top: 2vh;">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <ul type="none"  style="font-weight:bold;">
                                                                    <li>Price: </li>
                                                                    <li>Quantity: </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-8">
                                                                <ul type="none" >
                                                                    <li> <?=$row2['prix']?> Dhs</li>
                                                                    <li><?=$row['qte']?> pieces</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <h6>Order Details</h6>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <ul type="none"  style="font-weight:bold;">
                                                            <li class="left">Product type:</li>
                                                            <li class="left">Description:</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-8">
                                                        <ul class="right" type="none">
                                                            <li class="right"><?=$row2['type']?></li>
                                                            <li class="right"><?=$row2['description']?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer" style="text-align:center;">
                                                <button type="button" data-dismiss="modal" class="section2_btn btn6">Back</button>
                                            </div>
                                           
                                        </div>
                                        
                                        </div>
                                    </div>
                                    <?php
                                        if($_SESSION['login'][2] == "administrateur"){
                                            ?>
                                            <a href="modifier.php?ref=<?php echo htmlspecialchars($row['refPdt'], ENT_QUOTES); ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                            <a href="" class="delete" title="Delete"  data-toggle="modal" data-target="#modal-delete<?=$row['refPdt']?>"><i class="material-icons">&#xE872;</i></a>
                                            <div id="modal-delete<?=$row['refPdt']?>" class="modal bg-dark fade" data-backdrop="false">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="modal-title text-md"></div>
                                                            <button class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="p-4 text-center">
                                                                <p>Do you really want to delete this product?</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"><button type="button" class="btn btn-light" data-dismiss="modal">Close</button> <button type="button" onclick="deleteBtn('<?php echo htmlspecialchars($row['refPdt'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($row['image'], ENT_QUOTES); ?>')" class="btn btn-danger" data-dismiss="modal">Delete</button></div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <?php
                                        }
                                    ?>
                                    
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>  



<script src="JS/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>