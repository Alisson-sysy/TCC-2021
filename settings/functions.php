<?php

    function makeSelect($value, $description, $selected, $selectede){
        $select = "";
        $result = "";
        
        for($x=0; $x<sizeof($value); $x++){
            $select = "";
            if($selectede == $value[$x]){
                $select = "selected";
            }

            $result = $result."<option value='$value[$x]' $select>$description[$x]</option>";
        }

        return $result;
    }

    function montaSelectBD($bd, $sql, $aceita_nulos, $valor_atual) {
		$elemento = "";
	    if ($aceita_nulos == true)
	        $elemento = "<option value=''></option>";
	   		
		$lista = mysqli_query($bd, $sql);

		if ( mysqli_num_rows($lista) > 0 ) {
			$selecionado = "";
			while ( $dados = mysqli_fetch_row($lista)) {
		
				if ( $dados[1] == $valor_atual )
		             $selecionado = "selected";
		        else 
		             $selecionado = "";
				
		        $elemento = $elemento."<option value='".$dados[0]."' 
		           $selecionado >".$dados[1]."</option>";
            }
		}
		return $elemento;
  }
  

    // function delete($table, $where){
    //     include_once('connections/connect.php');
    //     $sql = "DELETE FROM $table WHERE ID_usuario = $where";

    //     mysqli_query($bd, $sql);
    // }

?>