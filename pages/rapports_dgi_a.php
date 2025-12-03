<?php
/**
 * Page A-Rapport DGI
 * Rapport statistique complet par article/débours
 */

include("tete.php");
include("menuHaut.php");
include("menuGauche.php");

// Charger la configuration DGI
require_once __DIR__ . '/../config/api_config.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="header">
        <h5>
          <i class="fas fa-box"></i> A-RAPPORT DGI (Détails par Article)
          <span class="float-right">
            <button class="btn btn-sm btn-success" onclick="genererRapportA()">
              <i class="fas fa-sync"></i> Générer
            </button>
            <button class="btn btn-sm btn-primary" onclick="imprimerRapportA()">
              <i class="fas fa-print"></i> Imprimer
            </button>
            <button class="btn btn-sm btn-info" onclick="exporterExcel()">
              <i class="fas fa-file-excel"></i> Excel
            </button>
          </span>
        </h5>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- Sélection de période -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-calendar"></i> Mode de Génération A-Rapport</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Mode de Rapport</label>
                    <select class="form-control" id="mode_rapport_a" onchange="changerModeRapportA()">
                      <option value="auto">Automatique (depuis dernier A-Rapport)</option>
                      <option value="periodique">Période Personnalisée</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3" id="section_date_debut_a" style="display:none;">
                  <div class="form-group">
                    <label>Date Début</label>
                    <input type="date" class="form-control" id="date_debut" value="<?php echo date('Y-m-01'); ?>">
                  </div>
                </div>
                <div class="col-md-3" id="section_date_fin_a" style="display:none;">
                  <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" class="form-control" id="date_fin" value="<?php echo date('Y-m-d'); ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>&nbsp;</label><br>
                    <button class="btn btn-danger" onclick="genererRapportA()">
                      <i class="fas fa-file-invoice"></i> Générer A-Rapport
                    </button>
                  </div>
                </div>
              </div>

              <!-- Info dernier A-Rapport -->
              <div class="alert alert-info mt-3" id="info_dernier_rapport" style="display:none;">
                <h5><i class="fas fa-info-circle"></i> Dernier A-Rapport Généré</h5>
                <div id="info_dernier_contenu"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Statistiques -->
      <div class="row" id="stats_rapport" style="display:none;">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 id="stat_articles">0</h3>
              <p>Articles/Services Différents</p>
            </div>
            <div class="icon">
              <i class="fas fa-box"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3 id="stat_ventes">0.00</h3>
              <p>Total Ventes (USD)</p>
            </div>
            <div class="icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 id="stat_retours">0.00</h3>
              <p>Total Retours (USD)</p>
            </div>
            <div class="icon">
              <i class="fas fa-undo"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3 id="stat_net">0.00</h3>
              <p>Montant Net (USD)</p>
            </div>
            <div class="icon">
              <i class="fas fa-money-bill-wave"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Tableau des articles -->
      <div class="row" id="table_rapport" style="display:none;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-list"></i> Détails par Article/Service</h3>
            </div>
            <div class="card-body">

              <!-- Informations Générales -->
              <div class="row mb-3">
                <div class="col-md-6">
                  <table class="table table-sm table-bordered">
                    <tr><td><strong>Dénomination:</strong></td><td><?php echo defined('ENTREPRISE_NOM') ? ENTREPRISE_NOM : 'BELEJ'; ?></td></tr>
                    <tr><td><strong>NIF:</strong></td><td><?php echo defined('ENTREPRISE_NIF') ? ENTREPRISE_NIF : 'A1809181A'; ?></td></tr>
                    <tr><td><strong>ISF (e-MCF ID):</strong></td><td><?php echo defined('ENTREPRISE_EMCF_ID') ? ENTREPRISE_EMCF_ID : 'CD01002974-1'; ?></td></tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table table-sm table-bordered">
                    <tr><td><strong>Type de Rapport:</strong></td><td>A-Rapport (Articles)</td></tr>
                    <tr><td><strong>Période:</strong></td><td id="info_periode">-</td></tr>
                    <tr><td><strong>Date de génération:</strong></td><td><?php echo date('d/m/Y H:i:s'); ?></td></tr>
                  </table>
                </div>
              </div>

              <hr>

              <!-- Tableau détaillé -->
              <div class="table-responsive">
                <table id="table_articles" class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Nom Article/Service</th>
                      <th>Type</th>
                      <th>Prix Unitaire</th>
                      <th>Taux TVA</th>
                      <th>Groupe Tax</th>
                      <th>Qté Vendue</th>
                      <th>Qté Retournée</th>
                      <th>Total Ventes</th>
                      <th>Total Retours</th>
                      <th>Net</th>
                    </tr>
                  </thead>
                  <tbody id="tbody_articles"></tbody>
                  <tfoot id="tfoot_articles">
                    <tr class="font-weight-bold">
                      <td colspan="6">TOTAUX</td>
                      <td id="total_qte_ventes">0</td>
                      <td id="total_qte_retours">0</td>
                      <td id="total_ventes">0.00</td>
                      <td id="total_retours">0.00</td>
                      <td id="total_net">0.00</td>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let dateDebut = '<?php echo date('Y-m-01'); ?>';
let dateFin = '<?php echo date('Y-m-d'); ?>';

// Au chargement
$(document).ready(function() {
  chargerDernierRapportA();
});

// Changer mode rapport A
function changerModeRapportA() {
  const mode = $('#mode_rapport_a').val();
  if (mode === 'periodique') {
    $('#section_date_debut_a').show();
    $('#section_date_fin_a').show();
  } else {
    $('#section_date_debut_a').hide();
    $('#section_date_fin_a').hide();
  }
}

// Charger dernier rapport A
function chargerDernierRapportA() {
  $.ajax({
    url: '../pages/ajax/generer_rapport_a.php',
    type: 'POST',
    dataType: 'json',
    data: { operation: 'get_dernier_rapport' },
    success: function(response) {
      if (response.success && response.dernier_rapport) {
        const rapport = response.dernier_rapport;
        $('#info_dernier_rapport').show();
        $('#info_dernier_contenu').html(`
          <p><strong>Numéro:</strong> ${rapport.numero_rapport}</p>
          <p><strong>Date génération:</strong> ${rapport.date_generation}</p>
          <p><strong>Période:</strong> ${rapport.periode_debut} au ${rapport.periode_fin}</p>
          <p><strong>Articles:</strong> ${rapport.nbre_factures} | <strong>Montant:</strong> ${formatMontant(rapport.montant_total)} USD</p>
          <p class="mb-0"><i class="fas fa-info-circle"></i> Le prochain A-Rapport démarrera automatiquement après ${rapport.periode_fin}</p>
        `);
      }
    }
  });
}

// Générer le rapport A
function genererRapportA() {
  const mode = $('#mode_rapport_a').val();
  let data = { operation: 'generer_rapport_a', mode: mode };

  if (mode === 'periodique') {
    dateDebut = $('#date_debut').val();
    dateFin = $('#date_fin').val();

    if (!dateDebut || !dateFin) {
      Swal.fire('Erreur', 'Veuillez sélectionner une période', 'error');
      return;
    }

    data.date_debut = dateDebut;
    data.date_fin = dateFin;
  }

  $.ajax({
    url: '../pages/ajax/generer_rapport_a.php',
    type: 'POST',
    dataType: 'json',
    data: data,
    beforeSend: function() {
      Swal.fire({
        title: 'Génération du A-Rapport',
        html: 'Calcul des mouvements d\'articles...',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
      });
    },
    success: function(response) {
      Swal.close();

      if (response.success) {
        afficherRapport(response.rapport);
        // Recharger info dernier rapport
        chargerDernierRapportA();

        Swal.fire({
          icon: 'success',
          title: 'A-Rapport Généré !',
          html: `Le rapport a été enregistré avec succès.<br>Numéro: <strong>${response.numero_rapport || 'N/A'}</strong>`,
          timer: 3000
        });
      } else {
        Swal.fire('Erreur', response.error || 'Échec de génération', 'error');
      }
    },
    error: function() {
      Swal.close();
      Swal.fire('Erreur', 'Erreur serveur', 'error');
    }
  });
}

// Afficher le rapport
function afficherRapport(rapport) {
  // Statistiques
  $('#stat_articles').text(rapport.statistiques.nbre_articles);
  $('#stat_ventes').text(formatMontant(rapport.statistiques.total_ventes));
  $('#stat_retours').text(formatMontant(rapport.statistiques.total_retours));
  $('#stat_net').text(formatMontant(rapport.statistiques.montant_net));

  // Période
  $('#info_periode').text(`${dateDebut} au ${dateFin}`);

  // Articles
  let tbody = '';
  let totalQteVentes = 0;
  let totalQteRetours = 0;
  let totalVentes = 0;
  let totalRetours = 0;
  let totalNet = 0;

  $.each(rapport.articles, function(i, article) {
    const net = article.montant_ventes - article.montant_retours;

    tbody += `<tr>
      <td>${article.code_article}</td>
      <td>${article.nom_article}</td>
      <td>${article.type_article}</td>
      <td class="text-right">${formatMontant(article.prix_unitaire)}</td>
      <td class="text-right">${article.taux_tva}%</td>
      <td class="text-center">${article.groupe_taxation}</td>
      <td class="text-right">${article.quantite_vendue || 0}</td>
      <td class="text-right">${article.quantite_retournee || 0}</td>
      <td class="text-right">${formatMontant(article.montant_ventes)}</td>
      <td class="text-right">${formatMontant(article.montant_retours)}</td>
      <td class="text-right font-weight-bold">${formatMontant(net)}</td>
    </tr>`;

    totalQteVentes += parseFloat(article.quantite_vendue || 0);
    totalQteRetours += parseFloat(article.quantite_retournee || 0);
    totalVentes += parseFloat(article.montant_ventes);
    totalRetours += parseFloat(article.montant_retours);
    totalNet += net;
  });

  $('#tbody_articles').html(tbody);

  // Totaux
  $('#total_qte_ventes').text(totalQteVentes.toFixed(2));
  $('#total_qte_retours').text(totalQteRetours.toFixed(2));
  $('#total_ventes').text(formatMontant(totalVentes));
  $('#total_retours').text(formatMontant(totalRetours));
  $('#total_net').text(formatMontant(totalNet));

  $('#stats_rapport').show();
  $('#table_rapport').show();
}

// Formater montant
function formatMontant(montant) {
  return parseFloat(montant).toLocaleString('fr-FR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });
}

// Imprimer
function imprimerRapportA() {
  window.print();
}

// Exporter Excel
function exporterExcel() {
  window.location.href = `export_rapport_a_excel.php?date_debut=${dateDebut}&date_fin=${dateFin}`;
}
</script>

<?php include("pied.php"); ?>
