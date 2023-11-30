<?php

class CRM_Logapi_Utils_Settings {
  
  const LOGAPI_KEYWORD_TO_RECORD = 'logapi_keyword_to_record';
  const LOGAPI_ENTITY_ACTION_TO_RECORD = 'logapi_entity_action_to_record';

  public static function getEntityToRecord() {
    $combinedValue = Civi::settings()->get(self::LOGAPI_ENTITY_ACTION_TO_RECORD);
    list($entity, $action) = explode('.', $combinedValue, 2);
    return $entity;
  }

  public static function setEntityToRecord($entity) {
    $currentValue = Civi::settings()->get(self::LOGAPI_ENTITY_ACTION_TO_RECORD);
    list(, $action) = explode('.', $currentValue, 2);
    $combinedValue = implode('.', [$entity, $action]);
    Civi::settings()->set(self::LOGAPI_ENTITY_ACTION_TO_RECORD, $combinedValue);
  }

  public static function getActionToRecord() {
    $combinedValue = Civi::settings()->get(self::LOGAPI_ENTITY_ACTION_TO_RECORD);
    list(, $action) = explode('.', $combinedValue, 2);
    return $action;
  }

  public static function setActionToRecord($action) {
    $currentValue = Civi::settings()->get(self::LOGAPI_ENTITY_ACTION_TO_RECORD);
    list($entity,) = explode('.', $currentValue, 2);
    $combinedValue = implode('.', [$entity, $action]);
    Civi::settings()->set(self::LOGAPI_ENTITY_ACTION_TO_RECORD, $combinedValue);
  }

  public static function getKeywordToRecord() {
    return Civi::settings()->get(self::LOGAPI_KEYWORD_TO_RECORD, []);
  }

  public static function setKeywordToRecord($regexList) {
    if (!empty($regexList)) {
      if (!is_array($regexList)) {
        $regexList = explode(',', $regexList);
        $regexList = array_map('trim', $regexList);
      }
      Civi::settings()->set(self::LOGAPI_KEYWORD_TO_RECORD, $regexList);
    }
  }

}
