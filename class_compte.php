<?php
    class compte{
       protected $fullname;
       protected $solde;
       protected $rib;
       protected $email;
       protected $password;

        public function __construct($email1 , $password1 ,$fullname1, $solde1 , $rib=NULL) {
            $this->email=$email1;
            $this->password = $password1;
            $this->fullname = $fullname1;
            $this->solde = $solde1;
            $this->rib = $rib;
        }

    public function creer_compte(){

        // Chemin du fichier JSON
        $file = "data.json";

        // Initialiser le tableau `$data` en lisant le fichier existant ou en le créant vide
        $data = [];
        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $data = json_decode($jsonData, true); // Convertir JSON en tableau PHP
        }

        // Ajouter une nouvelle ligne de données
        $rib = uniqid();
        $solde=floatval($this->solde);
        $newEntry = [
            "email"=> $this->email,
            "password"=>$this->password,
            "RIB" => $rib,
            "Nom" => $this->fullname,
            "Solde" => $solde
        ];
        $data[] = $newEntry;

        // Convertir le tableau `$data` en JSON
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        // Écrire les données mises à jour dans le fichier
        if (file_put_contents($file, $jsonData)) {
            //echo "Données enregistrées dans le fichier JSON avec succès !";
            return $rib;
        } else {
            echo "Erreur lors de l'écriture dans le fichier.";
        }

    }
    
    public function deposer($somme){
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
               $d["Solde"]+=$somme;
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
           
        }
        return 0;
        
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
            $d["Solde"]-=$somme;
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
}
?>