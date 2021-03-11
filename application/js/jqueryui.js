var url;
function newUser3(){
        $('#dlg3').dialog('open').dialog('setTitle','New User');
        $('#fm3').form('clear');
        url = 'application//save_user.php';
}
function editUser3(){
        var row = $('#dg3').datagrid('getSelected');
        if (row){
                $('#dlg3').dialog('open').dialog('setTitle','Edit User');
                $('#fm3').form('load',row);
                url = 'application/intervention/update_user.php?id='+row.id;
        }
}
function saveUser3(){
			$('#fm3').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg3').dialog('close');		// close the dialog
						$('#dg3').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
function removeUser3(){
        var row = $('#dg3').datagrid('getSelected');
        if (row){
                $.messager.confirm('Confirm','Are you sure you want to remove this user?',function(r){
                        if (r){
                                $.post('application//remove_user.php',{id:row.id},function(result){//id bon
                                        if (result.success){
                                                $('#dg3').datagrid('reload');	// reload the user data
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
    $('#dg3').datagrid('load',{
            designation: $('#designation').val(),
            numero_serie: $('#numero_serie').val()
    });
}

      