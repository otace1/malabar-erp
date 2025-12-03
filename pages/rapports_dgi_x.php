<?php
/**
 * Page X-Rapport DGI
 * Rapport statistique de la session en cours (consultation sans clôture)
 */

include("tete.php");
include("menuHaut.php");
include("menuGauche.php");

// Charger la configuration DGI pour les constantes ENTREPRISE_NIF et ENTREPRISE_EMCF_ID
require_once __DIR__ . '/../config/api_config.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="header">
        <h5>
          <i class="fas fa-file-alt"></i> <span id="titre_rapport">X-RAPPORT DGI</span>
          <span class="float-right">
            <button class="btn btn-sm btn-success" onclick="genererRapportX()">
              <i class="fas fa-sync"></i> Générer/Rafraîchir
            </button>
            <button class="btn btn-sm btn-primary" onclick="imprimerRapportX()">
              <i class="fas fa-print"></i> Imprimer
            </button>
            <button class="btn btn-sm btn-info" onclick="exporterRapportX()">
              <i class="fas fa-file-excel"></i> Exporter Excel
            </button>
          </span>
        </h5>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- Sélection Type de Rapport -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-filter"></i> Type de X-Rapport</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Mode de Rapport</label>
                    <select class="form-control" id="mode_rapport" onchange="changerModeRapport()">
                      <option value="quotidien">X-Rapport Quotidien (depuis dernier Z)</option>
                      <option value="periodique">X-Rapport Périodique (période personnalisée)</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3" id="section_date_debut" style="display:none;">
                  <div class="form-group">
                    <label>Date Début</label>
                    <input type="date" class="form-control" id="date_debut_perso" value="<?php echo date('Y-m-01'); ?>">
                  </div>
                </div>
                <div class="col-md-3" id="section_date_fin" style="display:none;">
                  <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" class="form-control" id="date_fin_perso" value="<?php echo date('Y-m-d'); ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>&nbsp;</label><br>
                    <button class="btn btn-primary" onclick="genererRapportX()">
                      <i class="fas fa-sync"></i> Générer Rapport
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Info Session Actuelle -->
      <div class="row" id="section_info_session">
        <div class="col-md-12">
          <div class="alert alert-info">
            <h5><i class="icon fas fa-info"></i> Information Session</h5>
            <div id="info_session_active">
              <i class="fas fa-spinner fa-spin"></i> Chargement des informations de la session...
            </div>
          </div>
        </div>
      </div>

      <!-- Statistiques Rapides -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 id="stat_nbre_factures">0</h3>
              <p>Factures Normalisées</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-invoice"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3 id="stat_montant_ht">0.00 USD</h3>
              <p>Montant Total HT</p>
            </div>
            <div class="icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 id="stat_montant_tva">0.00 USD</h3>
              <p>Montant Total TVA</p>
            </div>
            <div class="icon">
              <i class="fas fa-percentage"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3 id="stat_montant_ttc">0.00 USD</h3>
              <p>Montant Total TTC</p>
            </div>
            <div class="icon">
              <i class="fas fa-money-bill-wave"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Détails du Rapport -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-chart-bar"></i> Détails X-Rapport</h3>
            </div>
            <div class="card-body">

              <!-- Onglets -->
              <ul class="nav nav-tabs" id="rapportTabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="tab-synthese" data-toggle="tab" href="#synthese" role="tab">
                    <i class="fas fa-chart-pie"></i> Synthèse
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="tab-type-facture" data-toggle="tab" href="#type-facture" role="tab">
                    <i class="fas fa-file"></i> Par Type de Facture
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="tab-taxation" data-toggle="tab" href="#taxation" role="tab">
                    <i class="fas fa-percent"></i> Par Groupe de Taxation
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="tab-paiement" data-toggle="tab" href="#paiement" role="tab">
                    <i class="fas fa-credit-card"></i> Par Mode de Paiement
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="tab-factures" data-toggle="tab" href="#factures" role="tab">
                    <i class="fas fa-list"></i> Liste des Factures
                  </a>
                </li>
              </ul>

              <!-- Contenu des onglets -->
              <div class="tab-content" id="rapportTabsContent">

                <!-- Synthèse -->
                <div class="tab-pane fade show active" id="synthese" role="tabpanel">
                  <div class="p-3">
                    <div id="synthese_rapport"></div>
                  </div>
                </div>

                <!-- Par Type de Facture -->
                <div class="tab-pane fade" id="type-facture" role="tabpanel">
                  <div class="p-3">
                    <div id="par_type_facture"></div>
                  </div>
                </div>

                <!-- Par Groupe de Taxation -->
                <div class="tab-pane fade" id="taxation" role="tabpanel">
                  <div class="p-3">
                    <div id="par_groupe_taxation"></div>
                  </div>
                </div>

                <!-- Par Mode de Paiement -->
                <div class="tab-pane fade" id="paiement" role="tabpanel">
                  <div class="p-3">
                    <div id="par_mode_paiement"></div>
                  </div>
                </div>

                <!-- Liste des Factures -->
                <div class="tab-pane fade" id="factures" role="tabpanel">
                  <div class="p-3">
                    <table id="table_factures_session" class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Réf. Facture</th>
                          <th>Date</th>
                          <th>Type</th>
                          <th>Client</th>
                          <th>Code DEF</th>
                          <th>Montant HT</th>
                          <th>TVA</th>
                          <th>TTC</th>
                        </tr>
                      </thead>
                      <tbody id="tbody_factures_session"></tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<!-- SweetAlert2 pour les notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Variables globales
let sessionActive = null;

// Au chargement de la page
$(document).ready(function() {
  $('#titre_rapport').text('X-RAPPORT DGI QUOTIDIEN (depuis dernier Z)');
  genererRapportX();
});

// Changer le mode de rapport
function changerModeRapport() {
  const mode = $('#mode_rapport').val();
  if (mode === 'periodique') {
    $('#section_date_debut').show();
    $('#section_date_fin').show();
    $('#section_info_session').hide();
    $('#titre_rapport').text('X-RAPPORT DGI PÉRIODIQUE');
  } else {
    $('#section_date_debut').hide();
    $('#section_date_fin').hide();
    $('#section_info_session').show();
    $('#titre_rapport').text('X-RAPPORT DGI QUOTIDIEN (depuis dernier Z)');
  }
}

// Générer le rapport X
function genererRapportX() {
  const mode = $('#mode_rapport').val();
  let data = { operation: 'generer_rapport_x' };

  // Si mode périodique, ajouter les dates
  if (mode === 'periodique') {
    const dateDebut = $('#date_debut_perso').val();
    const dateFin = $('#date_fin_perso').val();

    if (!dateDebut || !dateFin) {
      Swal.fire('Erreur', 'Veuillez sélectionner une période', 'error');
      return;
    }

    data.mode = 'periodique';
    data.date_debut = dateDebut;
    data.date_fin = dateFin;
  } else {
    data.mode = 'quotidien';
  }

  $.ajax({
    url: '../pages/ajax/generer_rapport_x.php',
    type: 'POST',
    dataType: 'json',
    data: data,
    beforeSend: function() {
      Swal.fire({
        title: 'Génération du X-Rapport',
        html: 'Calcul des statistiques en cours...',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
    },
    success: function(response) {
      Swal.close();

      if (response.success) {
        sessionActive = response.session;
        afficherRapport(response.rapport);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Erreur',
          text: response.error || 'Impossible de générer le rapport'
        });
      }
    },
    error: function(xhr, status, error) {
      Swal.close();
      Swal.fire({
        icon: 'error',
        title: 'Erreur serveur',
        text: 'Une erreur est survenue lors de la génération du rapport'
      });
    }
  });
}

// Afficher le rapport
function afficherRapport(rapport) {
  const mode = $('#mode_rapport').val();

  // Info session
  if (mode === 'periodique') {
    $('#info_session_active').html(`
      <strong>Rapport:</strong> X-Rapport Périodique |
      <strong>Période:</strong> ${rapport.session.date_debut} au ${rapport.session.date_fin} |
      <strong>Par:</strong> ${rapport.session.utilisateur_ouverture}
    `);
  } else {
    $('#info_session_active').html(`
      <strong>Session:</strong> ${rapport.session.numero_session} |
      <strong>Débutée le:</strong> ${rapport.session.date_debut} |
      <strong>Par:</strong> ${rapport.session.utilisateur_ouverture}
    `);
  }

  // Statistiques
  $('#stat_nbre_factures').text(rapport.statistiques.nbre_factures_total);
  $('#stat_montant_ht').text(formatMontant(rapport.statistiques.montant_total_ht) + ' USD');
  $('#stat_montant_tva').text(formatMontant(rapport.statistiques.montant_total_tva) + ' USD');
  $('#stat_montant_ttc').text(formatMontant(rapport.statistiques.montant_total_ttc) + ' USD');

  // Synthèse
  afficherSynthese(rapport);

  // Par type de facture
  afficherParTypeFacture(rapport);

  // Par groupe de taxation
  afficherParGroupeTaxation(rapport);

  // Par mode de paiement
  afficherParModePaiement(rapport);

  // Liste des factures
  afficherListeFactures(rapport.factures);
}

// Formater un montant
function formatMontant(montant) {
  return parseFloat(montant).toLocaleString('fr-FR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });
}

// Imprimer le rapport
function imprimerRapportX() {
  window.open('print_rapport_x.php', '_blank', 'width=900,height=700');
}

// Exporter en Excel
function exporterRapportX() {
  window.location.href = 'export_rapport_x.php';
}

// Afficher synthèse
function afficherSynthese(rapport) {
  const mode = $('#mode_rapport').val();
  const typeRapport = mode === 'periodique' ? 'X-Rapport Périodique' : 'X-Rapport Quotidien (depuis dernier Z)';
  const periode = mode === 'periodique'
    ? `${rapport.session.date_debut} au ${rapport.session.date_fin}`
    : `${rapport.session.date_debut} - Maintenant`;

  let html = `
    <div class="row">
      <div class="col-md-6">
        <h5>Informations Générales</h5>
        <table class="table table-sm">
          <tr><td><strong>Dénomination:</strong></td><td><?php echo defined('ENTREPRISE_NOM') ? ENTREPRISE_NOM : 'BELEJ'; ?></td></tr>
          <tr><td><strong>NIF:</strong></td><td><?php echo defined('ENTREPRISE_NIF') ? ENTREPRISE_NIF : 'A1809181A'; ?></td></tr>
          <tr><td><strong>ISF (e-MCF ID):</strong></td><td><?php echo defined('ENTREPRISE_EMCF_ID') ? ENTREPRISE_EMCF_ID : 'CD01002974-1'; ?></td></tr>
          <tr><td><strong>Type de Rapport:</strong></td><td>${typeRapport}</td></tr>
          <tr><td><strong>Période:</strong></td><td>${periode}</td></tr>
        </table>
      </div>
      <div class="col-md-6">
        <h5>Totaux</h5>
        <table class="table table-sm">
          <tr><td><strong>Nombre de factures:</strong></td><td>${rapport.statistiques.nbre_factures_total}</td></tr>
          <tr><td><strong>Montant HT:</strong></td><td>${formatMontant(rapport.statistiques.montant_total_ht)} USD</td></tr>
          <tr><td><strong>Montant TVA:</strong></td><td>${formatMontant(rapport.statistiques.montant_total_tva)} USD</td></tr>
          <tr><td><strong>Montant TTC:</strong></td><td class="font-weight-bold">${formatMontant(rapport.statistiques.montant_total_ttc)} USD</td></tr>
        </table>
      </div>
    </div>
  `;
  $('#synthese_rapport').html(html);
}

// Afficher par type de facture
function afficherParTypeFacture(rapport) {
  let html = '<table class="table table-bordered table-sm">';
  html += '<thead><tr><th>Type de Facture</th><th>Nombre</th><th>Montant HT</th><th>TVA</th><th>TTC</th></tr></thead><tbody>';

  $.each(rapport.par_type_facture, function(type, data) {
    html += `<tr>
      <td><strong>${type}</strong></td>
      <td>${data.nombre}</td>
      <td>${formatMontant(data.montant_ht)} USD</td>
      <td>${formatMontant(data.montant_tva)} USD</td>
      <td>${formatMontant(data.montant_ttc)} USD</td>
    </tr>`;
  });

  html += '</tbody></table>';
  $('#par_type_facture').html(html);
}

// Afficher par groupe de taxation
function afficherParGroupeTaxation(rapport) {
  let html = '<table class="table table-bordered table-sm">';
  html += '<thead><tr><th>Groupe</th><th>Description</th><th>Nombre</th><th>Montant HT</th><th>TVA</th><th>TTC</th></tr></thead><tbody>';

  $.each(rapport.par_groupe_taxation, function(groupe, data) {
    let description = groupe === 'A' ? 'Exonéré (0%)' : 'Taxable (16%)';
    html += `<tr>
      <td><strong>${groupe}</strong></td>
      <td>${description}</td>
      <td>${data.nombre}</td>
      <td>${formatMontant(data.montant_ht)} USD</td>
      <td>${formatMontant(data.montant_tva)} USD</td>
      <td>${formatMontant(data.montant_ttc)} USD</td>
    </tr>`;
  });

  html += '</tbody></table>';
  $('#par_groupe_taxation').html(html);
}

// Afficher par mode de paiement
function afficherParModePaiement(rapport) {
  let html = '<table class="table table-bordered table-sm">';
  html += '<thead><tr><th>Mode de Paiement</th><th>Montant</th></tr></thead><tbody>';

  if (rapport.par_mode_paiement && Object.keys(rapport.par_mode_paiement).length > 0) {
    $.each(rapport.par_mode_paiement, function(mode, montant) {
      html += `<tr><td>${mode}</td><td>${formatMontant(montant)} USD</td></tr>`;
    });
  } else {
    html += '<tr><td>ESPECES</td><td>' + formatMontant(rapport.statistiques.montant_total_ttc) + ' USD</td></tr>';
  }

  html += '</tbody></table>';
  $('#par_mode_paiement').html(html);
}

// Afficher liste des factures
function afficherListeFactures(factures) {
  let tbody = '';
  $.each(factures, function(i, facture) {
    tbody += `<tr>
      <td>${facture.ref_fact}</td>
      <td>${facture.date_fact}</td>
      <td>${facture.type_facture}</td>
      <td>${facture.nom_cli}</td>
      <td>${facture.code_def}</td>
      <td class="text-right">${formatMontant(facture.montant_ht)}</td>
      <td class="text-right">${formatMontant(facture.montant_tva)}</td>
      <td class="text-right">${formatMontant(facture.montant_ttc)}</td>
    </tr>`;
  });
  $('#tbody_factures_session').html(tbody);
}
</script>

<?php include("pied.php"); ?>
