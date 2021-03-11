<script>
var url
function newUser1(){
    
        $('#dlg1').dialog('open').dialog('setTitle','nouvelle information');
        $('#fm1').form('clear');
        url = 'application/lib.in-put/save_user.php';
}
function editUser1(){
    
        var row = $('#dg1').datagrid('getSelected');
        if (row){
                $('#dlg1').dialog('open').dialog('setTitle','mmodifier information');
                $('#fm1').form('load',row);
                url = 'application/lib.in-put/update_user.php?code_mat='+row.code_mat+'&?id_si='+row.id_si;
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
                                $.post('application/lib.in-put/remove_user.php',{id:row.code_mat},function(result){//id bon
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
            designation: $('#designation').val(),
            numero_serie: $('#numero_serie').val()
    });
}
    
</script>
<div class="demo-info" style="margin-bottom:10px">
                    <div class="demo-tip icon-tip "> &nbsp;</div>
                    <div>Taper sur search pour effectuer votre recherche puis appuis sur F5 . </div>
                </div>
                <table id="dg1" title="registre d'entrée" class="easyui-datagrid" 
			url="application/lib.in-put/getdata.php"
			toolbar="#toolba" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
<!--				<th field="code_mat" width="50">code du materiel</th>-->
                                <th field="date_arr" width="50">date d'arrivée</th>                                
                                <th field="designation" width="50">materiel</th>                                
				<th field="marque" width="50">marque</th>
                                <th field="numero_serie" width="50">numero de serie</th>
		                <th field="nature_pb" width="50">nature du probleme</th>
                                <th field="libele" width="50">bureau de poste</th>
                                <th field="technicien" width="50">technicien</th>
			</tr>
		</thead>
	</table>
<div id="toolba" style="padding:3px">


            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser1()">Ajouter</a>
<!--            <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser1()">Modifier</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser1()">supprimer</a>-->
             <a href="#" class="easyui-linkbutton" iconCls="icon-print" plain="true">imprimer</a>
            <div class="flt1"> 
                <form method="post" novalidate>
                    <span>materiel:</span>
                    <input id="designation" style="line-height:20px;border: 1px solid #ccc">
                    <span>numero seie:</span>
                    <input id="numero_serie" style="line-height:20px;border:1px solid #ccc">
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
                        <label>date entrée:</label>
                        <input name="date_arr" class="easyui-datebox" ></input>
                </div>
                <div class="fitem">
                        <label>materiel</label>                       
                        <select class="easyui-combobox" name="materiel">
                            <?php
                                $mt = new materiel();
                                $rslt = $mt->fetchColumn('designation');
                                while ($row = mysql_fetch_row($rslt)) {
                            ?>
                            <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                            <?php } ?>
                        </select>
                </div>

                <div class="fitem">
                        <label>marque:</label>
                        <input name="marque">
                </div>
                <div class="fitem">
                        <label>numero serie:</label>
                        <input name="numero_serie" >
                </div>

            <label>nature problème:</label>
                        <textarea class="fitem" name="nature_pb"  size="2"></textarea>
                <div class="fitem"></br>
                        <label>bureau poste:</label>
                        <input name="libele" >

                </div>

		<div class="fitem">
                        <label>technicien:</label>
                        <select class="easyui-combobox" name="technicien">
                            <?php
                            $int= new intervention();
                            $rstl= $int->fetchColumn('technicien');
                            while($row= mysql_fetch_row($rstl)){
                            ?>
                            <option value="<?php echo $row[0] ?>"><?php echo $row[0] ?></option>
                            <?php }?>
                        </select>
                </div>
                 
        </form>
</div>

