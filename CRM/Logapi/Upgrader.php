<?php

use CRM_Logapi_ExtensionUtil as E;

/**
 * Collection of upgrade steps.
 */
class CRM_Logapi_Upgrader extends CRM_Logapi_Upgrader_Base {

  public function install(): void {
    $this->executeSqlFile('sql/auto_install.sql');
  }

  public function uninstall(): void {
    $this->executeSqlFile('sql/auto_uninstall.sql');
  }

  public function upgrade_0001(): bool {
    try {
      $this->executeSqlFile('sql/auto_install.sql');
      return TRUE;
    } catch (Exception $e) {
      return FALSE;
    }
  }

}
