<?php
class Fonction {
    static function cleanData($data){
        return htmlentities(strip_tags(stripslashes(trim($data))));
    }

    static function get_file_extension($file) {
        return substr(strrchr($file,'.'),1);
    }
}
?>