<script>
//jQuery pour l'annuaire'
var url;
function newUser(){
        $('#dlg').dialog('open').dialog('setTitle','nouvelle information');
        $('#fm').form('clear');
        url = 'application/parc_info/ordinateur/save_user.php';
}
function editUser(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
                $('#dlg').dialog('open').dialog('setTitle','modifier information');
                $('#fm').form('load',row);
                url = 'application/parc_info/ordinateur/update_user.php?code_mat='+row.code_mat;
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
                                $.post('application/parc_info/ordinateur/remove_user.php',{code_mat:row.code_mat},function(result){//id bon
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
//recherche parc_informatique
function doSearch(){
    $('#dg').datagrid('load',{
            designation: $('#designation').val(),
            numero_serie: $('#numero_serie').val()
    });
}
function show(){
   $('#dg').dialog('open').dialog('setTitle','');     
                }


</script>


<div class="demo-info" style="margin-bottom:10px">
                    <div class="demo-tip icon-tip "> &nbsp;</div>
                    
                    <div>Taper sur search pour effectuer votre recherche puis appuis sur F5 . </div>
                </div>
                <table id="dg" title="Parc informatique" class="easyui-datagrid" 
			url="application/parc_info/ordinateur/getdata.php"
			toolbar="#tlba" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
                            <th field="code_mat" width="15">code materiel</th>                               
                            <th field="code_bp" width="15">code bureau poste</th>                                
                            <th field="designation" width="15">materiel</th>
                            <th field="marque" width="15">marque</th>
                            <th field="numero_serie" width="20">numéro de serie</th>
                            <th field="taille_ecran" width="15">taille ecran</th>
                            <th field="type_clavier" width="15">type de clavier</th>
                            <th field="type_souris" width="15">type de souris</th>
                            <th field="taille_disk" width="15">taille du disque</th>
                            <th field="taille_ram" width="15">taille ram</th>
                            <th field="type_cable" width="15">type de cable</th>
                       </tr>
		</thead>
	</table>
<div id="tlba" style="padding:3px">


            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Ajouter</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Modifier</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">supprimer</a>
             <a href="#" class="easyui-linkbutton" iconCls="icon-print" plain="true">imprimer</a>
            <div class="flt1"> 
                <form method="post" novalidate>
                    <span>materiel:</span>
                    <input id="designation" style="line-height:20px;border: 1px solid #ccc">
                    <span>numero serie:</span>
                    <input id="numero_serie" style="line-height:20px;border:1px solid #ccc">
                    <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>   
                </form>         
            </div>


</div>
	
<div id="dlg" class="easyui-dialog" style="width:400px;height:480px;padding:10px 20px"
                closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Information</div>
        <form id="fm" method="post" novalidate>
                 

                        <div class="fitem">
                        <label>code materiel:</label>
                        <input name="code_mat">
                        </div>
                        <div class="fitem">
                        <label>code bureau:</label>
                        <input name="code_bp">
                        </div>
                        <div class="fitem">
                        <label>materiel</label>
                        <input name="designation" >
                        </div>

                        <div class="fitem">
                        <label>marque:</label>
                        <input name="marque">
                        </div>
                        <div class="fitem">
                        <label>numero serie:</label>
                        <input name="numero_serie" >
                        </div>
                        <div class="fitem">
                        <label>taille ecran:</label>
                        <input name="taille_ecran" ></input>
                        </div>
                        <div class="fitem">
                        <label>type clavier:</label>
                        <input name="type_clavier"></input>
                        </div>
                        <div class="fitem">
                        <label>type de souris:</label>
                        <input name="type_souris"></input>
                        </div>
                        <div class="fitem">
                        <label>taille disque:</label>
                        <input name="taille_disk"></input>
                        </div>
                        <div class="fitem">
                        <label>taille ram:</label>
                        <input name="taille_ram"></input>
                        </div>
                        <div class="fitem">
                        <label>type cable:</label>
                        <input name="type_cable"></input>
                        </div>
                        
            <div id="dlg-buttons">
                <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
            </div>

        </form>
</div>
	



