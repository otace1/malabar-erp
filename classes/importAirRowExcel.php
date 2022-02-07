	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; ">
		<?php echo $reponse['date_preal'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; ">
		<?php echo $reponse['mca_b_ref'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: right;">
		<?php echo $reponse['ref_fact'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; ">
		<?php echo $reponse['road_manif'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; ">
		<?php echo $reponse['t1'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: right;">
		<?php echo $reponse['commodity'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: left;">
		<?php echo $reponse['fournisseur'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: right;">
		<?php echo $reponse['horse'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: right;">
		<?php echo $reponse['po_ref'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: right;">
		<?php echo $reponse['fob_dos'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: right;">
		<?php echo $reponse['fret'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: right;">
		<?php echo $reponse['assurance'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: right;">
		<?php echo $reponse['autre_frais'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black;">
		<?php echo ($reponse['fob_dos']+$reponse['fret']+$reponse['assurance']+$reponse['autre_frais']);?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: right;">
		<input type="number" min="0" step="0.01" style="width: 8em;" name="poids_<?php echo $compteur;?>" value="<?php echo $reponse['poids'];?>">
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['arrival_date'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: left;">
		<?php echo $reponse['num_lic'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['ref_crf'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['date_crf'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['dgda_in'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['ref_decl'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['date_decl'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['ref_liq'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['date_liq'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['ref_quit'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['date_quit'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['dgda_out'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo ($reponse['dgda_delay']);?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['custom_deliv'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black;">
			<?php 
			if ($reponse['cleared'] == '1') {
			?>CLEARED
			<?php
			}if ($reponse['cleared'] == '2') {
			?>CANCELED
			<?php
			}if ($reponse['cleared'] == '0') {
			?>TRANSIT
			<?php
			}
			?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo ($reponse['arrival_deliver_delay']);?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo ( $reponse['arrival_deliver_delay'] - $this-> getWeekendsAndHolidays($reponse['arrival_date_1'], $reponse['custom_deliv_1']) );?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['dispatch_deliv'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; text-align: center;">
		<?php echo $reponse['statut'];?>
	</td>
	<td class=" <?php echo $bg;?>" style="border: 0.5px solid black; ">
		<?php echo $reponse['remarque'];?>
	</td>