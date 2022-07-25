<?php
	if($_GET['id_mod_lic']=='2' && $_GET['id_mod_trans']=='1'){
		?>
	  <tr>
	    <th>MCA File REF</th>
	    <th>PRE-ALERTE DATE</th>
	    <th>DELAY</th>
	    <th>INVOICE</th>
	    <th>HORSE</th>
	    <th>TRAILER 1</th>
	    <th>TRAILER 2</th>
	    <th>COMMODITY</th>
	    <th>SUPPLIER</th>
	    <th>PO Ref</th>
	    <th>WEIGHT</th>
	    <th>LICENCE Num.</th>
	    <th>CRF Reference</th>
	    <th>CRF DATE</th>
	    <th>AD DATE</th>
	    <th>INSURRANCE</th>
	    <th>ENTRY POINT</th>
	    <th>BORDER ARRIVAL</th>
	    <th>WAREHOUSE BORDER</th>
	    <th>WAREHOUSE BORDER ARRIVAL</th>
	    <th>DISPATCH FROM BORDER</th>
	    <th>BONDED WAREHOUSE</th>
	    <th>WAREHOUSE ARRIVAL</th>
	    <th>WAREHOUSE DEPARTURE</th>
	    <th>DISPACTH/DELIVER DATE</th>
	    <th>DECL.REF.</th>
	    <th>DECL.DATE</th>
	    <th>LIQ.REF.</th>
	    <th>LIQ.DATE</th>
	    <th>QUIT.REF.</th>
	    <th>QUIT.DATE</th>
	    <th>DGDA OUT</th>
	    <th>STATUS</th>
	  </tr>
	  <?php
	}else if($_GET['id_mod_lic']=='2' && $_GET['id_mod_trans']=='3'){
		?>
	  <tr>
	    <th>MCA File REF</th>
	    <th>PRE-ALERTE DATE</th>
	    <th>DELAY</th>
	    <th>INVOICE</th>
	    <th>AWB NUM</th>
	    <th>COMMODITY</th>
	    <th>SUPPLIER</th>
	    <th>PO Ref</th>
	    <th>WEIGHT</th>
	    <th>LICENCE Num.</th>
	    <th>CRF Reference</th>
	    <th>CRF DATE</th>
	    <th>AD DATE</th>
	    <th>INSURRANCE</th>
	    <th>ENTRY POINT</th>
	    <th>BORDER ARRIVAL</th>
	    <th>WAREHOUSE BORDER</th>
	    <th>WAREHOUSE BORDER ARRIVAL</th>
	    <th>DISPATCH FROM BORDER</th>
	    <th>BONDED WAREHOUSE</th>
	    <th>WAREHOUSE ARRIVAL</th>
	    <th>WAREHOUSE DEPARTURE</th>
	    <th>DISPACTH/DELIVER DATE</th>
	    <th>DECL.REF.</th>
	    <th>DECL.DATE</th>
	    <th>LIQ.REF.</th>
	    <th>LIQ.DATE</th>
	    <th>QUIT.REF.</th>
	    <th>QUIT.DATE</th>
	    <th>DGDA OUT</th>
	    <th>STATUS</th>
	  </tr>
	  <?php
	}else if($_GET['id_mod_lic']=='2' && $_GET['id_mod_trans']=='4'){
		?>
	  <tr>
	    <th>MCA File REF</th>
	    <th>PRE-ALERTE DATE</th>
	    <th>DELAY</th>
	    <th>INVOICE</th>
	    <th>WAGON NUM</th>
	    <th>COMMODITY</th>
	    <th>SUPPLIER</th>
	    <th>PO Ref</th>
	    <th>WEIGHT</th>
	    <th>LICENCE Num.</th>
	    <th>CRF Reference</th>
	    <th>CRF DATE</th>
	    <th>AD DATE</th>
	    <th>INSURRANCE</th>
	    <th>ENTRY POINT</th>
	    <th>BORDER ARRIVAL</th>
	    <th>WAREHOUSE BORDER</th>
	    <th>WAREHOUSE BORDER ARRIVAL</th>
	    <th>DISPATCH FROM BORDER</th>
	    <th>BONDED WAREHOUSE</th>
	    <th>WAREHOUSE ARRIVAL</th>
	    <th>WAREHOUSE DEPARTURE</th>
	    <th>DISPACTH/DELIVER DATE</th>
	    <th>DECL.REF.</th>
	    <th>DECL.DATE</th>
	    <th>LIQ.REF.</th>
	    <th>LIQ.DATE</th>
	    <th>QUIT.REF.</th>
	    <th>QUIT.DATE</th>
	    <th>DGDA OUT</th>
	    <th>STATUS</th>
	  </tr>
	  <?php
	}else if ($_GET['id_mod_lic']=='1' && $_GET['id_mod_trans']=='1') {
  ?>
  <tr>
    <th>MCA File REF</th>
    <th>LOT NUM.</th>
    <th>LICENCE NUM.</th>
    <th>HORSE</th>
    <th>TRAILER 1</th>
    <th>TRAILER 2</th>
    <th>COMMODITY</th>
    <th>TRANSPORTER</th>
    <th>Nbr.</th>
    <th>WEIGHT</th>
    <th>ARRIVAL DATE</th>
    <th>Loading Date</th>
    <th>BP Details Received Date</th>
    <th>PV Div Mines</th>
    <th>Demande d'Attestation</th>
    <th>Assay Date</th>
    <th>CEEC In</th>
    <th>CEEC Out</th>
    <th>CEEC Delay</th>
    <th>Min Div In</th>
    <th>Min Div Out</th>
    <th>Min Div Delay</th>
    <th>Declaration Reference</th>
    <th>Declaration Date</th>
    <th>DGDA In Date</th>
    <th>Liquidation Reference</th>
    <th>Date Liquidation</th>
    <th>Quittance Reference</th>
    <th>Date Quittance</th>
    <th>DGDA Out Date</th>
    <th>Gov Docs In</th>
    <th>Gov Docs Out</th>
    <th>Gov Docs Delay</th>
    <th>Dispatch Date</th>
    <th>Border Arrival Date</th>
    <th>End of Formalities</th>
    <th>Exit DRC Date</th>
    <th>STATUS</th>
    <th>REMARKS</th>
  </tr>
  <?php
}else if ($_GET['id_mod_lic']=='1' && $_GET['id_mod_trans']!='1') {
  ?>
  <tr>
    <th>MCA File REF</th>
    <th>LOT NUM.</th>
    <th>LICENCE NUM.</th>
    <th>WAGON NUM.</th>
    <th>COMMODITY</th>
    <th>TRANSPORTER</th>
    <th>Nbr.</th>
    <th>WEIGHT</th>
    <th>ARRIVAL DATE</th>
    <th>Loading Date</th>
    <th>BP Details Received Date</th>
    <th>PV Div Mines</th>
    <th>Demande d'Attestation</th>
    <th>Assay Date</th>
    <th>CEEC In</th>
    <th>CEEC Out</th>
    <th>CEEC Delay</th>
    <th>Min Div In</th>
    <th>Min Div Out</th>
    <th>Min Div Delay</th>
    <th>Declaration Reference</th>
    <th>Declaration Date</th>
    <th>DGDA In Date</th>
    <th>Liquidation Reference</th>
    <th>Date Liquidation</th>
    <th>Quittance Reference</th>
    <th>Date Quittance</th>
    <th>DGDA Out Date</th>
    <th>Gov Docs In</th>
    <th>Gov Docs Out</th>
    <th>Gov Docs Delay</th>
    <th>Dispatch Date</th>
    <th>Border Arrival Date</th>
    <th>End of Formalities</th>
    <th>Exit DRC Date</th>
    <th>STATUS</th>
    <th>REMARKS</th>
  </tr>
  <?php
}
?>