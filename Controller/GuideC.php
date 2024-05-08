<?php
include "../Model/Guide.php";
require_once '../config.php'; // Use require_once instead of require

// ... rest of your code


class functions
{
    public function listGuide()
    {
        $sql = "SELECT * FROM guides";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addGuide($Guide)
    {
        $sql = "INSERT INTO guides (ID_guide,Nom, Prenom, Age, numTel, Email, nbvoyages,ID_pays) VALUES (:ID_guide, :Nom, :Prenom, :Age, :numTel, :Email, :nbvoyages, :ID_pays)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_guide' => $Guide->getID_guide(),
                'Nom' => $Guide->getNom(),
                'Prenom' => $Guide->getPrenom(),
                'Age' => $Guide->getAge(),
                'numTel' => $Guide->getnumTel(),
                'Email' => $Guide->getEmail(), 
                'nbvoyages' => $Guide->getnbvoyages(),
                'ID_pays' => $Guide->getID_pays()

            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteGuide($ID_guide)
    {
        $sql = "DELETE FROM guides WHERE ID_guide = :ID_guide";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ID_guide', $ID_guide);

        try {
            $req->execute();
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function updateGuide($guides, $ID_guide)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE guides SET 
                    Nom = :Nom, 
                    Prenom = :Prenom,
                    Age = :Age,
                    numTel = :numTel,
                    Email = :Email,
                    nbvoyages = :nbvoyages,
                    ID_pays = :ID_pays
                 WHERE ID_guide = :ID_guide'
            );
    
            $query->execute([
                'ID_guide' => $ID_guide,
                'Nom' => $guides->getNom(),
                'Prenom' => $guides->getPrenom(),
                'Age' => $guides->getAge(),
                'numTel' => $guides->getnumTel(),
                'Email' => $guides->getEmail(),
                'nbvoyages' => $guides->getnbvoyages(),
                'ID_pays' => $guides->getID_pays()
            ]);
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function afficheGuide($ID_pays) {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM guides WHERE ID_pays = :ID");
            $query->execute(["ID" => $ID_pays]);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function affichePays() {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM pays");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
   
    function searchGuide($Nom)
    {
        $sql = "SELECT * FROM guides WHERE Nom LIKE :Nom";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':Nom', '%' . $Nom . '%', PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    
    public function tripAge($order = 'ASC') {
        $sql = "SELECT * FROM guides ORDER BY Age $order";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:'. $e->getMessage());
        }
    }
    public function tripnbvoyages($order = 'ASC') {
        $sql = "SELECT * FROM guides ORDER BY nbvoyages $order";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:'. $e->getMessage());
        }
    }
    function getvoyages()
    {
        try {
            $pdo = config::getConnexion();
            $sql = "SELECT Nom, nbvoyages FROM guides";
    
           
            $stmt = $pdo->query($sql);
    
            $labels = [];
            $data = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $labels[] = $row['Nom'];
                $data[] = $row['nbvoyages'];
            }
    
    
            return ['labels' => $labels, 'data' => $data];
        } catch (PDOException $e) {
            echo "Error executing the query: " . $e->getMessage();
            return ['labels' => [], 'data' => []];
        }
    }
    function generatePDF()
{
   
    // Include TCPDF library
    require_once('tcpdf/tcpdf.php');

    // Create new PDF instance
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Adam');
    $pdf->SetTitle('Guides PDF');
    $pdf->SetSubject('Generating PDF from guides');
    $pdf->SetKeywords('PDF, table, generate');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Example HTML table content
    $html = '<table border="1" align="center">
                <tr>
                    <th>ID_guide</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Age</th>
                    <th>numTel</th>
                    <th>Email</th>
                    <th>nbvoyages</th>
                    <th>ID_pays</th>
                   
                </tr>';

    // Assuming $tab contains the data for the table rows
    foreach ($tab as $guide) {
        $html .= '<tr>
                    <td>' . $guide['ID_guide'] . '</td>
                    <td>' . $guide['Nom'] . '</td>
                    <td>' . $guide['Prenom'] . '</td>
                    <td>' . $guide['Age'] . '</td>
                    <td>' . $guide['numTel'] . '</td>
                    <td>' . $guide['Email'] . '</td>
                    <td>' . $guide['nbvoyages'] . '</td>
                    <td>' . $guide['ID_pays'] . '</td>
                    
                </tr>';
    }

    $html .= '</table>';

    // Output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // Specify output file path (change this to save to a specific directory)
    $outputPath = 'table.pdf';

    // Close and output PDF document
    $pdf->Output($outputPath, 'F');

    // Check if PDF was created successfully
    if (file_exists($outputPath)) {
        echo "PDF created successfully. File path: " . $outputPath;
    } else {
        echo "Failed to create PDF.";
    }

    // Return the output path for further processing (optional)
    return $outputPath;
}
}