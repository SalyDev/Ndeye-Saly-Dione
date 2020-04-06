<?php
             session_start();
             $_SESSION["nom"][]=$_SESSION["prenom"][]=$_SESSION["adresse"][]=$_SESSION["genre"][]=$_SESSION["satisfy"][]=$_SESSION["langue"][]=$_SESSION["numero"][]="";
             $nom=$prenom=$adresse=$genre=$numero=$confirm=$comment=$satisfy=$ereur1=
             $ereur2=$ereur3=$ereur4=$ereur5=$ereur6=$ereur7=$ereur8=
             $ereur="";
            require "fonction.php";
            $comment=$langues=[];
            if(isset($_POST["submit"])){
                //verification du nom
                if(empty($_POST["nom"])){
                    $ereur1 = "Donnez donner votre nom.";
                }
                else{
                    if(!validNom($_POST["nom"])){
                        $ereur1 = "Nom invalide !";
                    }
                    else{
                        $nom=$_POST["nom"];
                      
                    }
                }
                //verification de prenom
                if(empty($_POST["prenom"])){
                        $ereur2 = "Donnez votre prenom.";
                    }
                else{
                        if(!validNom($_POST["prenom"])){
                            $ereur2 = "Prenom invalide !";
                        }
                        else{
                            $prenom=$_POST["prenom"];
                        }
                }
                //verification de l'adresse
                if(empty($_POST["adresse"])){
                    $ereur3 = "Donnez votre adresse.";
                }
                else{
                    if(strlen($_POST["adresse"])<5){
                        $ereur3 = "Adresse invalide !";
                    }
                    else{
                        $adresse = $_POST["adresse"];
                    }
                }
                //verification du numero de telephone
                if(empty($_POST["numero"])){
                    $ereur4 = "Donnez votre numero.";
                }
                else{
                    if(!validNumero($_POST["numero"])){
                        $ereur4 = "Numero invalide !";
                    }
                    else{
                        $numero=$_POST["numero"];
                    }
                }
                //verification que le numero initial et le numero confirme
                //sont identiques
                if(empty($_POST["confirm"])){
                    $ereur5 = "Confirmez votre numero.";
                }
                else{
                    if($_POST["confirm"]!=$_POST["numero"]){
                        $ereur5 = "Numeros non identiques !";
                    }
                    else{
                        $confirm = $_POST["confirm"];
                    }
                }
                //verification du choix de genre
                if($_POST["genre"]==""){
                    $ereur6 = "Veuillez choisir votre genre.";
                }
                else{
                  $genre = $_POST["genre"];
                }
                //recuperer la valeur de satisfy
                if(empty($_POST["satisfy"])){
                        $ereur = "Reponsez par oui ou non.";
                }
                        else{
                    $satisfy = $_POST["satisfy"];
                }
                //on doit avoir au moins 2 choix pour la langue
                $langues=[];
                for($i=1;$i<=4;$i++){
                if(!empty($_POST['langue'.$i])){
                    $langues[]=$_POST['langue'.$i];
                }
                }
                if(count($langues)<2){
                    $ereur7 = "Veuillez choisir au minimum deux langues.";
                }
                if(!empty($_POST["comment"])){
                    $comment = splitPhrase($_POST["comment"]);
                    if(count($comment)<3){
                        $ereur8 = "Commentez au moins avec trois phrases.";
                    }
                }
            }
         if(!empty($nom) && !empty($prenom) && !empty($adresse) &&(!empty($satisfy)) && ($numero==$confirm) && (count($langues)>=2) && (count($comment)>=3)){
            array_push($_SESSION["nom"],$nom);
            array_push($_SESSION["prenom"],$prenom);
            array_push($_SESSION["adresse"],$adresse);
            array_push($_SESSION["numero"],$numero);
            array_push($_SESSION["genre"],$genre);
            array_push($_SESSION["satisfy"],$satisfy);
            array_push($_SESSION["langue"],$langues);
         }
        ?>

<!DOCTYPE html>
    <head>
        <title>index</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="main">
        <form method="POST">
            <div class="champs">Nom<input class="input" type="text" name="nom" value="<?=$nom?>"><span class="ereur style3"><?php echo $ereur1?></span></div> 
            <div class="champs">Prenom<input class="input" type="text" name="prenom" value="<?=$prenom?>"><span class="ereur style3"><?php echo $ereur2 ?></span></div> 
            <div class="champs">Adresse<input class="input" type="text" name="adresse" value="<?=$adresse?>"><span class="ereur style3"><?php echo $ereur3 ?></span></div> 
            <div class="champs">Numero de telephone <input class="input" type="text" name="numero" value="<?=$numero?>"><span class="ereur style3"><?php echo $ereur4 ?></span></div> 
            <div class="champs style1">Confirmation du numero<input class="input" type="text" name="confirm" value="<?=$confirm?>"><span class="ereur style3"><?php echo $ereur5 ?></span></div> 
            <div class="genre style1">Genre : <select name="genre">
                            <option value=""></option>
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                        </select>
                        <span class="ereur"><?php echo $ereur6?></span>
            </div>
            <div class="satisfait style1">Satisfait :  <span class="ereur"><?php echo '  '.$ereur?></span>
                    <div class="choix style2"><input type="radio" name="satisfy" value="oui"> Oui </div>
                    <div class="choix style2"><input type="radio" name="satisfy" value="non"> Non </div>
            </div>
            <div class="style1">Langues : <span class="ereur"><?php echo '  '.$ereur7 ?></span>
                <div class="choix style1 style2">
                <div><input type="checkbox" name="langue1" value="Francais"> Francais</div>
                <div><input type="checkbox" name="langue2" value="Anglais"> Anglais </div>
                <div><input type="checkbox" name="langue3" value="Espagnol"> Espagnol </div>
                <div><input type="checkbox" name="langue4" value="Portugais"> Portugais</div>
            </div>
            <div class="style1"> 
            Commentaire
            <div><textarea class="area" name="comment" cols="60" rows="10"></textarea><div class="ereur"><?php echo $ereur8?></div></div>
            <div><input type="submit" name="submit" value="Valider" class="submit">
           <input type="reset" name="reset" value="Reinitialiser" class="reset"></div>
            </div>
        </form>
       
        <?php
        if(!empty($_POST["nom"])){
        ?>
        <table id="id_table">
              <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Adresse</th>
                    <th>Numero</th>
                    <th>Genre</th>
                    <th>Satisfait</th>
                    <th>Langue</th>
                </tr>
        </thead>
        <tbody>
            <?php
                $k=0;
                for($i=0;$i<count($_SESSION["nom"]);$i++){
                    if(!empty($_SESSION["nom"][$i])){
                        $k++;
                        if($k%2==0){
                            $style="pair";
                        }
                        else{
                            $style="impair";
                        }
                    ?>
                    <tr class="<?php echo $style?>">
                        <td><?php echo $_SESSION["nom"][$i]?></td>
                        <td><?php echo $_SESSION["prenom"][$i]?></td>
                        <td><?php echo $_SESSION["adresse"][$i]?></td>
                        <td class="num"><?php echo $_SESSION["numero"][$i]?></td>
                        <td><?php echo $_SESSION["genre"][$i]?></td>
                        <td><?php echo $_SESSION["satisfy"][$i]?></td>
                        <td>
                        <?php 
                        if(!empty($_SESSION["langue"][$i])){
                            for($j=0;$j<count($_SESSION["langue"][$i]);$j++){
                                    echo $_SESSION["langue"][$i][$j][0];
                                    if(isset($_SESSION["langue"][$i][$j+1])){
                                        echo ',';
                                    }
                            }
                        }
                    }
                        ?>
                    </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
            </table>
     <?php
        }
     ?>
     </div>
    </body>
</html>

			