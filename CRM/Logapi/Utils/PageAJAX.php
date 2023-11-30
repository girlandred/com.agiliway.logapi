<?php

class CRM_Logapi_Utils_PageAJAX {

  public static function getOrderByParam($pagerParamsSortBy, $sortKeysMap = []): array {
    if (!empty($pagerParamsSortBy)) {
      $sortParams = explode(' ', $pagerParamsSortBy);
      $sortKey = $sortParams[0];
      $sortValue = strtoupper($sortParams[1]);

      $sortKey = $sortKeysMap[$sortKey] ?? $sortKey;
      return [$sortKey => $sortValue];
    }

    return [];
  }

}