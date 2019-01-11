<?php
require('fpdf/fpdf.php');

$pdf = new FPDF();

$pdf->AddPage();
// Add Thai font
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
//$pdf->SetFont('THSarabunNew','',16);
//$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', 'สวัสดี'));
//$pdf->SetFont('THSarabunNew','B',16);
//$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', 'สวัสดี'));

//$pdf->SetFont('THSarabunNew','B',16);
//$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', 'ใบเสร็จรับเงิน'));



//set font to arial, bold, 14pt
//$pdf->SetFont('Arial','B',14);
$pdf->SetFont('THSarabunNew','B',20);
//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(29 ,5,iconv('UTF-8', 'cp874', 'ใบเสร็จรับเงิน'),0,0);
$pdf->SetTextColor(34,139,34);
$pdf->Cell(25 ,5,iconv('UTF-8', 'cp874', '(ชำระเงินแล้ว)'),0,1);//end of line

$pdf->SetTextColor(0,0,0);
//set font to arial, regular, 12pt
$pdf->SetFont('THSarabunNew','',16);

$pdf->Cell(130 ,5,iconv('UTF-8', 'cp874', 'Bogoshipda'),0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,iconv('UTF-8', 'cp874', '33/5 ถ.สิทธิวงศ์ ต.ช้างม่อย'),0,0);
$pdf->Cell(25 ,5,iconv('UTF-8', 'cp874', 'วันที่'),0,0);
$pdf->Cell(34 ,5,"$_POST[dateRecieve]",0,1);//end of line

$pdf->Cell(130 ,5,iconv('UTF-8', 'cp874', 'อ.เมือง จ.เชียงใหม่ 50300'),0,0);
$pdf->Cell(25 ,5,iconv('UTF-8', 'cp874', 'เลขที่'),0,0);
$pdf->Cell(34 ,5,"RC-$_POST[orderID]",0,1);//end of line

$pdf->Cell(130 ,5,iconv('UTF-8', 'cp874', 'โทร. +66 82 611 8627'),0,0);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,5,iconv('UTF-8', 'cp874', 'ได้รับเงินจาก'),0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,iconv('UTF-8', 'cp874', "$_POST[name]"),0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,iconv('UTF-8', 'cp874', "ที่อยู่ $_POST[address]"),0,1);

//$pdf->Cell(10 ,5,'',0,0);
//$pdf->Cell(90 ,5,'[Address]',0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,iconv('UTF-8', 'cp874', "โทร. $_POST[tel]"),0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('THSarabunNew','B',16);

$pdf->Cell(109 ,5,iconv('UTF-8', 'cp874', 'รายละเอียด'),1,0,'C');
$pdf->Cell(20 ,5,iconv('UTF-8', 'cp874', 'จำนวน'),1,0,'C');
$pdf->Cell(30 ,5,iconv('UTF-8', 'cp874', 'ราคา'),1,0,'C');
$pdf->Cell(30 ,5,iconv('UTF-8', 'cp874', 'ราคารวม'),1,1,'C');//end of line

$pdf->SetFont('THSarabunNew','',16);

//Numbers are right-aligned so we give 'R' after new line parameter

include('../dbConnect.php');
//where gpdID in ('".$_POST['gpdID']."')
$result = mysqli_query($con,"select * from groupproduct where gpdID in ('".$_POST['gpdID']."')");
while($row = mysqli_fetch_assoc($result))
{
    $resultPD=mysqli_query($con,"select * from product where pdID in ('".$row['productID']."')");
    $rowPD = mysqli_fetch_array($resultPD,MYSQLI_ASSOC);
    $price=number_format($rowPD['price'],2);
    $priceAmount=number_format($row['priceAmount'],2);

    $pdf->Cell(109 ,5,iconv('UTF-8', 'cp874', "$rowPD[name]"),1,0);
    $pdf->Cell(20 ,5,iconv('UTF-8', 'cp874', "$row[amount]"),1,0,'C');
    $pdf->Cell(30 ,5,iconv('UTF-8', 'cp874', "฿$price"),1,0,'R');
    $pdf->Cell(30 ,5,iconv('UTF-8', 'cp874', "฿$priceAmount"),1,1,'R');//end of line

}

mysqli_close();

//summary
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,iconv('UTF-8', 'cp874', 'ยอดรวมสินค้า'),0,0);
$pdf->Cell(4 ,5,iconv('UTF-8', 'cp874', '฿'),1,0);
$pdf->Cell(30 ,5,"$_POST[priceAmount]",1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,iconv('UTF-8', 'cp874', 'ส่วนลด'),0,0);
$pdf->Cell(4 ,5,iconv('UTF-8', 'cp874', '฿'),1,0);
$pdf->Cell(30 ,5,"$_POST[discountPrice]",1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,iconv('UTF-8', 'cp874', 'ค่าจัดส่ง'),0,0);
$pdf->Cell(4 ,5,iconv('UTF-8', 'cp874', '฿'),1,0);
$pdf->Cell(30 ,5,"$_POST[shipPrice]",1,1,'R');//end of line


$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,iconv('UTF-8', 'cp874', 'ราคาสุทธิ'),0,0);
$pdf->SetTextColor(194,8,8);
$pdf->Cell(4 ,5,iconv('UTF-8', 'cp874', '฿'),1,0);
$pdf->Cell(30 ,5,"$_POST[netPrice]",1,1,'R');//end of line


$pdf->Output();