<?php
    $pwd = $_POST['mot_de_passe'];
    
    if ($pwd == "") {
?>
    <div id= champ align= center>	  
    <img src="application/js/icons/campost.png">
    <form method=post action="send.php" align="center" >
            <div>         
                <label>
                     utilisateur      :    
                </label>

                        <input accessKey=4 id=champ_recherche value=""  type ="text" name="login" size= 60/><br/><br/>

                <label>

                mot de passe: 
                </label>

                      <input accessKey=4 id=champ_recherche value=""  type ="password" name="mot_de_passe" size= 60/><br/><br/>

                      <input type="submit" NAME="valide" VALUE="entrer" style="width: 100px;" align=" center"/>
                      <input type="reset" NAME="annuler" VALUE="annuler" style="width: 100px;" align="center"/>
            </div>
       </form><br>
       <p style="color: red; font-weight: bold; padding: 5px; padding-left: 50px; padding-right: 50px; border: 1px solid #ccc; width: 500px;
          background: lavenderblush;">veuillez entrer un mot de passe svp</p>
</div>  
        <?php 
        
        }  elseif ($pwd == "mackiavel") {
            header("Location:portail.php");
        } else {
            
?>
    <div id= champ align= center>	  
    <img src="application/js/icons/campost.png">
    <form method=post action="send.php" align="center" >
            <div>         
                <label>
                     utilisateur      :    
                </label>

                        <input accessKey=4 id=champ_recherche value=""  type ="text" name="login" size= 60/><br/><br/>

                <label>

                mot de passe: 
                </label>

                      <input accessKey=4 id=champ_recherche value=""  type ="password" name="mot_de_passe" size= 60/><br/><br/>

                      <input type="submit" NAME="valide" VALUE="entrer" style="width: 100px;" align=" center"/>
                      <input type="reset" NAME="annuler" VALUE="annuler" style="width: 100px;" align="center"/>
            </div>
       </form><br>
       <p style="color: red; font-weight: bold; padding: 5px; padding-left: 50px; padding-right: 50px; border: 1px solid #ccc; width: 500px;
          background: lavenderblush;" > mauvais mot de passe</p>
</div>  
<?php 
    }            
?>