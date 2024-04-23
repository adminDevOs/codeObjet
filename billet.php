<?php

class GestionEvenements {
    private $evenements = array();

    public function __construct() {
        // Initialisation des événements
        $this->evenements[] = new Evenement("Conférence sur l'Intelligence Artificielle", "2024-05-15", "Centre des Congrès");
        $this->evenements[] = new Evenement("Concert Symphonique", "2024-06-20", "Salle de Concert Principal");
        $this->evenements[] = new Evenement("Conférence sur le système DevOps", "2024-05-15", "Centre des Congrès");
        $this->evenements[] = new Evenement("Concert des Étoiles", "2024-07-10", "Galaxie Nova");
    }

    public function creerEvenement($nom, $date, $lieu) {
        $evenement = new Evenement($nom, $date, $lieu);
        $this->evenements[] = $evenement;
        return $evenement;
    }

    public function supprimerEvenement($index) {
        if (isset($this->evenements[$index])) {
            unset($this->evenements[$index]);
            return true;
        }
        return false;
    }

    public function getEvenements() {
        return $this->evenements;
    }

    public function acheterBillet($index, $type) {
        if (isset($this->evenements[$index])) {
            // Ici, vous pouvez ajouter la logique pour acheter le billet du type spécifié pour l'événement donné.
            // Par exemple, enregistrez l'achat dans une base de données ou envoyez une confirmation par e-mail.
            return true; // Succès de l'achat
        }
        return false; // Événement non trouvé
    }

    public function echangerBillet($index, $ancienType, $nouveauType) {
        if (isset($this->evenements[$index])) {
            // Ici, vous pouvez ajouter la logique pour échanger un billet du type ancien au nouveau type pour l'événement donné.
            // Par exemple, mettez à jour les données de l'utilisateur dans une base de données ou envoyez une confirmation par e-mail.
            return true; // Succès de l'échange
        }
        return false; // Événement non trouvé
    }
}

class Evenement {
    private $nom;
    private $date;
    private $lieu;
    private $participants = array('VIP' => 100, 'Standard' => 50, 'Étudiant' => 30);

    public function __construct($nom, $date, $lieu) {
        $this->nom = $nom;
        $this->date = $date;
        $this->lieu = $lieu;
    }

    public function ajouterParticipant($participant) {
        $this->participants[] = $participant;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getDate() {
        return $this->date;
    }

    public function getLieu() {
        return $this->lieu;
    }

    public function getParticipants() {
        return $this->participants;
    }
}

class Participant {
    private $nom;
    private $email;

    public function __construct($nom, $email) {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }
}

$gestionEvenements = new GestionEvenements();

// Interface procédurale
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["creer_evenement"])) {
        $nom = $_POST["nom"];
        $date = $_POST["date"];
        $lieu = $_POST["lieu"];
        $gestionEvenements->creerEvenement($nom, $date, $lieu);
    } elseif (isset($_POST["supprimer_evenement"])) {
        $index = $_POST["supprimer_evenement"];
        $gestionEvenements->supprimerEvenement($index);
    } elseif (isset($_POST["acheter_billets"])) {
        $index = $_POST["evenement"];
        $type = $_POST["type"];
        $gestionEvenements->acheterBillet($index, $type);
    } elseif (isset($_POST["echanger_billets"])) {
        // Logique pour échanger des billets
        // Vous devez ajouter ici la logique pour permettre aux utilisateurs d'échanger des billets.
        // Cela peut impliquer de mettre à jour les données de l'utilisateur dans une base de données,
        // vérifier la disponibilité des billets, etc.
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des événements</title>
    <style>
        /* Styles CSS */
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des événements</h1>
        <form action="" method="post">
            <label for="nom">Nom de l'événement :</label>
            <input type="text" id="nom" name="nom" required><br>
            <label for="date">Date de l'événement :</label>
            <input type="date" id="date" name="date" required><br>
            <label for="lieu">Lieu de l'événement :</label>
            <input type="text" id="lieu" name="lieu" required><br>
            <input type="submit" name="creer_evenement" value="Créer un événement">
        </form>

        <form action="" method="post">
            <label for="supprimer">Supprimer un événement :</label>
            <select id="supprimer" name="supprimer_evenement">
                <?php foreach ($gestionEvenements->getEvenements() as $key => $evenement) : ?>
                <option value="<?php echo $key; ?>"><?php echo $evenement->getNom(); ?> (<?php echo $evenement->getDate(); ?>) - Lieu: <?php echo $evenement->getLieu(); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Supprimer">
        </form>

        <form action="" method="post">
            <label for="evenement">Choisir un événement :</label>
            <select id="evenement" name="evenement">
                <?php foreach ($gestionEvenements->getEvenements() as $key => $evenement) : ?>
                <option value="<?php echo $key; ?>"><?php echo $evenement->getNom(); ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="type">Type de billet :</label>
            <select id="type" name="type">
                <?php foreach ($gestionEvenements->getEvenements()[0]->getParticipants() as $type => $prix) : ?>
                <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                <?php endforeach; ?>
            </select><br>
            <input type="submit" name="acheter_billets" value="Acheter">
        </form>
    </div>
</body>
</html>
