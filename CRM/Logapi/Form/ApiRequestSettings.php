<?php

use CRM_Logapi_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Logapi_Form_ApiRequestSettings extends CRM_Core_Form {

  public function buildQuickForm(): void {
    $this->setTitle(E::ts('Api Requests Tracker Settings'));

    $this->add('textarea', CRM_Logapi_Utils_Settings::LOGAPI_ENTITY_ACTION_TO_RECORD, E::ts('Define regular expressions for entity and action'), [
      'placeholder' => E::ts('Enter regular expressions for entity and action, separated by commas (e.g., entity1.action1, entity2.action2)'),
    ]);

    $this->add('textarea', CRM_Logapi_Utils_Settings::LOGAPI_KEYWORD_TO_RECORD, E::ts('Define regular expressions to record'));

    $this->addButtons([
      [
        'type' => 'submit',
        'name' => E::ts('Submit'),
        'isDefault' => TRUE,
      ],
      [
        'type' => 'cancel',
        'name' => E::ts('Cancel'),
      ],
    ]);

    parent::buildQuickForm();
  }

  function postProcess(): void {
    $values = $this->exportValues();

    $inputValue = $values[CRM_Logapi_Utils_Settings::LOGAPI_ENTITY_ACTION_TO_RECORD];
    $entityActionPairs = explode(',', $inputValue);

    $entities = $actions = [];
    foreach ($entityActionPairs as $pair) {
      list($entity, $action) = explode('.', trim($pair), 2);
      $entities[] = $entity;
      $actions[] = $action;
    }

    $selectedKeyword = isset($values[CRM_Logapi_Utils_Settings::LOGAPI_KEYWORD_TO_RECORD]) ? $values[CRM_Logapi_Utils_Settings::LOGAPI_KEYWORD_TO_RECORD] : [];

    CRM_Core_Session::setStatus(E::ts('Saved!'));

    CRM_Logapi_Utils_Settings::setEntityToRecord($entities);
    CRM_Logapi_Utils_Settings::setActionToRecord($actions);
    CRM_Logapi_Utils_Settings::setKeywordToRecord($selectedKeyword);

    parent::postProcess();
  }

  function setDefaultValues(): array {
    $defaults = parent::setDefaultValues();

    $selectedEntities = CRM_Logapi_Utils_Settings::getEntityToRecord();
    $selectedActions = CRM_Logapi_Utils_Settings::getActionToRecord();
    $selectedKeyword = CRM_Logapi_Utils_Settings::getKeywordToRecord();

    $entityActionPairs = [];
    foreach (array_map(null, $selectedEntities, $selectedActions) as [$entity, $action]) {
      $entityActionPairs[] = "$entity.$action";
    }

    $defaults[CRM_Logapi_Utils_Settings::LOGAPI_ENTITY_ACTION_TO_RECORD] = implode(', ', $entityActionPairs);
    $defaults[CRM_Logapi_Utils_Settings::LOGAPI_KEYWORD_TO_RECORD] = $selectedKeyword;

    return $defaults;
  }
}
