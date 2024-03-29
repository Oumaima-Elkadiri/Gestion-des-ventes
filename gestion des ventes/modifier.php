<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
        exit;
    }
    $ref = $_GET['ref'];
    require_once("conn.php");
    $sql = "SELECT * FROM produit WHERE refPdt = '$ref'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales management</title>
    <link rel="stylesheet" href="CSS/ajouter.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<style>
    body{
        background: #2962FF;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<body>
    
<div class="container d-flex justify-content-center">
	<div class="card mx-5 my-5">
		<div class="card-body px-2">
			<h2 class="card-heading px-3">Edit the product</h2>
            <div class="row">
                <div class="col-4">
                    <img width="120px" src="Images/<?=$row['image']?>" alt="">
                </div>
                <div class="col-8">
                    <br>
                    <h5 class="card-subheading px-3 pb-3"><?=$row['libPdt']?>.</h5>
                </div>
            </div>
			<form action="" method="POST"  enctype="multipart/form-data">
                <div class="row rone">
                    <div class="col-md-1"></div>
                    <div class="form-group col-md-4 fone">
                        <!-- Référence -->
                        <input type="text" name="reference" value="<?=$row['refPdt']?>" class="form-control" placeholder="Product reference" disabled>
                    </div>
                    <div class="form-group col-md-4 ftwo">
                        <!-- Libellé -->
                        <input type="text" name="libelleP" value="<?=$row['libPdt']?>" class="form-control ml-3" placeholder="Product wording" required>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row rthree" style="margin-top: 20px;">
                    <div class="col-md-1"></div>
                    <div class="form-group col-md-4 ffour">
                        <!-- prix -->
                        <input type="text" oninput="getPrix()" value="<?=$row['prix']?>" id="prix" name="prix" class="form-control" placeholder="Price (DH)" required>
                    </div>
                    <div class="form-group col-md-4 ffive">
                        <!-- quantité -->
                        <input type="number" name="quantite" value="<?=$row['qte']?>" min="1" class="form-control ml-3" placeholder="Quantity" required>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row rtwo">
                    <div class="col-md-1"></div>
                    <div class="form-group col-md-10 fthree">
                        <!-- Description -->
                        <textarea name="description" class="form-control" placeholder="Description"  maxlength="200" required><?=$row['description']?></textarea>
                        <small class="text-muted"><p class="para1 pt-2 pl-1">Do not exceed 200 characters.</p></small>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row rthree">
                    <div class="col-md-1"></div>
                    <div class="form-group col-md-5 fthree">
                        <!-- Type -->
                        <select name="type" class="form-control" required>
                            <option value="">Type of product</option>
                            <?php
                                $sql2 = "SELECT * FROM type_produit";
                                $result2 = mysqli_query($conn, $sql2);
                                while($row2 = mysqli_fetch_array($result2)){
                                    if($row['type'] == $row2['type']){
                                        ?>
                                        <option value="<?=$row2['type']?>" selected><?=$row2['type']?></option>
                                        <?php
                                    }else{
                                        ?>
                                        <option value="<?=$row2['type']?>"><?=$row2['type']?></option>
                                        <?php
                                    }
                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <!-- image -->
                        <input type="file" name="picture" class="form-control" accept="image/*"  placeholder="Product picture">
                        <small class="text-muted"><p class="para1 pt-2 pl-1">Current Image: <?=$row['image']?></p></small>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row rfour">
                    <div class="col-md-1"></div>
                    <div class="col-md-4 ml-3">
                        <!-- button -->
                        <button type="submit" id="edite" name="edite" class="btn btn-primary mt-3"><span>Edite</span></button>
                    </div>
                    
                    <div class="col-md-5">
                        <a href="produits.php" id="back" class="btn btn-light mt-3" style="width: 120px; font-weight: bold; background: #d1d2d3;"><span>Back</span></a>
                    </div>
                </div>
                <div class="row rfour">
                    <div class="col">
<?php
    if(isset($_POST['edite'])){
        $libelle = $_POST['libelleP'];
        $prix = $_POST['prix'];
        $quantite = $_POST['quantite'];
        $description = $_POST['description'];
        $type = $_POST['type'];
            if(isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK){
                // Vérifier si un fichier a été téléchargé
                    $image_tmp_name = $_FILES['picture']['tmp_name'];
                    $image_name = $_FILES['picture']['name'];
                    
                    // Déplacer le fichier téléchargé vers le dossier souhaité
                    $upload_directory = 'images/';
                    
                    // Générer un nouveau nom pour l'image
                    $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                    $new_image_name = uniqid().'.'.$extension;
                    
                    // Déplacer le fichier avec le nouveau nom
                    if(move_uploaded_file($image_tmp_name, $upload_directory.$new_image_name)) {
                        $picture = $new_image_name;

                        $chemin_complet = $upload_directory . $row['image'];
                        if (file_exists($chemin_complet)) {
                            unlink($chemin_complet);
                        }
                    }
            }else{
                $picture = $row['image'];
            }
            
            $sql = "UPDATE produit
            SET libPdt = '$libelle', prix = '$prix', qte = '$quantite', description ='$description', image = '$picture', type = '$type'
            WHERE refPdt = '$ref'";
            if(mysqli_query($conn,$sql)){
                echo '<p class="para2"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                <path d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z"/>
            </svg> The product is well modified.</p>';
            }
        
    }
?>
                    </div>
                </div>
			</form>
		</div>
	</div>
</div>

    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/script.js"></script>
</body>
</html>
