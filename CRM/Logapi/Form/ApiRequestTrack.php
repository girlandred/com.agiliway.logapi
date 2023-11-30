<?php

use CRM_Logapi_ExtensionUtil as E;

class CRM_Logapi_Form_ApiRequestTrack extends CRM_Core_Form {

  public function preProcess() {
    $this->setTitle(E::ts('Failed API Requests List'));
  }

  public function buildQuickForm() {
    parent::buildQuickForm();
  }

  public function setDefaultValues() {
    return [];
  }

}
