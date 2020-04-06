<?php
    //fonction qui teste si un nom ou un prenomest valide
    function validNom($nom){
        $regex = '#^[A-Z][a-z]+(([ ][A-Z][a-z]+)+)?$#';
        return preg_match($regex, $nom);
    }

    //fonction qui teste si un numero est valide
    //le numero peut commencer par 77, 70, 76 ou 76 suivi ou pas de. / ou-
    //suivie de 3 chiffres suivie ou pas de . / ou -
    //suivi de 2 chiffres suivi ou pas de . / ou - repete 2 fois
    function validNumero($numero){
        $regex = '#^(77|70|76|75)[ ./-]?[0-9]{3}([ ./-]?[0-9]{2}){2}$#';
        return preg_match($regex,$numero);
    }

    //fonction qui teste decoupe un texte en phrase et teste si les phrases
    //sont valides
    function splitPhrase($texte){
        //le regex signifie tt ce qui commence par une lettre minuscule ou majuscule suivi
        //de tt autre caractere different de . ? et ! ou de . suivi de chiffre 0 ou plusieurs fois
        //termine par . ! ou ?
        //cette fonction retourne un tableau contenant les phrases corriges
        $tableau=[];
        preg_match_all('#[A-Za-z]([^.!?]|[.][0-9])*[.!?]#',$texte,$texteCoup);
        $lesPhrases = $texteCoup[0];
        foreach($lesPhrases as $phrase){
            $phrase=trim($phrase);
            //les expessions qu'on doit remplacer
            $regex=['#[ ]+#', '#[ ]?[\'][ ]?#', '#[ ]?[,]#', '#[ ]?[;][ ]?#', '#[(][ ]+#','#[ ]+[)]#',
                    '#[ ]+[.]#', '#[ ]+[?]#', '#[ ]+[!]#'];
            //leurs remplacants
            $remplace=[' ', "'", ", ", "; ", "(", ")", ".", "?", "!"];
            for($j=0;$j<count($regex);$j++){
                $phrase = preg_replace($regex[$j],$remplace[$j],$phrase);
            }
            //remplace une apostrophe entre espaces par juste une apostrophe suivi d'un espace
            $phrase=str_replace(" ’ ", "’ ", $phrase);
                $phrase=ucfirst($phrase);
            $tableau[] = $phrase;
    }
    return $tableau;
}
   
?>