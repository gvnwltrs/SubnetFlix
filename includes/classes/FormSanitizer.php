<?php
class FormSanitizer {

    static function sanitizeFormString($inputStrings) {
        $inputText = strip_tags($inputStrings); 
        $inputText = str_replace(" ", "", $inputStrings); 
        $inputText = strtolower($inputStrings); 
        $inputText = ucfirst($inputStrings); 
        return $inputText; 
    }

    static function sanitizeFormUsername($inputStrings) {
        $inputText = strip_tags($inputStrings); 
        $inputText = str_replace(" ", "", $inputStrings); 
        return $inputText; 
    }

    static function sanitizeFormPassword($inputStrings) {
        $inputText = strip_tags($inputStrings); 
        return $inputText; 
    }

    static function sanitizeFormEmail($inputStrings) {
        $inputText = strip_tags($inputStrings); 
        $inputText = str_replace(" ", "", $inputStrings); 
        return $inputText; 
    }

}
?> 