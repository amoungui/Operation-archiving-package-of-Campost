<script>
var url;
function newUser2(){
        $('#dlg2').dialog('open').dialog('setTitle','nouvelle information');
        $('#fm2').form('clear');
        url = 'application/lib.out-put/save_user.php';
}
function editUser2(){
        var row = $('#dg2').datagrid('getSelected');
        if (row){
                $('#dlg2').dialog('open').dialog('setTitle','nouvelle information');
                $('#fm2').form('load',row);
                url = 'application/lib.out-put/update_user.php?idint='+row.idint;
        }
}
function saveUser2(){
			$('#fm2').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg2').dialog('close');		// close the dialog
						$('#dg2').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
function removeUser2(){
        var row = $('#dg2').datagrid('getSelected');
        if (row){
                $.messager.confirm('Confirmation','êtes-vous sûr de vouloir supprimer cette information?',function(r){
                        if (r){
                                $.post('application/lib.out-put/remove_user.php',{idint:row.idint},function(result){//id bon
                                        if (result.success){
                                                $('#dg2').datagrid('reload');	// reload the user data
                                        } else {
                                                $.messager.show({	// show error message
                                                        title: 'Error',
                                                        msg: result.msg
                                                });
                                        }
                                },'json');
                        }
                });
        }
}
//recherche automatique du registre de sortie
function doSearch2(){
    $('#dg2').datagrid('load',{
            designation: $('#designation').val(),
            numero_serie: $('#numero_serie').val()
    });
}

</script>
<div class="demo-info" style="margin-bottom:10px">
                    <div class="demo-tip icon-tip "> &nbsp;</div>
                    <div>Taper sur search pour effectuer votre recherche puis appuis sur F5 . </div>
                </div>
                <table id="dg2" title="intervention" class="easyui-datagrid" 
			url="application/lib.out-put/getdata.php"
			toolbar="#tlba" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
                            <th field="date" width="50">date sortie</th>                               
                            <th field="designation" width="50">materiel</th>                                
                            <th field="marque" width="50">marque</th>                             
                            <th field="numero_serie" width="50">numero de serie</th>
                            <th field="diagnostics" width="50">diagnostics</th>
                            <th field="travail_faits" width="50">travail fait</th>
                            <th field="resultat" width="50">resultat</th>
                            <th field="observation" width="50">observation</th>
                            <th field="technicien" width="50">technicien</th>
                            <th field="libele" width="50">bureau de poste</th>
                            
                       </tr>
		</thead>
	</table>
<div id="tlba" style="padding:3px">


            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser2()">Ajouter</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser2()">Modifier</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser2()">supprimer</a>
             <a href="#" class="easyui-linkbutton" iconCls="icon-print" plain="true">imprimer</a>
            <div class="flt1"> 
                <form method="post" novalidate>
                    <span>materiel:</span>
                    <input id="designation" style="line-height:20px;border: 1px solid #ccc">
                    <span>numero seie:</span>
                    <input id="numero_serie" style="line-height:20px;border:1px solid #ccc">
                    <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch2()">Search</a>   
                </form>         
            </div>


</div>


<div id="dlg-buttons2">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser2(); javascript:$('#dlg2').dialog('close');">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')">Cancel</a>
</div>

	
<div id="dlg2" class="easyui-dialog" style="width:600px;height:600px;padding:10px 20px"
                closed="true" buttons="#dlg-buttons2">
        <div class="ftitle">Information</div>
        <form id="fm2" method="post" novalidate>
            <table>
                <tr>
                        <div class="fitem">
                                <label>date sortie:</label>
                                <input name="date" class="easyui-datebox" >
                        </div>
                        <div class="fitem">
                                <label>materiel</label>
                                <select class="easyui-combobox" name="designation">
                                    <?php
                                      $mt= new materiel();
                                      $rslt = $mt->fetchColumn('designation');
                                while ($row = mysql_fetch_row($rslt)) {
                            ?>
                            <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                            <?php } ?>
                        </select>
                        </div>

            </tr>
            <tr>       

                        <div class="fitem">
                                <label>marque:</label>
                                <input name="marque">
                        </div>
                       
            </tr>
            <tr>
                        <div class="fitem">
                                <label>numero serie:</label>
                                <input name="numero_serie" >
                        </div></br>
                        <div class="fitem">
                                <label>diagnostics:</label>
                             <textarea class="fitem" name="diagnostics" size="2"></textarea></br></br>
                        <div class="fitem">
                                <label>bureau poste:</label>
                                <input name="libele" >
                        </div></br>
                        <label>travail fait:</label>
                        <textarea class="fitem" name="travail_faits"  size="2"></textarea></br></br>


                        <label>resultat:</label>
                        <textarea class="fitem" name="resultat" size="2"></textarea></br></br>


                        <label>observation:</label>
                        <textarea name="observation" size="2" ></textarea><br></br>
               </tr>
               <tr>
                       <div class="fitem">
                        <label>technicien</label>
                        <select class="easyui-combobox" name="technicien" size="100px">
                            <?php
                              $int= new intervention();
                              $rstl= $int->fetchColumn('technicien');
                            while($row= mysql_fetch_row($rstl)){
                            ?>
                            <option value="<?php echo $row[0] ?>"><?php echo $row[0] ?></option>
                            <?php }?>
                        </select>  
                       </div>
              </tr>
                   </table>    
        </form>
</div>
	



