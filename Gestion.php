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
}

class Evenement {
    private $nom;
    private $date;
    private $lieu;
    private $participants = array();

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
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="date"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin: 8px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: calc(100% - 16px);
            padding: 10px;
            margin: 8px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        select {
            width: calc(100% - 16px);
            padding: 8px;
            margin: 8px;
            border: 1px solid #ccc;
        }
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
    </div>
</body>
</html>
