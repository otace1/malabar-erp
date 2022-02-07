	<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="width: 8em;" name="date_preal_<?php echo $compteur;?>" value="<?php echo $reponse['date_preal'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
		<input type="text" style="width: 8em;" name="mca_b_ref_<?php echo $compteur;?>" value="<?php echo $reponse['mca_b_ref'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 8em;" name="fournisseur_<?php echo $compteur;?>" value="<?php echo $reponse['fournisseur'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 8em;" name="po_ref_<?php echo $compteur;?>" value="<?php echo $reponse['po_ref'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 15em;" name="ref_fact_<?php echo $compteur;?>" value="<?php echo $reponse['ref_fact'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<?php echo $reponse['nom_march'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 15em;" name="road_manif_<?php echo $compteur;?>" value="<?php echo $reponse['road_manif'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 8em;" name="horse_<?php echo $compteur;?>" value="<?php echo $reponse['horse'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 8em;" name="trailer_1_<?php echo $compteur;?>" value="<?php echo $reponse['trailer_1'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 8em;" name="trailer_2_<?php echo $compteur;?>" value="<?php echo $reponse['trailer_2'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="arrival_date_<?php echo $compteur;?>" value="<?php echo $reponse['arrival_date'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="wiski_arriv_<?php echo $compteur;?>" value="<?php echo $reponse['wiski_arriv'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="dispatch_klsa_<?php echo $compteur;?>" value="<?php echo $reponse['dispatch_klsa'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="lshi_arriv_<?php echo $compteur;?>" value="<?php echo $reponse['lshi_arriv'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php echo $reponse['num_lic'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="text" style="width: 12em;" name="ref_crf_<?php echo $compteur;?>" value="<?php echo $reponse['ref_crf'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="date_crf_<?php echo $compteur;?>" value="<?php echo $reponse['date_crf'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="text" style="width: 8em;" name="ref_decl_<?php echo $compteur;?>" value="<?php echo $reponse['ref_decl'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" style="width: 8em;"  name="dgda_in_<?php echo $compteur;?>" value="<?php echo $reponse['dgda_in'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="text" style="width: 8em;"  name="ref_liq_<?php echo $compteur;?>" value="<?php echo $reponse['ref_liq'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;"  name="date_liq_<?php echo $compteur;?>" value="<?php echo $reponse['date_liq'];?>">
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
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="custom_deliv_<?php echo $compteur;?>" value="<?php echo $reponse['custom_deliv'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="dispatch_deliv_<?php echo $compteur;?>" value="<?php echo $reponse['dispatch_deliv'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php echo $reponse['nom_site'];?>
	</td>