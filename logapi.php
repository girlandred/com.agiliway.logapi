<?php

require_once 'logapi.civix.php';

use CRM_Logapi_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function logapi_civicrm_config(&$config): void {
  _logapi_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function logapi_civicrm_install(): void {
  _logapi_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function logapi_civicrm_postInstall(): void {
  _logapi_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function logapi_civicrm_uninstall(): void {
  _logapi_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function logapi_civicrm_enable(): void {
  _logapi_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function logapi_civicrm_disable(): void {
  _logapi_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function logapi_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _logapi_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function logapi_civicrm_entityTypes(&$entityTypes): void {
  _logapi_civix_civicrm_entityTypes($entityTypes);
}

function logapi_civicrm_api_exception($entity, $action, $apiParams, $errorMessage, $errorCode, $apiVersion): void {
  $entityActionSets = CRM_Logapi_Utils_Settings::getEntityActionSets();
  $keywordSets = CRM_Logapi_Utils_Settings::getKeywordSets();

  if (!empty($entityActionSets) || !empty($keywordSets)) {
    $logException = false;

    foreach ($entityActionSets as $set) {
      if ($set['entity'] == $entity && $set['action'] == $action) {
        $logException = true;
        break;
      }
    }

    foreach ($keywordSets as $keyword) {
      if (str_contains(json_encode($apiParams), $keyword) || str_contains($errorMessage, $keyword)) {
        $logException = true;
        break;
      }
    }

    if ($logException) {
      CRM_Logapi_BAO_ApiRequestTrack::create([
        'contact_id' => CRM_Core_Session::getLoggedInContactID(),
        'entity' => $entity,
        'action' => $action,
        'response' => json_encode($apiParams),
        'errorMessage' => $errorMessage,
        'errorCode' => $errorCode,
        'apiVersion' => $apiVersion,
        'created_date' => date('YmdHis')
      ]);
    }
  } else {
    CRM_Logapi_BAO_ApiRequestTrack::create([
      'contact_id' => CRM_Core_Session::getLoggedInContactID(),
      'entity' => $entity,
      'action' => $action,
      'response' => json_encode($apiParams),
      'errorMessage' => $errorMessage,
      'errorCode' => $errorCode,
      'apiVersion' => $apiVersion,
      'created_date' => date('YmdHis')
    ]);
  }
}

function logapi_civicrm_navigationMenu(&$menu) {
  _logapi_civix_insert_navigation_menu($menu, NULL, [
    'label' => E::ts('Log Api'),
    'name' => 'logapi',
    'url' => NULL,
    'permission' => NULL,
    'operator' => NULL,
    'separator' => 0,
    'icon' => 'crm-i fa-list-ul',
  ]);

  _logapi_civix_insert_navigation_menu($menu, 'logapi', [
    'label' => E::ts('API Requests Track'),
    'name' => 'logapi_api_request_track',
    'url' => 'civicrm/logapi/api-request-track',
    'permission' => NULL,
    'operator' => NULL,
    'separator' => 0,
  ]);

  _logapi_civix_insert_navigation_menu($menu, 'logapi', [
    'label' => E::ts('API Requests Track Settings'),
    'name' => 'logapi_api_request_track_settings',
    'url' => 'civicrm/logapi/api-request-settings',
    'permission' => NULL,
    'operator' => NULL,
    'separator' => 0,
  ]);

  _logapi_civix_navigationMenu($menu);
}
