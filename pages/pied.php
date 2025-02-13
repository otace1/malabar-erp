<!-- /.content-wrapper -->

<?php
  include('modalFacturation.php');
  include('modalMenu.php');
?>

  <footer class="main-footer text-xs">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 0.5
    </div>
    <strong>Copyright &copy; <font style="color: rgb(193, 0, 0) ">MALABAR</font> <font style="color: black;">GROUP</font> <?php date("Y");?> All rights
    reserved. Build by <a href="http://www.belej-consulting.com" onclick="window.open(this.href);return false;"> <font style="color: orange;">BELEJ - </font><font style="color: grey;">CONSULTING</font> </a></strong>
  </footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!--<script src="../plugins/jquery/jquery.min.js"></script>-->
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

  <!-- Toastr -->
  <script src="../plugins/toastr/toastr.min.js"></script>
  <!-- /Toastr -->


<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script language="javascript">
    !function(a,b){"use strict";"undefined"!=typeof module&&module.exports?module.exports=b(require("jquery")):"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):b(a.jQuery)}(this,function(a){"use strict";var b=function(c,d){this.$element=a(c),this.options=a.extend({},b.defaults,d),this.matcher=this.options.matcher||this.matcher,this.sorter=this.options.sorter||this.sorter,this.select=this.options.select||this.select,this.autoSelect="boolean"!=typeof this.options.autoSelect||this.options.autoSelect,this.highlighter=this.options.highlighter||this.highlighter,this.render=this.options.render||this.render,this.updater=this.options.updater||this.updater,this.displayText=this.options.displayText||this.displayText,this.source=this.options.source,this.delay=this.options.delay,this.$menu=a(this.options.menu),this.$appendTo=this.options.appendTo?a(this.options.appendTo):null,this.fitToElement="boolean"==typeof this.options.fitToElement&&this.options.fitToElement,this.shown=!1,this.listen(),this.showHintOnFocus=("boolean"==typeof this.options.showHintOnFocus||"all"===this.options.showHintOnFocus)&&this.options.showHintOnFocus,this.afterSelect=this.options.afterSelect,this.addItem=!1,this.value=this.$element.val()||this.$element.text()};b.prototype={constructor:b,select:function(){var a=this.$menu.find(".active").data("value");if(this.$element.data("active",a),this.autoSelect||a){var b=this.updater(a);b||(b=""),this.$element.val(this.displayText(b)||b).text(this.displayText(b)||b).change(),this.afterSelect(b)}return this.hide()},updater:function(a){return a},setSource:function(a){this.source=a},show:function(){var d,b=a.extend({},this.$element.position(),{height:this.$element[0].offsetHeight}),c="function"==typeof this.options.scrollHeight?this.options.scrollHeight.call():this.options.scrollHeight;if(this.shown?d=this.$menu:this.$appendTo?(d=this.$menu.appendTo(this.$appendTo),this.hasSameParent=this.$appendTo.is(this.$element.parent())):(d=this.$menu.insertAfter(this.$element),this.hasSameParent=!0),!this.hasSameParent){d.css("position","fixed");var e=this.$element.offset();b.top=e.top,b.left=e.left}var f=a(d).parent().hasClass("dropup"),g=f?"auto":b.top+b.height+c,h=a(d).hasClass("dropdown-menu-right"),i=h?"auto":b.left;return d.css({top:g,left:i}).show(),this.options.fitToElement===!0&&d.css("width",this.$element.outerWidth()+"px"),this.shown=!0,this},hide:function(){return this.$menu.hide(),this.shown=!1,this},lookup:function(b){if("undefined"!=typeof b&&null!==b?this.query=b:this.query=this.$element.val()||this.$element.text()||"",this.query.length<this.options.minLength&&!this.options.showHintOnFocus)return this.shown?this.hide():this;var d=a.proxy(function(){a.isFunction(this.source)?this.source(this.query,a.proxy(this.process,this)):this.source&&this.process(this.source)},this);clearTimeout(this.lookupWorker),this.lookupWorker=setTimeout(d,this.delay)},process:function(b){var c=this;return b=a.grep(b,function(a){return c.matcher(a)}),b=this.sorter(b),b.length||this.options.addItem?(b.length>0?this.$element.data("active",b[0]):this.$element.data("active",null),this.options.addItem&&b.push(this.options.addItem),"all"==this.options.items?this.render(b).show():this.render(b.slice(0,this.options.items)).show()):this.shown?this.hide():this},matcher:function(a){var b=this.displayText(a);return~b.toLowerCase().indexOf(this.query.toLowerCase())},sorter:function(a){for(var e,b=[],c=[],d=[];e=a.shift();){var f=this.displayText(e);f.toLowerCase().indexOf(this.query.toLowerCase())?~f.indexOf(this.query)?c.push(e):d.push(e):b.push(e)}return b.concat(c,d)},highlighter:function(a){var b=this.query;if(""===b)return a;var f,c=a.match(/(>)([^<]*)(<)/g),d=[],e=[];if(c&&c.length)for(f=0;f<c.length;++f)c[f].length>2&&d.push(c[f]);else d=[],d.push(a);var h,g=new RegExp(b,"g");for(f=0;f<d.length;++f)h=d[f].match(g),h&&h.length>0&&e.push(d[f]);for(f=0;f<e.length;++f)a=a.replace(e[f],e[f].replace(g,"<strong>$&</strong>"));return a},render:function(b){var c=this,d=this,e=!1,f=[],g=c.options.separator;return a.each(b,function(a,c){a>0&&c[g]!==b[a-1][g]&&f.push({__type:"divider"}),!c[g]||0!==a&&c[g]===b[a-1][g]||f.push({__type:"category",name:c[g]}),f.push(c)}),b=a(f).map(function(b,f){if("category"==(f.__type||!1))return a(c.options.headerHtml).text(f.name)[0];if("divider"==(f.__type||!1))return a(c.options.headerDivider)[0];var g=d.displayText(f);return b=a(c.options.item).data("value",f),b.find("a").html(c.highlighter(g,f)),g==d.$element.val()&&(b.addClass("active"),d.$element.data("active",f),e=!0),b[0]}),this.autoSelect&&!e&&(b.filter(":not(.dropdown-header)").first().addClass("active"),this.$element.data("active",b.first().data("value"))),this.$menu.html(b),this},displayText:function(a){return"undefined"!=typeof a&&"undefined"!=typeof a.name?a.name:a},next:function(b){var c=this.$menu.find(".active").removeClass("active"),d=c.next();d.length||(d=a(this.$menu.find("li")[0])),d.addClass("active")},prev:function(a){var b=this.$menu.find(".active").removeClass("active"),c=b.prev();c.length||(c=this.$menu.find("li").last()),c.addClass("active")},listen:function(){this.$element.on("focus",a.proxy(this.focus,this)).on("blur",a.proxy(this.blur,this)).on("keypress",a.proxy(this.keypress,this)).on("input",a.proxy(this.input,this)).on("keyup",a.proxy(this.keyup,this)),this.eventSupported("keydown")&&this.$element.on("keydown",a.proxy(this.keydown,this)),this.$menu.on("click",a.proxy(this.click,this)).on("mouseenter","li",a.proxy(this.mouseenter,this)).on("mouseleave","li",a.proxy(this.mouseleave,this)).on("mousedown",a.proxy(this.mousedown,this))},destroy:function(){this.$element.data("typeahead",null),this.$element.data("active",null),this.$element.off("focus").off("blur").off("keypress").off("input").off("keyup"),this.eventSupported("keydown")&&this.$element.off("keydown"),this.$menu.remove(),this.destroyed=!0},eventSupported:function(a){var b=a in this.$element;return b||(this.$element.setAttribute(a,"return;"),b="function"==typeof this.$element[a]),b},move:function(a){if(this.shown)switch(a.keyCode){case 9:case 13:case 27:a.preventDefault();break;case 38:if(a.shiftKey)return;a.preventDefault(),this.prev();break;case 40:if(a.shiftKey)return;a.preventDefault(),this.next()}},keydown:function(b){this.suppressKeyPressRepeat=~a.inArray(b.keyCode,[40,38,9,13,27]),this.shown||40!=b.keyCode?this.move(b):this.lookup()},keypress:function(a){this.suppressKeyPressRepeat||this.move(a)},input:function(a){var b=this.$element.val()||this.$element.text();this.value!==b&&(this.value=b,this.lookup())},keyup:function(a){if(!this.destroyed)switch(a.keyCode){case 40:case 38:case 16:case 17:case 18:break;case 9:case 13:if(!this.shown)return;this.select();break;case 27:if(!this.shown)return;this.hide()}},focus:function(a){this.focused||(this.focused=!0,this.options.showHintOnFocus&&this.skipShowHintOnFocus!==!0&&("all"===this.options.showHintOnFocus?this.lookup(""):this.lookup())),this.skipShowHintOnFocus&&(this.skipShowHintOnFocus=!1)},blur:function(a){this.mousedover||this.mouseddown||!this.shown?this.mouseddown&&(this.skipShowHintOnFocus=!0,this.$element.focus(),this.mouseddown=!1):(this.hide(),this.focused=!1)},click:function(a){a.preventDefault(),this.skipShowHintOnFocus=!0,this.select(),this.$element.focus(),this.hide()},mouseenter:function(b){this.mousedover=!0,this.$menu.find(".active").removeClass("active"),a(b.currentTarget).addClass("active")},mouseleave:function(a){this.mousedover=!1,!this.focused&&this.shown&&this.hide()},mousedown:function(a){this.mouseddown=!0,this.$menu.one("mouseup",function(a){this.mouseddown=!1}.bind(this))}};var c=a.fn.typeahead;a.fn.typeahead=function(c){var d=arguments;return"string"==typeof c&&"getActive"==c?this.data("active"):this.each(function(){var e=a(this),f=e.data("typeahead"),g="object"==typeof c&&c;f||e.data("typeahead",f=new b(this,g)),"string"==typeof c&&f[c]&&(d.length>1?f[c].apply(f,Array.prototype.slice.call(d,1)):f[c]())})},b.defaults={source:[],items:8,menu:'<ul class="typeahead dropdown-menu" role="listbox"></ul>',item:'<li><a class="dropdown-item" href="#" role="option"></a></li>',minLength:1,scrollHeight:0,autoSelect:!0,afterSelect:a.noop,addItem:!1,delay:0,separator:"category",headerHtml:'<li class="dropdown-header"></li>',headerDivider:'<li class="divider" role="separator"></li>'},a.fn.typeahead.Constructor=b,a.fn.typeahead.noConflict=function(){return a.fn.typeahead=c,this},a(document).on("focus.typeahead.data-api",'[data-provide="typeahead"]',function(b){var c=a(this);c.data("typeahead")||c.typeahead(c.data())})});
  </script>

<script>

    function modal_client_rapport_invoice(id_mod_lic){

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {id_mod_lic: id_mod_lic, operation: 'modal_client_rapport_invoice'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#tableau_client_rapport_invoice').html(data.tableau_client_rapport_invoice);
            $('#modal_client_rapport_invoice').modal("show");
            $('#id_mod_lic_search').val(id_mod_lic);
            document.getElementById("search_client_rapport_invoice").focus();
          }
        }
      });


    }

    function search_client_rapport_invoice(mot_cle){

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {id_mod_lic: $('#id_mod_lic_search').val(), mot_cle: mot_cle, operation: 'search_client_rapport_invoice'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#tableau_client_rapport_invoice').html(data.tableau_client_rapport_invoice);
            // $('#modal_client_rapport_invoice').modal("show");
            // document.getElementById("search_client_rapport_invoice").focus();
          }
        }
      });


    }

    function deroulerMenuLicence(id_mod_lic){

      $('#spinner-div').show();
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: { id_mod_lic: id_mod_lic, operation: 'deroulerMenuLicence'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#menuLicence_'+id_mod_lic).html(data.menuLicence);
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });


    }

    function messageSuccess(message){
      // toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
      toastr.success(message);
    }

    $(document).ready(function () {
        $('#txtCountry').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "server.php",
          data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });

</script>
<script>
  $(window).load(function() {
    $('#loading').hide();
  });
</script>

</body>
</html>
<?php
  //include("modal.php");
?>