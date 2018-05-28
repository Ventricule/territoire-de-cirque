<?php

class RolesField extends CheckboxesField {

  public function options() {
    foreach(kirby()->site()->roles() as $role) {
       $options[$role->id()] =  $role->name();
    }
    return $options;
  }

}
