<?php
/**
 * Page Historique des Sessions DGI
 * Liste de toutes les sessions fiscales (actives et clôturées)
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
          <i class="fas fa-history"></i> HISTORIQUE DES SESSIONS FISCALES DGI
          <span class="float-right">
            <button class="btn btn-sm btn-success" onclick="chargerSessions()">
              <i class="fas fa-sync"></i> Actualiser
            </button>
          </span>
        </h5>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- Session Actuelle -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-clock"></i> Session Actuelle</h3>
            </div>
            <div class="card-body">
              <div id="session_active_info">
                <i class="fas fa-spinner fa-spin"></i> Chargement...
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Statistiques Globales -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 id="stat_total_sessions">0</h3>
              <p>Total Sessions</p>
            </div>
            <div class="icon">
              <i class="fas fa-list"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3 id="stat_sessions_cloturees">0</h3>
              <p>Sessions Clôturées</p>
            </div>
            <div class="icon">
              <i class="fas fa-lock"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 id="stat_total_factures">0</h3>
              <p>Total Factures</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-invoice"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3 id="stat_total_montant">0.00 USD</h3>
              <p>Montant Total TTC</p>
            </div>
            <div class="icon">
              <i class="fas fa-money-bill-wave"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Liste des Sessions -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-list"></i> Toutes les Sessions</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="table_sessions" class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Numéro Session</th>
                      <th>Statut</th>
                      <th>Date Début</th>
                      <th>Date Fin</th>
                      <th>Utilisateur Ouverture</th>
                      <th>Utilisateur Clôture</th>
                      <th>Nbre Factures</th>
                      <th>Montant TTC</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="tbody_sessions"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Rapports Générés -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-file-alt"></i> Rapports Z Générés</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="table_rapports" class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Numéro Rapport</th>
                      <th>Type</th>
                      <th>Session</th>
                      <th>Date Génération</th>
                      <th>Utilisateur</th>
                      <th>Nbre Factures</th>
                      <th>Montant Total</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="tbody_rapports"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<!-- Modal Détails Session -->
<div class="modal fade" id="modal_details_session">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title"><i class="fas fa-info-circle"></i> Détails de la Session</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modal_body_session">
        <!-- Contenu chargé dynamiquement -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Au chargement
$(document).ready(function() {
  chargerSessions();
  chargerRapports();
});

// Charger les sessions
function chargerSessions() {
  $.ajax({
    url: '../pages/ajax/lister_sessions.php',
    type: 'POST',
    dataType: 'json',
    data: { operation: 'lister_sessions' },
    success: function(response) {
      if (response.success) {
        afficherSessions(response.sessions, response.statistiques);
        afficherSessionActive(response.session_active);
      } else {
        Swal.fire('Erreur', response.error || 'Impossible de charger les sessions', 'error');
      }
    },
    error: function() {
      Swal.fire('Erreur', 'Erreur serveur', 'error');
    }
  });
}

// Afficher session active
function afficherSessionActive(session) {
  if (session) {
    $('#session_active_info').html(`
      <div class="row">
        <div class="col-md-6">
          <p><strong>Numéro:</strong> ${session.numero_session}</p>
          <p><strong>Débutée le:</strong> ${session.date_debut}</p>
          <p><strong>Par:</strong> ${session.utilisateur_ouverture || 'N/A'}</p>
        </div>
        <div class="col-md-6">
          <p><strong>Factures:</strong> ${session.nbre_factures_total || 0}</p>
          <p><strong>Montant HT:</strong> ${formatMontant(session.montant_total_ht || 0)} USD</p>
          <p><strong>Montant TTC:</strong> ${formatMontant(session.montant_total_ttc || 0)} USD</p>
        </div>
      </div>
      <div class="text-right mt-2">
        <a href="rapports_dgi_x.php" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Voir X-Rapport</a>
        <a href="rapports_dgi_z.php" class="btn btn-sm btn-danger"><i class="fas fa-lock"></i> Clôturer (Z-Rapport)</a>
      </div>
    `);
  } else {
    $('#session_active_info').html('<p class="text-danger">Aucune session active</p>');
  }
}

// Afficher toutes les sessions
function afficherSessions(sessions, stats) {
  // Statistiques
  $('#stat_total_sessions').text(stats.total_sessions);
  $('#stat_sessions_cloturees').text(stats.sessions_cloturees);
  $('#stat_total_factures').text(stats.total_factures);
  $('#stat_total_montant').text(formatMontant(stats.montant_total_ttc));

  // Liste
  let tbody = '';
  $.each(sessions, function(i, session) {
    const badge = session.statut_session === 'active'
      ? '<span class="badge badge-success">Active</span>'
      : '<span class="badge badge-secondary">Clôturée</span>';

    tbody += `<tr>
      <td><strong>${session.numero_session}</strong></td>
      <td>${badge}</td>
      <td>${session.date_debut}</td>
      <td>${session.date_fin || '-'}</td>
      <td>${session.utilisateur_ouverture || '-'}</td>
      <td>${session.utilisateur_cloture || '-'}</td>
      <td>${session.nbre_factures_total || 0}</td>
      <td class="text-right">${formatMontant(session.montant_total_ttc || 0)}</td>
      <td>
        <button class="btn btn-xs btn-info" onclick="voirDetailsSession(${session.id_session})">
          <i class="fas fa-eye"></i> Détails
        </button>
      </td>
    </tr>`;
  });

  $('#tbody_sessions').html(tbody);
}

// Charger les rapports
function chargerRapports() {
  $.ajax({
    url: '../pages/ajax/lister_sessions.php',
    type: 'POST',
    dataType: 'json',
    data: { operation: 'lister_rapports' },
    success: function(response) {
      if (response.success) {
        afficherRapports(response.rapports);
      }
    }
  });
}

// Afficher les rapports
function afficherRapports(rapports) {
  let tbody = '';
  $.each(rapports, function(i, rapport) {
    const badge_type = rapport.type_rapport === 'Z'
      ? '<span class="badge badge-danger">Z</span>'
      : rapport.type_rapport === 'X'
      ? '<span class="badge badge-success">X</span>'
      : '<span class="badge badge-warning">A</span>';

    tbody += `<tr>
      <td><strong>${rapport.numero_rapport}</strong></td>
      <td>${badge_type}</td>
      <td>${rapport.numero_session}</td>
      <td>${rapport.date_generation}</td>
      <td>${rapport.utilisateur || '-'}</td>
      <td>${rapport.nbre_factures || 0}</td>
      <td class="text-right">${formatMontant(rapport.montant_total || 0)}</td>
      <td>
        <button class="btn btn-xs btn-primary" onclick="voirRapport(${rapport.id_rapport})">
          <i class="fas fa-file-pdf"></i> PDF
        </button>
      </td>
    </tr>`;
  });

  $('#tbody_rapports').html(tbody);
}

// Voir détails session
function voirDetailsSession(id_session) {
  $('#modal_body_session').html('<p class="text-center"><i class="fas fa-spinner fa-spin"></i> Chargement...</p>');
  $('#modal_details_session').modal('show');

  $.ajax({
    url: '../pages/ajax/lister_sessions.php',
    type: 'POST',
    dataType: 'json',
    data: {
      operation: 'details_session',
      id_session: id_session
    },
    success: function(response) {
      if (response.success) {
        const session = response.session;
        let html = `
          <h5>Session ${session.numero_session}</h5>
          <div class="row">
            <div class="col-md-6">
              <table class="table table-sm">
                <tr><td><strong>Statut:</strong></td><td>${session.statut_session}</td></tr>
                <tr><td><strong>Date début:</strong></td><td>${session.date_debut}</td></tr>
                <tr><td><strong>Date fin:</strong></td><td>${session.date_fin || 'En cours'}</td></tr>
                <tr><td><strong>Ouvert par:</strong></td><td>${session.utilisateur_ouverture || '-'}</td></tr>
                <tr><td><strong>Clôturé par:</strong></td><td>${session.utilisateur_cloture || '-'}</td></tr>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-sm">
                <tr><td><strong>Nombre de factures:</strong></td><td>${session.nbre_factures_total || 0}</td></tr>
                <tr><td><strong>Factures FV:</strong></td><td>${session.nbre_factures_fv || 0}</td></tr>
                <tr><td><strong>Factures FA:</strong></td><td>${session.nbre_factures_fa || 0}</td></tr>
                <tr><td><strong>Montant HT:</strong></td><td>${formatMontant(session.montant_total_ht || 0)} USD</td></tr>
                <tr><td><strong>Montant TVA:</strong></td><td>${formatMontant(session.montant_total_tva || 0)} USD</td></tr>
                <tr><td><strong>Montant TTC:</strong></td><td class="font-weight-bold">${formatMontant(session.montant_total_ttc || 0)} USD</td></tr>
              </table>
            </div>
          </div>
        `;
        $('#modal_body_session').html(html);
      }
    }
  });
}

// Voir rapport PDF
function voirRapport(id_rapport) {
  window.open(`../pages/print_rapport_z.php?id_rapport=${id_rapport}`, '_blank');
}

// Formater montant
function formatMontant(montant) {
  return parseFloat(montant).toLocaleString('fr-FR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });
}
</script>

<?php include("pied.php"); ?>
