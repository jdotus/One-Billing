<?php 
    // This statement includes the file into this file. If it failes to fine the file, an error is produced and stops the script.
    require ("fpdf/fpdf.php");


  //customer and invoice details
  $info=[
    "customer"=>"",
    "address"=>",",
    "city"=>".",
    "invoice_no"=>"",
    "invoice_date"=>"",
    "total_amt"=>"",
    "vat"=>"",
    "total_sales"=>"",
    "words"=>"",

  ];
  
  $con=mysqli_connect("localhost","root","","sale invoice");

  $sql="select * from invoice where SID='{$_GET["id"]}'";
  $res=$con->query($sql);
  if($res->num_rows>0){
    $row=$res->fetch_assoc();
    $info=[
        "customer"=>$row["CNAME"],
        "address"=>$row["CADDRESS"],
        "description"=>$row["DESCRIPTION"],
        "invoice_no"=>$row["INVOICE_NO"],
        "invoice_date"=>date("m-d-Y",strtotime($row["INVOICE_DATE"])),
        "total_amt"=>$row["GRAND_TOTAL"],
        "vat"=>$row["VAT"],
        "total_sales"=>$row["TOTAL_SALES"],
        "words"=>"",
      ];
  }




  //invoice Products
  $products_info=[
    "name"=>"",
    "price"=>",",
    "qty"=>".",
    "total"=>"",
    "serial"=>"",
  ];
  $con=mysqli_connect("localhost","root","","sale invoice");
  $sql="select * from invoice_products where SID='{$_GET["id"]}'";
  $res=$con->query($sql);
  if($res->num_rows>0){
    $row=$res->fetch_assoc();
        $products_info=[
            "name"=>$row["PNAME"],
            "price"=>$row["PRICE"],
            "qty"=>$row["QTY"],
            "total"=>$row["TOTAL"],
            "serial"=>$row["SERIAL"],
        ];
    }
  
  class PDF extends FPDF
  {
    function Header(){
      
      
    }
    function body($info,$products_info){
      
      //Display Invoice
      $this->SetY(40);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,7,$info["invoice_no"],0,1);
      
      //Display Customer
      $this->SetY(40);
      $this->SetX(60);
      $this->Cell(50,7,$info["customer"]);
      
      //Display Invoice date
      $this->SetY(50);
      $this->SetX(10);
      $this->Cell(50,7,$info["invoice_date"]);
      
      //Display address
      $this->SetY(50);
      $this->SetX(60);
      $this->Cell(50,7,$info["address"]);

      //Display Description
      $this->SetY(90);
      $this->SetX(60);
      $this->Cell(50,7,"Representing copies made for the period");

       //Display Description
       $this->SetY(100);
       $this->SetX(60);
       $this->Cell(50,7,$info["description"]);

       //Display Copies Made
       $this->SetY(110);
       $this->SetX(100);
       $this->Cell(50,7,"Copies Made : ");
      
       //Display Price
       $this->SetY(110);
       $this->SetX(140);
       $this->Cell(50,7,$products_info["price"]);

       //Display Costs Per copy
       $this->SetY(120);
       $this->SetX(100);
       $this->Cell(50,7,"Costs/Copy:");
      
       //Display Amount of cost per copy
       $this->SetY(120);
       $this->SetX(140);
       $this->Cell(50,7,$products_info["qty"]);

       //Display Costs Per copy
       $this->SetY(130);
       $this->SetX(100);
       $this->Cell(50,7,"Total:");

       //Display Costs Per copy
       $this->SetY(160);
       $this->SetX(50);
       $this->Cell(50,7,"Model:");

        //Display Costs Per copy
        $this->SetY(160);
        $this->SetX(70);
        $this->Cell(50,7,$products_info["name"]);

         //Display Costs Per copy
       $this->SetY(170);
       $this->SetX(50);
       $this->Cell(50,7,"Serial:");

        //Display Costs Per copy
        $this->SetY(170);
        $this->SetX(70);
        $this->Cell(50,7,$products_info["serial"]);

          //Display Costs Per copy
          $this->SetY(180);
          $this->SetX(50);
          $this->Cell(50,7,"Recommending approval for payment");
      
       //Display Amount of cost per copy
       $this->SetY(130);
       $this->SetX(180);
       $this->Cell(50,7,$info["total_amt"]);

      //Display Vatable Sale vat
      $this->SetY(195);
       $this->SetX(170);
       $this->Cell(50,7,$info["total_amt"]);
       $this->SetY(210);
       $this->SetX(170);
       $this->Cell(50,7,$info["total_sales"]);
       $this->SetY(220);
       $this->SetX(170);
       $this->Cell(50,7,$info["vat"]);
       $this->SetY(225);
       $this->SetX(170);
       $this->Cell(50,7,$info["total_amt"]);

    }

    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf->Output();
?>