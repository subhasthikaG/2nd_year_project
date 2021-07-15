<?php
require_once('../../inc/connection.php');
session_start();

if(isset($_POST['receipt'])){
    $jobid = $_POST['jobid'];
    $query1 = "SELECT * FROM reserved_job WHERE job_id = $jobid";
    $result_set1 = mysqli_query($connection,$query1);
    $record1 = mysqli_fetch_assoc($result_set1);

    $studioid = $record1['studio_id'];
    
    $query2 = "SELECT * FROM reserved_services WHERE job_id = $jobid";
    $result_set2 = mysqli_query($connection,$query2);
    $record2 = mysqli_fetch_assoc($result_set2);

    $query3 = "SELECT total,advanced_fee FROM advanced_payment WHERE job_id = $jobid";
    $result_set3 = mysqli_query($connection,$query3);
    $record3 = mysqli_fetch_assoc($result_set3);

    $query4 = "SELECT * FROM reserved_audio_gear WHERE job_id= $jobid";
    $result_set4 = mysqli_query($connection,$query4);

    $query5 = "SELECT studio_name FROM studio WHERE studio_id = $studioid";
    $result_set5 = mysqli_query($connection,$query5);
    $record5 = mysqli_fetch_assoc($result_set5);  
  }

// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo3.jpg';
        $this->Image($image_file, 5, 2, 200, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        // $this->Cell(0, 0, 'RECORDEX STUDIO RESERVATION SYSTEM', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', '', 12);
        // Page number
        $this->Cell(0, 10,'* This is a computer generated document. No signature is required.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    // Load table data from file
    public function LoadData() {
        // Read file lines
        include '../../inc/connection.php';
        $jobid = $_POST['jobid'];
        $query3 = "SELECT service_name,charge FROM reserved_services WHERE job_id = $jobid";
        $result_set3 = mysqli_query($connection,$query3);
        return $result_set3;
    }

    public function LoadData2() {
        // Read file lines
        include '../../inc/connection.php';
        $jobid = $_POST['jobid'];
        $query3 = "SELECT name,charge FROM reserved_audio_gear WHERE job_id = $jobid";
        $result_set3 = mysqli_query($connection,$query3);
        return $result_set3;
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(223, 223, 235);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(100, 80);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row['service_name'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['charge'], 'LR', 0, 'C', $fill);
            // $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            // $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    public function ColoredTable2($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(223, 223, 235);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(100, 80);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row['name'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['charge'], 'LR', 0, 'C', $fill);
            // $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            // $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('courier', 'B', 15);

// add a page
$pdf->AddPage();

// set some text to print

// $txt = <<<EOD
// E - RECEIPT
// EOD;

$html = <<<EOD
<style>
.ser{text-transform:uppercase;}
.topic{text-align:right;}
</style>

<p class="topic" style="color:green;"><br>$record1[choose_time]<br>$record5[studio_name]<br>Booking Date: $record1[date]<br>Booking ID: $jobid<br></p>
EOD;

// print a block of text using Write()
// $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

//column titles
$header = array('SERVICE', 'CHARGE (LKR)');

// data loading
$data = $pdf->LoadData();

// print colored table
$pdf->ColoredTable($header, $data);

if(mysqli_num_rows($result_set4)>0){
    $html = <<<EOD
    <p></p>
    EOD;
    
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    
    $header = array('EQUIPMENT', 'CHARGE (LKR)');
    
    $data = $pdf->LoadData2();
    
    $pdf->ColoredTable2($header, $data);     
}

$html = <<<EOD
<p></p>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$tots = $record3['total']. " LKR";
$header = array('TOTAL',$tots);

$data = NULL;

$pdf->ColoredTable($header, $data);

$html = <<<EOD
<p></p>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$adp = $record3['advanced_fee']." USD";
$header = array('ADVANCED FEE',$adp);
    
$data = NULL;

$pdf->ColoredTable($header, $data); 

//Close and output PDF document
$pdf->Output('recordex.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+