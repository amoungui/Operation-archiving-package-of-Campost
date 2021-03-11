<script>
//jQuery pour l'annuaire'
var url;
function newUser(){
        $('#dlg').dialog('open').dialog('setTitle','nouvelle information');
        $('#fm').form('clear');
        url = 'application/annuaire/save_user.php';
}
function editUser(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
                $('#dlg').dialog('open').dialog('setTitle','modifier information');
                $('#fm').form('load',row);
                url = 'application/annuaire/update_user.php?id='+row.id;
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
						$('#dlg').dialog('close');		// close the dialog
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
                                $.post('application/annuaire/remove_user.php',{id:row.id},function(result){//id bon
                                        if (result.success){
                                                $('#dg').datagrid('reload');	// reload the user data (recharge les données d'utilisateur)
                                        } else {
                                                $.messager.show({	// show error message(envoi un message d'erreur)
                                                        title: 'Error',
                                                        msg: result.msg
                                                });
                                        }
                                },'json');
                        }
                });
        }
}

function doSearch(){
    $('#dg').datagrid('load',{
            firstname: $('#firstname').val(),
            lastname: $('#lastname').val()
    });
}
</script>
<div class="demo-info" style="margin-bottom:10px">
    <div class="demo-tip icon-tip">&nbsp;</div>
    <div>Taper sur search pour effectuer votre recherche puis appuis sur F5 .</div>
</div>
	
<table id="dg" class="easyui-datagrid" 
               url="application/annuaire/getdata.php"
                title="annuaire"  toolbar="#toolbar"
                rownumbers="true" pagination="true" singleSelect="true">
        <thead>
                <tr>
                        <th field="firstname" width="250">nom</th>
                        <th field="lastname" width="250">prenom</th>
                        <th field="phone" width="250">telephone</th>
                        <th field="email" width="250">email</th>
                        <th field="fonction" width="250">fonction</th>
                        <th field="code_bp" width="250">code du bureau de poste</th>
                </tr>
        </thead>
</table>
        
<div id="dlg" class="easyui-dialog" style="width:400px;height:350px;padding:10px 20px"
                closed="true" buttons="#dlg-buttons">
        <div class="ftitle"> Information</div>
        <form id="fm" method="post" novalidate>

                <div class="fitem">
                        <label>nom:</label>
                        <input name="firstname" class="easyui-validatebox" required="true">
                </div>
                <div class="fitem">
                        <label>prenom:</label>
                        <input name="lastname" class="easyui-validatebox" required="true">
                </div>

                <div class="fitem">
                        <label>Phone:</label>
                        <input name="phone" class="easyui-validatebox">
                </div>
                <div class="fitem">
                        <label>Email:</label>
                        <input name="email" class="easyui-validatebox" validType="email">
                </div>
                <div class="fitem">
                        <label>fonction:</label>
                        <input name="fonction" class="easyui-validatebox" >
                </div>
            <div class="fitem">
                        <label>code bureau:</label>
                        <input name="code_bp" class="easyui-validatebox" >
                </div>
             <div id="dlg-buttons">
                <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
            </div>
        </form>
</div>

        
<div id="toolbar" style="padding:3px">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Ajouter</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Modifier</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Supprimer</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-print" plain="true">imprimer</a>  
    <div class="flt"> 
        <form method="post" novalidate>
            <span>nom:</span>
            <input id="firstname" style="line-height:20px;border:1px solid #ccc">
            <span>prenom:</span>
            <input id="lastname" style="line-height:20px;border:1px solid #ccc">
            <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
        </form>

  </div>                    
</div>
