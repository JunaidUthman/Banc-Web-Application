<?php
require_once ("class_compte.php");
class compte_chequier extends compte{

    public static $type="chequier"; 
    public function creer_compte(){
        $rib=compte::creer_compte();

            $file = "data.json";

            $data = [];
            if (file_exists($file)) {
                $jsonData = file_get_contents($file);
                $data = json_decode($jsonData, true); 
            }

            foreach($data as &$d){
                if($rib == $d["RIB"]){
                    $d["type"]=self::$type;
                    break;
                }
            }

            $jsonData = json_encode($data, JSON_PRETTY_PRINT);

            if (file_put_contents($file, $jsonData)) {
                //echo "Données enregistrées dans le fichier JSON avec succès !";
                return $rib;
            } else {
                echo "Erreur lors de l'écriture dans le fichier.";
            }

    }

    public function retirer($somme){
        // Chemin du fichier JSON
        $file = "data.json";

        // Initialiser le tableau `$data` en lisant le fichier existant ou en le créant vide
        $data = [];
        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $data = json_decode($jsonData, true); // Convertir JSON en tableau PHP
        }

        // Ajouter une nouvelle ligne de données
        foreach($data as &$d){
        if($d["RIB"]==$this->rib){
            if($somme <= $d["Solde"]){
                $d["Solde"]= $d["Solde"] - $somme - $somme*0.1;
                // Convertir le tableau `$data` en JSON
                $jsonData = json_encode($data, JSON_PRETTY_PRINT);

                // Écrire les données mises à jour dans le fichier
                if (file_put_contents($file, $jsonData)) {
                    //echo "Données enregistrées dans le fichier JSON avec succès !";
                } else {
                    //echo "Erreur lors de l'écriture dans le fichier.";
                }
                return 1;
        }
        else{
            echo "votre solde est insuffisant"."<br>";
            echo '<a href="programme_compte.php">retourner au menue</a>';
            exit;
        }
            }
        }
        return 0;

        
    }

    public function getnom(){
        return $this->fullname;
    }
    public function getsolde(){
        return $this->solde;
    }
}


?>