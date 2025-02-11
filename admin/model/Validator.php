<?php
    class Validator {
        public static function notEmpty($text){
            try{
                if($text != "" || $text != null)
                    return true;
            }catch(Exception $ex){
                echo $ex;
                return false;
            }
        }

        // Check file size (optional, e.g., 5MB limit)
        public static function checkFileSize($file){
            try{
                if($file > 5000000) 
                    return true;
            }catch(Exception $ex){
                echo $ex;
                return false;
            }
        } 

        // Allow certain file formats
        public static function fileFormats($imageFileType){
            try{
                if(in_array($imageFileType, ['jpg', 'png', 'jpeg', 'webp'])) 
                    return true;
            }catch(Exception $ex){
                echo $ex;
                return false;
            }
        }
    }
?>