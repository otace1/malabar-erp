<?php
  include("tetePopCDN.php");
  //include("licenceExcel.php");
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5><i class="fa fa-folder-open nav-icon"></i> 
                  <?php 
                  if ($_GET['statut']=='Factures') {
                    if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                      echo 'Invoices';
                    }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                      echo 'Factures';
                    }
                  }else if ($_GET['statut']=='Dossiers Facturés') {
                    if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                      echo 'Invoiced Files';
                    }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                      echo 'Dossiers Facturés';
                    }
                  }else if ($_GET['statut']=='Dossiers Non Facturés') {
                    if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                      echo 'Pending Files';
                    }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                      echo 'Dossiers Non Facturés';
                    }
                  }
                  ?>
                </h5>

                <div class="card-tools">
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="file_data" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm small text-nowrap">
                  <thead>
                    <tr>
                      <?php
                      if ($_GET['statut']=='Factures') {
                      ?>
                      <th style="">#</th>
                      <th style="">Inv.Ref.</th>
                      <th style="">Date</th>
                      <th style="">Client</th>
                      <th style="">Encoded By</th>
                      <th style="">Rate(CDF/USD)</th>
                      <th style="">Duty VAT Excl(CDF)</th>
                      <th style="">Duty VAT Excl(USD)</th>
                      <th style="">VAT Duty(CDF)</th>
                      <th style="">VAT Duty(USD)</th>
                      <th style="">Total Duty(CDF)</th>
                      <th style="">Total Duty(USD)</th>
                      <th style="">Other Charges VAT Excl</th>
                      <th style="">VAT Other Charges</th>
                      <th style="">Total Other Charges</th>
                      <th style="">OPS Costs VAT Excl</th>
                      <th style="">VAT OPS Costs</th>
                      <th style="">Total OPS Costs</th>
                      <th style="">Service Fees VAT Excl</th>
                      <th style="">VAT Service Fees</th>
                      <th style="">Total Service Fees</th>
                      <th style="">Total VAT Excl</th>
                      <th style="">VAT</th>
                      <th style="">Grand Total</th>
                      <th style="">Status</th>
                      <th style="">Action</th>
                      <?php
                      }else if ($_GET['statut']=='Dossiers Facturés' && $_GET['id_mod_lic']=='1') {
                      ?>
                      <th>#</th>
                      <th>Notre Nº Ref #</th>
                      <th>Lot Num.</th>
                      <th>License Num.</th>
                      <th>Client</th>
                      <th>Encoded By</th>
                      <th>Declaration Ref.</th>
                      <th>Declaration Date</th>
                      <th>Liquidation Ref.</th>
                      <th>Liquidation Date</th>
                      <th>Quittance Ref.</th>
                      <th>Quittance Date</th>
                      <th>FACTURE Nº</th>
                      <th>INV. DATE</th>
                      <th>Nombre de Trucks</th>
                      <th>Dossier(s):</th>
                      <th>Qty(Mt)</th>
                      <th>LIQ AMT CDF</th>
                      <th>Rate(CDF/USD)</th>
                      <th>AVG Ton Per USD</th>
                      <th>Ton Per USD</th>
                      <th>LIQ AMT/USD</th>
                      <th>RIE-Ton Per USD</th>
                      <th>RIE-Amount</th>
                      <th>RLS-Ton Per USD</th>
                      <th>RLS-Amount</th>
                      <th>FSR-Ton Per USD</th>
                      <th>FSR-Amount</th>
                      <th>OGREFREM-Ton Per USD</th>
                      <th>OGREFREM-Amount</th>
                      <th>LMC-Ton Per USD</th>
                      <th>LMC-Amount</th>
                      <th>Tax Voire-Ton Per USD</th>
                      <th>Tax Voire-Amount</th>
                      <th>CEEC</th>
                      <th>FINANCE COST</th>
                      <th>OCC</th>
                      <th>CGEA</th>
                      <th>DGDA Security Seals</th>
                      <th>ASSAY FEE</th>
                      <th>Customs Clearence FEE</th>
                      <th>OTHER CHARGES / AUTRES FRAIS</th>
                      <th>TVA/USD</th>
                      <th>Total</th>
                      <th>OPERATIONAL COSTS / COUT OPERATIONEL</th>
                      <th>TVA/USD</th>
                      <th>Total</th>
                      <th>AGENCY FEE</th>
                      <th>TVA/USD</th>
                      <th>Total</th>
                      <th>Total Invoice</th>
                      <th>Container</th>
                      <th>Feet</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Supporting Doc</th>
                      <?php
                      }else if ($_GET['statut']=='Dossiers Facturés' && $_GET['id_mod_lic']=='2') {
                      ?>
                      <th style="">#</th>
                      <th style="">Notre Nº Ref #</th>
                      <th style="">Tally Ref #</th>
                      <th>Client</th>
                      <th>Encoded By</th>
                      <th>Product Category</th>
                      <th>Commodity</th>
                      <th>Tarif Code</th>
                      <th>Poids</th>
                      <th>FOB (USD)</th>
                      <th>Scelle Electr.</th>
                      <th>Scelle Electr. Amount</th>
                      <th>Frais Tresco</th>
                      <th>Declaration Ref.</th>
                      <th>Declaration Date</th>
                      <th>Liquidation Ref.</th>
                      <th>Liquidation Date</th>
                      <th>Quittance Ref.</th>
                      <th>Quittance Date</th>
                      <th style="">FACTURE Nº</th>
                      <th style="">INV. DATE</th>
                      <th style="">PO REF #</th>
                      <th style="">LIQ AMT CDF</th>
                      <th style="">Rate(CDF/USD)</th>
                      <th style="">LIQ AMT/USD</th>
                      <th style="">OTHER CHARGES / AUTRES FRAIS</th>
                      <th style="">TVA/USD</th>
                      <th style="">Total</th>
                      <th style="">OPERATIONAL COSTS / COUT OPERATIONEL</th>
                      <th style="">TVA/USD</th>
                      <th style="">Total</th>
                      <th style="">Agency fee</th>
                      <th style="">TVA/USD</th>
                      <th style="">Total</th>
                      <th style="">Total Invoice</th>
                      <th style="">Status</th>
                      <th style=""></th>
                      <?php
                      }else if ($_GET['statut']=='Dossiers Non Facturés') {
                      ?>
                      <th style="">#</th>
                      <th style="">MCA File Ref.</th>
                      <th style="">Tally Ref.</th>
                      <th style="">Support Documents</th>
                      <th style="">Lot Num. / Inv.No.</th>
                      <th style="">PO.No.</th>
                      <th style="">Client</th>
                      <th style="">Commodity</th>
                      <th style="">Truck / Wagon / AWB</th>
                      <th style="">E.Ref.</th>
                      <th style="">E.Date</th>
                      <th style="">L.Ref.</th>
                      <th style="">L.Date</th>
                      <th style="">L.Amount</th>
                      <th style="">Q.Ref.</th>
                      <th style="">Q.Date</th>
                      <th style="">Delay</th>
                      <th style="">Q.Encoding Date</th>
                      <th style="">BS Date</th>
                      <th style="">Dispatch/Delivery Date</th>
                      <th style="">Clearing Status</th>
                      <th style="">General Status</th>
                      <th style="">Site</th>
                      <?php
                      }else if ($_GET['statut']=='Excel Invoice') {
                      ?>
                      <th style="">#</th>
                      <th style="">MCA File Ref.</th>
                      <th style="">Tally Ref.</th>
                      <th style="">Excel Inv. Ref.</th>
                      <th style="">Support Documents</th>
                      <th style="">Lot Num. / Inv.No.</th>
                      <th style="">PO.No.</th>
                      <th style="">Client</th>
                      <th style="">Commodity</th>
                      <th style="">Truck / Wagon / AWB</th>
                      <th style="">E.Ref.</th>
                      <th style="">E.Date</th>
                      <th style="">L.Ref.</th>
                      <th style="">L.Date</th>
                      <th style="">L.Amount</th>
                      <th style="">Q.Ref.</th>
                      <th style="">Q.Date</th>
                      <th style="">Delay</th>
                      <th style="">Q.Encoding Date</th>
                      <?php
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // $maClasse-> afficherStatutDossierFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script language="javascript">
    !function(a,b){"use strict";"undefined"!=typeof module&&module.exports?module.exports=b(require("jquery")):"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):b(a.jQuery)}(this,function(a){"use strict";var b=function(c,d){this.$element=a(c),this.options=a.extend({},b.defaults,d),this.matcher=this.options.matcher||this.matcher,this.sorter=this.options.sorter||this.sorter,this.select=this.options.select||this.select,this.autoSelect="boolean"!=typeof this.options.autoSelect||this.options.autoSelect,this.highlighter=this.options.highlighter||this.highlighter,this.render=this.options.render||this.render,this.updater=this.options.updater||this.updater,this.displayText=this.options.displayText||this.displayText,this.source=this.options.source,this.delay=this.options.delay,this.$menu=a(this.options.menu),this.$appendTo=this.options.appendTo?a(this.options.appendTo):null,this.fitToElement="boolean"==typeof this.options.fitToElement&&this.options.fitToElement,this.shown=!1,this.listen(),this.showHintOnFocus=("boolean"==typeof this.options.showHintOnFocus||"all"===this.options.showHintOnFocus)&&this.options.showHintOnFocus,this.afterSelect=this.options.afterSelect,this.addItem=!1,this.value=this.$element.val()||this.$element.text()};b.prototype={constructor:b,select:function(){var a=this.$menu.find(".active").data("value");if(this.$element.data("active",a),this.autoSelect||a){var b=this.updater(a);b||(b=""),this.$element.val(this.displayText(b)||b).text(this.displayText(b)||b).change(),this.afterSelect(b)}return this.hide()},updater:function(a){return a},setSource:function(a){this.source=a},show:function(){var d,b=a.extend({},this.$element.position(),{height:this.$element[0].offsetHeight}),c="function"==typeof this.options.scrollHeight?this.options.scrollHeight.call():this.options.scrollHeight;if(this.shown?d=this.$menu:this.$appendTo?(d=this.$menu.appendTo(this.$appendTo),this.hasSameParent=this.$appendTo.is(this.$element.parent())):(d=this.$menu.insertAfter(this.$element),this.hasSameParent=!0),!this.hasSameParent){d.css("position","fixed");var e=this.$element.offset();b.top=e.top,b.left=e.left}var f=a(d).parent().hasClass("dropup"),g=f?"auto":b.top+b.height+c,h=a(d).hasClass("dropdown-menu-right"),i=h?"auto":b.left;return d.css({top:g,left:i}).show(),this.options.fitToElement===!0&&d.css("width",this.$element.outerWidth()+"px"),this.shown=!0,this},hide:function(){return this.$menu.hide(),this.shown=!1,this},lookup:function(b){if("undefined"!=typeof b&&null!==b?this.query=b:this.query=this.$element.val()||this.$element.text()||"",this.query.length<this.options.minLength&&!this.options.showHintOnFocus)return this.shown?this.hide():this;var d=a.proxy(function(){a.isFunction(this.source)?this.source(this.query,a.proxy(this.process,this)):this.source&&this.process(this.source)},this);clearTimeout(this.lookupWorker),this.lookupWorker=setTimeout(d,this.delay)},process:function(b){var c=this;return b=a.grep(b,function(a){return c.matcher(a)}),b=this.sorter(b),b.length||this.options.addItem?(b.length>0?this.$element.data("active",b[0]):this.$element.data("active",null),this.options.addItem&&b.push(this.options.addItem),"all"==this.options.items?this.render(b).show():this.render(b.slice(0,this.options.items)).show()):this.shown?this.hide():this},matcher:function(a){var b=this.displayText(a);return~b.toLowerCase().indexOf(this.query.toLowerCase())},sorter:function(a){for(var e,b=[],c=[],d=[];e=a.shift();){var f=this.displayText(e);f.toLowerCase().indexOf(this.query.toLowerCase())?~f.indexOf(this.query)?c.push(e):d.push(e):b.push(e)}return b.concat(c,d)},highlighter:function(a){var b=this.query;if(""===b)return a;var f,c=a.match(/(>)([^<]*)(<)/g),d=[],e=[];if(c&&c.length)for(f=0;f<c.length;++f)c[f].length>2&&d.push(c[f]);else d=[],d.push(a);var h,g=new RegExp(b,"g");for(f=0;f<d.length;++f)h=d[f].match(g),h&&h.length>0&&e.push(d[f]);for(f=0;f<e.length;++f)a=a.replace(e[f],e[f].replace(g,"<strong>$&</strong>"));return a},render:function(b){var c=this,d=this,e=!1,f=[],g=c.options.separator;return a.each(b,function(a,c){a>0&&c[g]!==b[a-1][g]&&f.push({__type:"divider"}),!c[g]||0!==a&&c[g]===b[a-1][g]||f.push({__type:"category",name:c[g]}),f.push(c)}),b=a(f).map(function(b,f){if("category"==(f.__type||!1))return a(c.options.headerHtml).text(f.name)[0];if("divider"==(f.__type||!1))return a(c.options.headerDivider)[0];var g=d.displayText(f);return b=a(c.options.item).data("value",f),b.find("a").html(c.highlighter(g,f)),g==d.$element.val()&&(b.addClass("active"),d.$element.data("active",f),e=!0),b[0]}),this.autoSelect&&!e&&(b.filter(":not(.dropdown-header)").first().addClass("active"),this.$element.data("active",b.first().data("value"))),this.$menu.html(b),this},displayText:function(a){return"undefined"!=typeof a&&"undefined"!=typeof a.name?a.name:a},next:function(b){var c=this.$menu.find(".active").removeClass("active"),d=c.next();d.length||(d=a(this.$menu.find("li")[0])),d.addClass("active")},prev:function(a){var b=this.$menu.find(".active").removeClass("active"),c=b.prev();c.length||(c=this.$menu.find("li").last()),c.addClass("active")},listen:function(){this.$element.on("focus",a.proxy(this.focus,this)).on("blur",a.proxy(this.blur,this)).on("keypress",a.proxy(this.keypress,this)).on("input",a.proxy(this.input,this)).on("keyup",a.proxy(this.keyup,this)),this.eventSupported("keydown")&&this.$element.on("keydown",a.proxy(this.keydown,this)),this.$menu.on("click",a.proxy(this.click,this)).on("mouseenter","li",a.proxy(this.mouseenter,this)).on("mouseleave","li",a.proxy(this.mouseleave,this)).on("mousedown",a.proxy(this.mousedown,this))},destroy:function(){this.$element.data("typeahead",null),this.$element.data("active",null),this.$element.off("focus").off("blur").off("keypress").off("input").off("keyup"),this.eventSupported("keydown")&&this.$element.off("keydown"),this.$menu.remove(),this.destroyed=!0},eventSupported:function(a){var b=a in this.$element;return b||(this.$element.setAttribute(a,"return;"),b="function"==typeof this.$element[a]),b},move:function(a){if(this.shown)switch(a.keyCode){case 9:case 13:case 27:a.preventDefault();break;case 38:if(a.shiftKey)return;a.preventDefault(),this.prev();break;case 40:if(a.shiftKey)return;a.preventDefault(),this.next()}},keydown:function(b){this.suppressKeyPressRepeat=~a.inArray(b.keyCode,[40,38,9,13,27]),this.shown||40!=b.keyCode?this.move(b):this.lookup()},keypress:function(a){this.suppressKeyPressRepeat||this.move(a)},input:function(a){var b=this.$element.val()||this.$element.text();this.value!==b&&(this.value=b,this.lookup())},keyup:function(a){if(!this.destroyed)switch(a.keyCode){case 40:case 38:case 16:case 17:case 18:break;case 9:case 13:if(!this.shown)return;this.select();break;case 27:if(!this.shown)return;this.hide()}},focus:function(a){this.focused||(this.focused=!0,this.options.showHintOnFocus&&this.skipShowHintOnFocus!==!0&&("all"===this.options.showHintOnFocus?this.lookup(""):this.lookup())),this.skipShowHintOnFocus&&(this.skipShowHintOnFocus=!1)},blur:function(a){this.mousedover||this.mouseddown||!this.shown?this.mouseddown&&(this.skipShowHintOnFocus=!0,this.$element.focus(),this.mouseddown=!1):(this.hide(),this.focused=!1)},click:function(a){a.preventDefault(),this.skipShowHintOnFocus=!0,this.select(),this.$element.focus(),this.hide()},mouseenter:function(b){this.mousedover=!0,this.$menu.find(".active").removeClass("active"),a(b.currentTarget).addClass("active")},mouseleave:function(a){this.mousedover=!1,!this.focused&&this.shown&&this.hide()},mousedown:function(a){this.mouseddown=!0,this.$menu.one("mouseup",function(a){this.mouseddown=!1}.bind(this))}};var c=a.fn.typeahead;a.fn.typeahead=function(c){var d=arguments;return"string"==typeof c&&"getActive"==c?this.data("active"):this.each(function(){var e=a(this),f=e.data("typeahead"),g="object"==typeof c&&c;f||e.data("typeahead",f=new b(this,g)),"string"==typeof c&&f[c]&&(d.length>1?f[c].apply(f,Array.prototype.slice.call(d,1)):f[c]())})},b.defaults={source:[],items:8,menu:'<ul class="typeahead dropdown-menu" role="listbox"></ul>',item:'<li><a class="dropdown-item" href="#" role="option"></a></li>',minLength:1,scrollHeight:0,autoSelect:!0,afterSelect:a.noop,addItem:!1,delay:0,separator:"category",headerHtml:'<li class="dropdown-header"></li>',headerDivider:'<li class="divider" role="separator"></li>'},a.fn.typeahead.Constructor=b,a.fn.typeahead.noConflict=function(){return a.fn.typeahead=c,this},a(document).on("focus.typeahead.data-api",'[data-provide="typeahead"]',function(b){var c=a(this);c.data("typeahead")||c.typeahead(c.data())})});
  </script>
  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  $id_mod_lic = NULL;
  if (isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic']!='')) {
    $id_mod_lic = $_GET['id_mod_lic'];
  }
  $id_util = NULL;
  if (isset($_GET['id_util']) && ($_GET['id_util']!='')) {
    $id_util = $_GET['id_util'];
  }
  $debut = NULL;
  if (isset($_GET['debut']) && ($_GET['debut']!='')) {
    $debut = $_GET['debut'];
  }
  $fin = NULL;
  if (isset($_GET['fin']) && ($_GET['fin']!='')) {
    $fin = $_GET['fin'];
  }
  ?>

    <script type="text/javascript">
      var today   = new Date();
      document.title = "<?php echo $_GET['statut'];?>_" + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
    $('#spinner-div').show();
      $('#file_data').DataTable({
         lengthMenu: [
            [10, 100, 500, -1],
            [10, 100, 500, 'All'],
        ],
        dom: 'Bfrtip',
        buttons: [
            'excel',
            'pageLength', 'colvis'
        ],
        fixedColumns: {
          left: 3
        },
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        // scrollY: 300,

      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      // "responsive": true,
        "ajax":{
          "type": "GET",
          "url":"ajax.php",
          "method":"post",
          "dataSrc":{
              "id_cli": ""
          },
          "data": {
              "id_cli": "",
              "statut": "<?php echo $_GET['statut'];?>",
              "id_cli": "<?php echo $_GET['id_cli'];?>",
              "id_mod_lic": "<?php echo $id_mod_lic;?>",
              "id_util": "<?php echo $id_util;?>",
              "debut": "<?php echo $debut;?>",
              "fin": "<?php echo $fin;?>",
              "operation": "popUpFacture"
          }
        },
        <?php
          if ($_GET['statut']=='Factures'){
            ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_fact"},
          {"data":"date_fact"},
          {"data":"nom_cli"},
          {"data":"nom_util"},
          {"data":"roe_decl",
            render: DataTable.render.number( null, null, 4, null ),
            className: 'dt-body-right'},
          {"data":"duty_vat_excl_cdf",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"duty_vat_excl_usd",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"duty_vat_cdf",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"duty_vat_usd",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"total_duty_cdf",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"total_duty_usd",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"other_charge_vat_excl",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"other_charge_vat",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"total_other_charge",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"ops_vat_excl",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"ops_vat",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"total_ops",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"service_vat_excl",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"service_vat",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"total_service",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"montant_ht",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"tva_usd",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"montant",
            render: DataTable.render.number( null, null, 2, '$' ),
            className: 'dt-body-right'},
          {"data":"statut"},
          {"data":"view_page"}
        ] 
            <?php
          }else if ($_GET['statut']=='Dossiers Facturés' && $_GET['id_mod_lic']=='2'){
            ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"mca_b_ref"},
          {"data":"nom_cli"},
          {"data":"nom_util"},
          {"data":"nom_march"},
          {"data":"commodity"},
          {"data":"code_tarif"},
          {"data":"poids",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"fob_en_usd",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"nbre_scelle",
            render: DataTable.render.number( null, null, 0, null ),
            className: 'dt-body-center'
          },
          {"data":"scelle",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"tresco",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"ref_decl"},
          {"data":"date_decl"},
          {"data":"ref_liq"},
          {"data":"date_liq"},
          {"data":"ref_quit"},
          {"data":"date_quit"},
          {"data":"ref_fact"},
          {"data":"date_fact"},
          {"data":"po_ref"},
          {"data":"liquidation_cdf",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"roe_decl",
            // render: DataTable.render.number( null, null, 4, null ),
            className: 'dt-body-right',
            render: DataTable.render.number( null, null, 4, null )
          },
          {"data":"liquidation_usd",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"other_charge",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"tva_other_charge",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"total_other_charge",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"ops_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"tva_ops_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"total_ops_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"agency_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"tva_agency_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"total_agency_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"montant_total",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"statut"},
          {"data":"view_page"}
        ] 
            <?php
          }else if ($_GET['statut']=='Dossiers Facturés' && $_GET['id_mod_lic']=='1'){
            ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"num_lot"},
          {"data":"num_lic"},
          {"data":"nom_cli"},
          {"data":"nom_util"},
          {"data":"ref_decl"},
          {"data":"date_decl"},
          {"data":"ref_liq"},
          {"data":"date_liq"},
          {"data":"ref_quit"},
          {"data":"date_quit"},
          {"data":"ref_fact"},
          {"data":"date_fact"},
          {"data":"nbre_dossier",
            render: DataTable.render.number( null, null, 0, null ),
            className: 'dt-body-center'
          },
          {"data":"liste_dossier"},
          {"data":"poids",
            render: DataTable.render.number( null, null, 3, null ),
            className: 'dt-body-right'
          },
          {"data":"liquidation_cdf",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"roe_decl",
            className: 'dt-body-right',
            render: DataTable.render.number( null, null, 4, null )
          },
          {"data":"avg_liquidation_usd_per_ton",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right text-primary'
          },
          {"data":"liquidation_usd_per_ton",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"liquidation_usd",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"rie_per_ton",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"rie",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"rls_per_ton",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"rls",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"fsr_per_ton",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"fsr",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"feri_per_ton",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"feri",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"lmc_per_ton",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"lmc",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"voirie_per_ton",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"voirie",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"ceec",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"finance_cost",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"occ_sample",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"cgea",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"dgda_seal",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"assay",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"clearing_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"other_charge",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"tva_other_charge",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"total_other_charge",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"ops_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"tva_ops_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"total_ops_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"agency_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"tva_agency_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"total_agency_fee",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"montant_total",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"container"},
          {"data":"pied_container"},
          {"data":"ogefrem_contenair",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"statut"},
          {"data":"view_page",
            className: 'dt-body-center'
          }
        ] 
            <?php
          }else if ($_GET['statut']=='Dossiers Non Facturés'){
            ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"mca_b_ref"},
          {"data":"support_doc"},
          {"data":"po_ref"},
          {"data":"num_lot"},
          {"data":"nom_cli"},
          {"data":"commodity"},
          {"data":"truck"},
          {"data":"ref_decl"},
          {"data":"date_decl"},
          {"data":"ref_liq"},
          {"data":"date_liq"},
          {"data":"montant_liq",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"ref_quit"},
          {"data":"date_quit"},
          {"data":"delay"},
          {"data":"date_log"},
          {"data":"dispatch_date"},
          {"data":"dispatch_deliv"},
          {"data":"cleared_status"},
          {"data":"statut"},
          {"data":"nom_site"}
        ] 
            <?php
          }else if ($_GET['statut']=='Excel Invoice'){
            ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"mca_b_ref"},
          {"data":"ref_fact_excel"},
          {"data":"support_doc"},
          {"data":"po_ref"},
          {"data":"num_lot"},
          {"data":"nom_cli"},
          {"data":"commodity"},
          {"data":"truck"},
          {"data":"ref_decl"},
          {"data":"date_decl"},
          {"data":"ref_liq"},
          {"data":"date_liq"},
          {"data":"montant_liq",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"ref_quit"},
          {"data":"date_quit"},
          {"data":"delay"},
          {"data":"date_log"}
        ] 
            <?php
          }
        ?>
      });
      $('#spinner-div').hide();
    </script>
