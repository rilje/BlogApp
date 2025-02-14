<?php  
    session_start();
    // print_r($_SESSION);
    require_once "db.php";

    class Vest {
        // Definisanje atribuda klase
        private $id;
        private $naslov;
        private $sadrzaj;
        private $kategorija_id;
        private $autor;
        private $datum_objave;
        

        public function __construct($id,$naslov,$sadrzaj,$kategorija_id,$autor,$datum_objave){
            $this->id = $id;
            $this->naslov = $naslov;
            $this->sadrzaj = $sadrzaj;
            $this->kategorija_id = $kategorija_id;
            $this->autor = $autor;
            $this->datum_objave = $datum_objave;
        }

        // Sada pravim funkcije za dohvatanje svakog atribuda klase ( get )

        public function get_id(){
            return $this->id;
        }
        public function get_naslov(){
            return $this->naslov;
        }
        public function get_sadrzaj(){
            return $this->sadrzaj;
        }
        public function get_kategorijaId(){
            return $this->id;
        }
        public function get_autor(){
            return $this->autor;
        }
        public function get_datumObjave(){
            return $this->datum_objave;
        }

        // Funkcije za menjanje atribuda klase  ( set )
        public function set_id($id){
            $this->id = $id;
        }
        public function set_naslov($naslov){
            $this->naslov = $naslov;
        }
        public function set_sadrzaj($sadrzaj){
            $this->sadrzaj = $sadrzaj;
        }
        public function set_kategorijaId($kategorija_id){
            $this->kategorija_id = $kategorija_id;
        }
        public function set_autor($autor){
            $this->autor = $autor;
        }
        public function set_datumObjave($datum_objave){
            $this->datum_objave = $datum_objave;
        }

        // Funkcija za dodavanje u bazu podataka
        public function dodaj_u_bazu($pdo){
            $stmt = $pdo->prepare("INSERT INTO vesti (id,naslov,sadrzaj,kategorija_id,autor,datum_objave) VALUES (?,?,?,?,?,?) ");
            $stmt->execute([
                $this->id,$this->naslov,$this->sadrzaj,$this->kategorija_id,$this->autor,$this->datum_objave
            ]);
        }

        // Funkcija za brisanje iz baze
        
    }

    // $vest1 = new Vest(2331,"Neki naslov", "Neki sadrzaj malo duzi od naslova", 2, "Filip Rajhard", "23.04.2024");
    // print_r($vest1);

    // $vest2 = new Vest(2661,"Neki naslov", "Neki sadrzaj malo duzi od naslova", 2, "Filip Rajhard", "23.04.2024");
    // print_r($vest2);

    // $vest3 = new Vest(3211,"Neki naslov", "Neki sadrzaj malo duzi od naslova", 2, "Filip Rajhard", "23.04.2024");
    // print_r($vest3);

    // $vest4 = new Vest(4445,"Neki naslov", "Neki sadrzaj malo duzi od naslova", 2, "Filip Rajhard", "23.04.2024");
    // print_r($vest4);

    // $vest1->dodaj_u_bazu($pdo);
    // $vest2->dodaj_u_bazu($pdo);
    // $vest3->dodaj_u_bazu($pdo);
    // $vest4->dodaj_u_bazu($pdo);

    // $stmt = $pdo->query("DELETE FROM vesti");

    $podaci = $pdo->query("SELECT * FROM vesti")->fetchAll();
    // print_r($podaci);
?>


<?php include "moduli/head.php" ?>
<?php include "moduli/nav.php" ?> 

<div class="container-fluid d-flex justify-content-center">
    <br>
    <br>
    <div class="col-md-9 d-flex justify-content-around flex-wrap" style="border:solid black thin; ">
        <?php foreach($podaci as $vest) { ?>
            <div class="col-md-3" style="margin-bottom:10px; border:solid black thin; padding:10px">
                <div class="slikaDiv">
                    slika
                </div>
                <h4><?= $vest['naslov'] ?></h4>
                <p><?= $vest['sadrzaj'] ?></p>
                <div class="d-flex justify-content-between">
                    <span><?= $vest['autor'] ?></span>
                    <span><?= $vest['datum_objave'] ?></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span><a href="edit.php?id=<?= $vest['id'] ?>"><button class="btn btn-primary btn-sm">Edit</button></a></span>
                    <span><a href="delete.php?id=<?= $vest['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></a></span>
                </div>
            </div>
    <?php    } ?>
    </div>
    <div class="col-md-3">
        <div>
            <h3>Kategorije</h3>
        </div>
        <div>
            <h3>Najnovije vesti</h3>
        </div>

    </div>



<?php include "moduli/foot.php" ?>