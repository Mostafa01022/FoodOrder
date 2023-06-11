<?php
class FormValidator {
  private  $formData;
  private array $errors;

  public function __construct($formData) {
    $this->formData = $formData;
    $this->errors = array();
  }

  public function validate() {
    // Check if name is filled out
    if (empty($this->formData['username'])) {
      $this->errors['empty_username'] = 'username is required';
    }
    // Check if name is filled out
    if (empty($this->formData['user_password'])) {
      $this->errors['empty_password'] = 'password is required';
    }

    // // Check if email is valid
    // if (!filter_var($this->formData['email'], FILTER_VALIDATE_EMAIL)) {
    //   $this->errors['email'] = 'Invalid email';
    // }
    // if (!filter_var($this->formData['user_password'], FILTER_VALIDATE_REGEXP)) {
    //   $this->errors['user_password'] = 'Invalid Password format';
    // }

    // Add more validations as needed

    return empty ($this->errors);
  }

  public function getErrors() {
    return $this->errors;
  }
}


