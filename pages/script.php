
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  /*
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data_2').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data_2').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  */
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td class="col_1"></td>';
   html += '<td class="col_6"><input value="<?php echo $maClasse-> getMcaFile($_GET['id_cli'], $_GET['id_mod_trans']);?>" type="type" id="data1" class="form-control cc-exp"></td>';
   html += '<td><input type="date" class="form-control cc-exp"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data_2 tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var ref_dos = $('#data1').val();
   var last_name = $('#data2').text();
   var id_mod_trans = ''+<?php echo $_GET['id_mod_trans'];?>+'';
   var id_cli = ''+<?php echo $_GET['id_cli'];?>+'';
   var id_mod_lic = ''+<?php echo $_GET['id_mod_trac'];?>+'';
   var num_lic = 'UNDER VALUE';
   var id_util = ''+<?php echo $_SESSION['id_util'];?>+'';
   if(ref_dos != '' && last_name != '')
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{ref_dos:ref_dos, last_name:last_name, id_mod_trans:id_mod_trans, id_cli:id_cli, id_mod_lic:id_mod_lic, num_lic:num_lic, id_util:id_util},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data_2').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data_2').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
</script>
