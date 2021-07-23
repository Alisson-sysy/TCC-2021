<?php

    function makeSelect($value, $description){
        $select = "";
        $result = "";
        
        for($x=0; $x<sizeof($value); $x++){

            // if($selecionado[$x] == $tipo){
            //     $select = "selected"
            // }

            $result = $result."<option value='$value[$x]'>$description[$x]</option>";
        }

        return $result;
    }

?>