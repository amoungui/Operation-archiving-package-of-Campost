<script>
    var url
function newUser(){
    
        $('#dlg').dialog('open').dialog('setTitle','nouvelle information');
        $('#fm').form('clear');
        url = 'application/parc_info/table_service_info/save_user.php';
}
function editUser(){
    
        var row = $('#dg').datagrid('getSelected');
        if (row){
                $('#dlg').dialog('open').dialog('setTitle','modifier information');
                $('#fm').form('load',row);
                url = 'application/parc_info/table_service_info/update_user.php?id_si='+row.id_si;
        }
}
function saveUser(){
    $('#fm').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.success){
                $('#dlg').dialog('close');       // close the dialog
                $('#dg').datagrid('reload');	// reload the user data
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.msg
                });
            }
        }
    });
}
function removeUser(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
                $.messager.confirm('Confirmation','êtes-vous sûr de vouloir supprimer cette information?',function(r){
                        if (r){
                                $.post('application/parc_info/table_service_info/remove_user.php',{id_si:row.id_si},function(result){//id bon
                                        if (result.success){
                                                $('#dg').datagrid('reload');	// reload the user data
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
function doSearch3(){
    $('#dg').datagrid('load',{
            technicien: $('#technicien').val()
            
    });
}

</script>
<div class="demo-info" style="margin-bottom:10px">
    <div class="demo-tip icon-tip"> &nbsp;</div>
    <div>Taper sur search pour effectuer votre recherche puis appuis sur F5 . </div>
</div>
<table id="dg" title="operation servce informatique" class="easyui-datagrid" 
        url="application/parc_info/table_service_info/getdata.php"
        toolbar="#tbar" pagination="true"
        rownumbers="true" fitColumns="true" singleSelect="true">
<thead>
        <tr>
                <th field="id_si" width="50">id service_info</th>
                <th field="nature_pb" width="50">nature_probleme </th>                              
                <th field="diagnostics" width="50">diagnotics</th>                                
                <th field="travail_fait" width="50">travail_fait</th>
                <th field="resultat" width="50">resultat</th>
                 <th field="observation" width="50">observation</th>
                <th field="technicien" width="50">technicien</th>
                <th field="date_arr" width="50">date arrive</th>
                <th field="date_sortie" width="50">date_sortie </th>
                <th field="code_bp" width="50">code buro post</th>
                <th field="id" width="50">idagent</th>
                
        </tr>
</thead>
</table>
<div id="tbar" style="padding:3px">  

            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Ajouter</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Modifier</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">supprimer</a>
             <a href="#" class="easyui-linkbutton" iconCls="icon-print" plain="true">imprimer</a>
            <div class="flt3">  
                
                <span>technicien:</span>
                <input id="technicien" style="line-height:20px;border:1px solid #ccc">
                <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch3()">Search</a>
            </div>            
</div>

<div id="dlg-buttons">
        <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser(); javascript:$('#dlg').dialog('close');">Save</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
</div>
	
<div id="dlg" class="easyui-dialog" style="width:600px;height:640px;padding:10px 20px"
                closed="true" buttons="#dlg-buttons">
        <div class="ftitle"> Information</div>
        <form id="fm" method="post" novalidate>

                <div class="fitem">
                        <label>idservic_info:</label>
                        <input name="id_si">
                </div>
                <div class="fitem">
                        <label>technicien:</label>
                        <input name="technicien">
                </div>
                <div class="fitem">
                        <label>date_arr:</label>
                        <input name="date_arr">
                </div>
                <div class="fitem">
                        <label>date_sortie:</label>
                        <input name="date_sortie">
                </div>
                <div class="fitem">
                        <label>code_bp:</label>
                        <input name="code_bp">
                </div>
                <div class="fitem">
                        <label>idagent:</label>
                        <input name="id">
                </div>
                 <div class="fitem">
                        <label>nature_pb</label>                       
                        <textarea class="fitem" name="nature_pb"size="2"></textarea>
                </div>
                <div class="fitem">
                        <label>diagnostics:</label>
                        <textarea class="fitem" name="diagnostics"size="2"></textarea>
                </div>
                <div class="fitem">
                        <label>travail_fait:</label>
                       <textarea class="fitem" name="travail_fait"size="2"></textarea>
                </div></br></br>
                       <label>resultat:</label>
                        <textarea class="fitem" name="resultat"size="2"></textarea></br></br>
                        <label>observation:</label>
                        <textarea class="fitem" name="observation"size="2"></textarea></br></br>
                                        <div class="fitem">
                        		
        </form>

</div></br>
       
	
