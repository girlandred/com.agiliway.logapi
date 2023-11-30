<?php

use CRM_Logapi_ExtensionUtil as E;

class CRM_Logapi_BAO_ApiRequestTrack extends CRM_Logapi_DAO_ApiRequestTrack {

  private static $_entityName = 'ApiRequestTrack';

  public static function getEntityName() {
    return self::$_entityName;
  }

  public static function create($params) {
    CRM_Utils_Hook::pre('create', self::getEntityName(), CRM_Utils_Array::value('id', $params), $params);

    $instance = new self();
    $instance->copyValues($params);

    $instance->save();

    CRM_Utils_Hook::post('create', self::getEntityName(), $instance->id, $instance);

    return $instance;
  }

  private static function buildSelectQuery($returnValue = 'rows') {
    $query = CRM_Utils_SQL_Select::from(self::getTableName());

    if ($returnValue == 'rows') {
      $query->select('*');
    } else {
      if ($returnValue == 'count') {
        $query->select('COUNT(id)');
      }
    }

    return $query;
  }

  private static function buildWhereQuery($query, $params = []) {
    if (!empty($params['id'])) {
      $query->where('id = #id', ['id' => $params['id']]);
    }

    if (!empty($params['entity'])) {
      $query->where('entity = @entity', ['entity' => $params['entity']]);
    }

    if (!empty($params['action'])) {
      $query->where('action = @action', ['action' => $params['action']]);
    }

    if (!empty($params['response'])) {
      $query->where('response = @response', ['response' => $params['response']]);
    }

    if (!empty($params['errorMessage'])) {
      $query->where('errorMessage = @errorMessage', ['errorMessage' => $params['errorMessage']]);
    }

    if (!empty($params['errorCode'])) {
      $query->where('errorCode = @errorCode', ['errorCode' => $params['errorCode']]);
    }

    if (!empty($params['apiVersion'])) {
      $query->where('apiVersion = @apiVersion', ['apiVersion' => $params['apiVersion']]);
    }

    if (!empty($params['contact_id'])) {
      $query->where('contact_id = @contact_id', ['contact_id' => $params['contact_id']]);
    }

    if (!empty($params['created_date'])) {
      $query->where('created_date = @created_date', ['created_date' => $params['created_date']]);
    }

    return $query;
  }

  public static function getCount($params) {
    $query = self::buildWhereQuery(self::buildSelectQuery(), $params);
    $query = CRM_Utils_SQL_Select::from('(' . $query->toSQL() . ') as a');
    $query->select('COUNT(*) as count');

    return CRM_Core_DAO::executeQuery($query->toSQL())->fetchAll()[0]['count'];
  }

}
