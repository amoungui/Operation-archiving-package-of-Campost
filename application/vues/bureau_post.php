<script>
var url
function newUser1(){
    
        $('#dlg1').dialog('open').dialog('setTitle','nouvelle information');
        $('#fm1').form('clear');
        url = 'application/parc_info/bureau_post/save_user.php';
}
function editUser1(){
    
        var row = $('#dg1').datagrid('getSelected');
        if (row){
                $('#dlg1').dialog('open').dialog('setTitle','modifier information');
                $('#fm1').form('load',row);
                url = 'application/parc_info/bureau_post/update_user.php?code_bp='+row.code_bp;
        }
}

function saveUser(){
    $('#fm1').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.success){
                $('#dlg1').dialog('close');		// close the dialog
                $('#dg1').datagrid('reload');	// reload the user data
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.msg
                });
            }
        }
    });
}

function removeUser1(){
        var row = $('#dg1').datagrid('getSelected');
        if (row){
                $.messager.confirm('Confirmation','êtes-vous sûr de vouloir supprimer cette information?',function(r){
                        if (r){
                                $.post('application/parc_info/bureau_post/remove_user.php',{code_bp:row.code_bp},function(result){//id bon
                                        if (result.success){
                                                $('#dg1').datagrid('reload');	// reload the user data
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

function doSearch1(){
    $('#dg1').datagrid('load',{
            code_bp: $('#cod_bp').val(),
            libele: $('#libel').val()
    });
}

    
</script>
<div class="demo-info" style="margin-bottom:10px">
                    <div class="demo-tip icon-tip "> &nbsp;</div>
                    <div>Taper sur search pour effectuer votre recherche puis appuis sur F5 . </div>
                </div>
                <table id="dg1" title="bureau de post" class="easyui-datagrid" 
			url="application/parc_info/bureau_post/getdata.php"
			toolbar="#toolba" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>

                                <th field="code_bp" width="50">code_bp</th>                                
                                <th field="libele" width="50">libele</th>                                
				<th field="lieu" width="50">lieu</th>
                                <th field="phone" width="50">Téléphone</th>		                
			</tr>
		</thead>
	</table>
<div id="toolba" style="padding:3px">


            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser1()">Ajouter</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser1()">Modifier</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser1()">supprimer</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-print" plain="true">imprimer</a>
            <div class="flt1"> 
                <form method="post" novalidate>
                    <span>code_bp:</span>
                    <input id="cod_bp"  style="line-height:20px;border: 1px solid #ccc">
                    <span>libele:</span>
                    <input id="libel"  style="line-height:20px;border:1px solid #ccc">
                    <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch1()">Search</a>   
                </form>         
            </div>


</div>

<div id="dlg-buttons1">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser(); javascript:$('#dlg1').dialog('close');">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg1').dialog('close')">Cancel</a>
</div>


<div id="dlg1" class="easyui-dialog" style="width:500px;height:400px;padding:10px 20px"
                closed="true" buttons="#dlg-buttons1">
        <div class="ftitle"> Information</div>
        <form id="fm1" method="post">
                
                <div class="fitem">
                        <label>code bureau:</label>
                        <input name="code_bp"></input>
                </div>
                
                <div class="fitem">
                        <label>libele:</label>
                        <input name="libele">
                </div>
                <div class="fitem">
                        <label>lieu:</label>
                        <input name="lieu" >
                </div>

                 <div class="fitem"></br>
                        <label>telephone:</label>
                        <input name="phone" >

                </div>  
        </form>
</div>

