	<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
		<input type="date" style="width: 8em;" max="<?php echo date('Y-m-d');?>" name="date_preal_<?php echo $compteur;?>" value="<?php echo $reponse['date_preal'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
		<input type="text" style="width: 8em;" name="mca_b_ref_<?php echo $compteur;?>" value="<?php echo $reponse['mca_b_ref'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 15em;" name="ref_fact_<?php echo $compteur;?>" value="<?php echo $reponse['ref_fact'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
		<input type="text" style="width: 8em;" name="road_manif_<?php echo $compteur;?>" value="<?php echo $reponse['road_manif'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
		<input type="text" style="width: 8em;" name="t1_<?php echo $compteur;?>" value="<?php echo $reponse['t1'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 15em;" name="commodity_<?php echo $compteur;?>" value="<?php echo $reponse['commodity'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php echo $reponse['fournisseur'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 8em;" name="horse_<?php echo $compteur;?>" value="<?php echo $reponse['horse'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 15em;" name="po_ref_<?php echo $compteur;?>" value="<?php echo $reponse['po_ref'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="number" min="0" step="0.01" style="width: 8em;" name="fob_<?php echo $compteur;?>" value="<?php echo $reponse['fob_dos'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="number" min="0" step="0.01" style="width: 8em;" name="fret_<?php echo $compteur;?>" value="<?php echo $reponse['fret'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="number" min="0" step="0.01" style="width: 8em;" name="assurance_<?php echo $compteur;?>" value="<?php echo $reponse['assurance'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="number" min="0" step="0.01" style="width: 8em;" name="autre_frais_<?php echo $compteur;?>" value="<?php echo $reponse['autre_frais'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black;">
		<?php echo ($reponse['fob_dos']+$reponse['fret']+$reponse['assurance']+$reponse['autre_frais']);?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="number" min="0" step="0.01" style="width: 8em;" name="poids_<?php echo $compteur;?>" value="<?php echo $reponse['poids'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="arrival_date_<?php echo $compteur;?>" value="<?php echo $reponse['arrival_date'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php echo $reponse['num_lic'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="text" style="width: 12em;" name="ref_crf_<?php echo $compteur;?>" value="<?php echo $reponse['ref_crf'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="date_crf_<?php echo $compteur;?>" value="<?php echo $reponse['date_crf'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" style="width: 8em;"  name="dgda_in_<?php echo $compteur;?>" value="<?php echo $reponse['dgda_in'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="text" style="width: 8em;" name="ref_decl_<?php echo $compteur;?>" value="<?php echo $reponse['ref_decl'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" style="width: 8em;" max="<?php echo date('Y-m-d');?>" name="date_decl_<?php echo $compteur;?>" value="<?php echo $reponse['date_decl'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="text" style="width: 8em;"  name="ref_liq_<?php echo $compteur;?>" value="<?php echo $reponse['ref_liq'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" style="border: 1px solid black; width: 8em;"  name="date_liq_<?php echo $compteur;?>" value="<?php echo $reponse['date_liq'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="text" style="width: 8em;"  name="ref_quit_<?php echo $compteur;?>" value="<?php echo $reponse['ref_quit'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;"  name="date_quit_<?php echo $compteur;?>" value="<?php echo $reponse['date_quit'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;"  name="dgda_out_<?php echo $compteur;?>" value="<?php echo $reponse['dgda_out'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<?php echo ($reponse['dgda_delay']);?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;"  name="custom_deliv_<?php echo $compteur;?>" value="<?php echo $reponse['custom_deliv'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black;">
		<select name="cleared_<?php echo $compteur;?>" class="control-form">
			<?php 
			if ($reponse['cleared'] == '1') {
			?>
			<option>CLEARED</option>
			<option value="0">TRANSIT</option>
			<option value="2">CANCELED</option>
			<?php
			}if ($reponse['cleared'] == '2') {
			?>
			<option>CANCELED</option>
			<option value="1">CLEARED</option>
			<option value="0">TRANSIT</option>
			<?php
			}if ($reponse['cleared'] == '0') {
			?>
			<option>TRANSIT</option>
			<option value="1">CLEARED</option>
			<option value="2">CANCELED</option>
			<?php
			}
			?>
		</select>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<?php echo ($reponse['arrival_deliver_delay']);?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<?php echo ( $reponse['arrival_deliver_delay'] - $this-> getWeekendsAndHolidays($reponse['arrival_date_1'], $reponse['custom_deliv_1']) );?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;"  name="dispatch_deliv_<?php echo $compteur;?>" value="<?php echo $reponse['dispatch_deliv'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="text" style="border: 1px solid black; width: 20em;"  name="statut_<?php echo $compteur;?>" value="<?php echo $reponse['statut'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
		<input type="text" style="width: 20em;" name="remarque_<?php echo $compteur;?>" value="<?php echo $reponse['remarque'];?>">
	</td>