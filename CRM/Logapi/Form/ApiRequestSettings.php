<?php

use CRM_Logapi_ExtensionUtil as E;

class CRM_Logapi_Form_ApiRequestSettings extends CRM_Core_Form {

  public function buildQuickForm(): void {
    $this->setTitle(E::ts('Api Requests Tracker Settings'));

    $this->add('text', CRM_Logapi_Utils_Settings::LOGAPI_ENTITY_ACTION_TO_RECORD, E::ts('Define regular expressions for entity and action'), [
      'placeholder' => E::ts('Enter Entity.action'),
    ]);

    $this->add('text', CRM_Logapi_Utils_Settings::LOGAPI_KEYWORD_TO_RECORD, E::ts('Define regular expressions to record'), [
      'placeholder' => E::ts('Enter regular expressions'),
    ]);

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

    $entityActionPairs = explode(',', $values[CRM_Logapi_Utils_Settings::LOGAPI_ENTITY_ACTION_TO_RECORD]);
    $entityActionSets = [];

    foreach ($entityActionPairs as $pair) {
      list($entity, $action) = explode('.', trim($pair), 2);
      $entityActionSets[] = ['entity' => $entity, 'action' => $action];
    }

    $keywordSets = explode('__&__', $values[CRM_Logapi_Utils_Settings::LOGAPI_KEYWORD_TO_RECORD]);

    $existingEntityActionSets = CRM_Logapi_Utils_Settings::getEntityActionSets();
    $existingKeywordSets = CRM_Logapi_Utils_Settings::getKeywordSets();

    if (empty($values[CRM_Logapi_Utils_Settings::LOGAPI_ENTITY_ACTION_TO_RECORD]) && empty($values[CRM_Logapi_Utils_Settings::LOGAPI_KEYWORD_TO_RECORD])) {
      CRM_Logapi_Utils_Settings::setEntityActionSets([]);
      CRM_Logapi_Utils_Settings::setKeywordSets([]);
    } else {
      $mergedEntityActionSets = array_merge($existingEntityActionSets, $entityActionSets);
      $mergedKeywordSets = array_merge($existingKeywordSets, $keywordSets);

      $mergedEntityActionSets = array_unique($mergedEntityActionSets, SORT_REGULAR);

      $mergedKeywordSets = array_unique($mergedKeywordSets);

      $mergedEntityActionSets = array_filter($mergedEntityActionSets, function ($set) {
        return !empty($set['entity']) && !empty($set['action']);
      });

      $mergedKeywordSets = array_filter($mergedKeywordSets, 'strlen');

      CRM_Logapi_Utils_Settings::setEntityActionSets($mergedEntityActionSets);
      CRM_Logapi_Utils_Settings::setKeywordSets($mergedKeywordSets);
    }

    parent::postProcess();
  }


  function setDefaultValues(): array {
    $defaults = parent::setDefaultValues();

    $entityActionSets = CRM_Logapi_Utils_Settings::getEntityActionSets();
    $keywordSets = CRM_Logapi_Utils_Settings::getKeywordSets();

    if (empty($entityActionSets) && empty($keywordSets)) {
      $defaults[CRM_Logapi_Utils_Settings::LOGAPI_ENTITY_ACTION_TO_RECORD] = '';
      $defaults[CRM_Logapi_Utils_Settings::LOGAPI_KEYWORD_TO_RECORD] = '';
    } else {
      if (!empty($entityActionSets) && is_array($entityActionSets)) {
        $entityActionPairs = [];
        foreach ($entityActionSets as $set) {
          $entityActionPairs[] = "{$set['entity']}.{$set['action']}";
        }
        $defaults[CRM_Logapi_Utils_Settings::LOGAPI_ENTITY_ACTION_TO_RECORD] = implode(', ', $entityActionPairs);
      }

      if (!empty($keywordSets) && is_array($keywordSets)) {
        $defaults[CRM_Logapi_Utils_Settings::LOGAPI_KEYWORD_TO_RECORD] = implode('__&__', $keywordSets);
      }
    }

    return $defaults;
  }
}