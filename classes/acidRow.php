	<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
		<input type="text" style="width: 8em;" name="mca_b_ref_<?php echo $compteur;?>" value="<?php echo $reponse['mca_b_ref'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
		<input type="text" style="width: 8em;" name="t1_<?php echo $compteur;?>" value="<?php echo $reponse['t1'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="number" min="0" step="0.01" style="width: 8em;" name="poids_<?php echo $compteur;?>" value="<?php echo $reponse['poids'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: right;">
		<input type="text" style="width: 15em;" name="ref_fact_<?php echo $compteur;?>" value="<?php echo $reponse['ref_fact'];?>">
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
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php echo $reponse['num_lic'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php echo $reponse['tonnage'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;">
		<?php //echo $date_exp;?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="klsa_arriv_<?php echo $compteur;?>" value="<?php echo $reponse['klsa_arriv'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="crossing_date_<?php echo $compteur;?>" value="<?php echo $reponse['crossing_date'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="wiski_arriv_<?php echo $compteur;?>" value="<?php echo $reponse['wiski_arriv'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
		<input type="date" max="<?php echo date('Y-m-d');?>" style="border: 1px solid black; width: 8em;" name="wiski_dep_<?php echo $compteur;?>" value="<?php echo $reponse['wiski_dep'];?>">
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
	<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: left;"><?php //echo $reponse['nom_march'];?></td>