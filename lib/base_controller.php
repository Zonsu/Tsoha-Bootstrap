<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['employee'])) {
          $employee_id = $_SESSION['employee'];
          
          $employee = Employee::find($id);
          
          return $employee;
          
      }
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }

  