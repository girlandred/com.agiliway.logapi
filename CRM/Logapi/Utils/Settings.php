<?php

class CRM_Logapi_Utils_Settings {

  const LOGAPI_KEYWORD_TO_RECORD = 'logapi_keyword_to_record';
  const LOGAPI_ENTITY_ACTION_TO_RECORD = 'logapi_entity_action_to_record';

  public static function getEntityActionSets() {
    return Civi::settings()->get(self::LOGAPI_ENTITY_ACTION_TO_RECORD, []);
  }

  public static function setEntityActionSets($entityActionSets) {
    Civi::settings()->set(self::LOGAPI_ENTITY_ACTION_TO_RECORD, $entityActionSets);
  }

  public static function getKeywordSets() {
    return Civi::settings()->get(self::LOGAPI_KEYWORD_TO_RECORD, []);
  }

  public static function setKeywordSets($keywordSets) {
    Civi::settings()->set(self::LOGAPI_KEYWORD_TO_RECORD, $keywordSets);
  }
}
