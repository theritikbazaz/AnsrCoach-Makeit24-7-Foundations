<?php
$name=$_POST['name']??'';
$email=$_POST['email']??'';
$phone=$_POST['phone']??'';
$donation=$_POST['donation']??'';
$conn = new mysqli('localhost','root','','makeit');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error); 
	} else {
		$stmt = $conn->prepare("insert into makeit(name, email, phone,donation) values(?, ?, ? ,?)"); 
		$stmt->bind_param("ssii", $name, $email, $phone,$donation);
		$execval = $stmt->execute();
		$stmt->close();
		$conn->close();
		require ("fpdf/fpdf.php");
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Times','B',24);
		$pdf->Cell(200, 10, "MAKE IT 22*7 FOUNDATION", 0,1 ,"C");
		$pdf->SetFont('Times','B',24);
		$pdf->Cell(200, 10, "Receipt", 0, 1,"C");
		$pdf->Ln();
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0,10, "Name:{$name}", 0, 0,"L");
		$pdf->Ln();
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0, 10,"E-Mail:$email", 0, 0,"L");
		$pdf->Ln();
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0, 10,"Phone Number:{$phone}", 0, 0,"L");
		$pdf->Ln();
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0, 10,"Amount:{$donation}", 0, 0,"L");
		$pdf->Ln();
		$pdf->Output();
        
    exit();
	
	
    }
?>