<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {

        $errors = array();
        foreach ($this->validators as $validator) {

            $errori = $this->$validator();

            if (count($errori) > 0) {
                $errors = array_merge($errors, $errori);
            }
        }
        return $errors;
    }

    public function validate_string_length($field, $string, $length) {
        $errors = array();

        if ($string == '' || $string == null) {
            $errors[] = '"' . $field . '" ei saa olla tyhjä!';
        }
        if (strlen($string) < $length) {
            $errors[] = '"' . $field . '" pituus oltava vähintään ' . $length . ' merkkiä';
        }
        if (count($errors) > 0) {
            return $errors;
        }
    }

    public function validate_int($field, $int) {
        $errors = array();

        if ($int == '' || $int == null) {
            $errors[] = '"' . $field . '" ei saa olla tyhjä!';
        }

        if (!is_numeric($int)) {
            $errors[] = '"' . $field . '" oltava numero';
        }

        if (count($errors) > 0) {
            return $errors;
        }
    }

}
