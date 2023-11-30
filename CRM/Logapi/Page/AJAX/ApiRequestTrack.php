<?php

use CRM_Logapi_ExtensionUtil as E;

class CRM_Logapi_Page_AJAX_ApiRequestTrack extends CRM_Core_Page {

  public function getApiRequestTracks() {

    $pagerParams = CRM_Core_Page_AJAX::defaultSortAndPagerParams();

    $params = [
      'checkPermissions' => FALSE,
      'select' => ['*']
    ];

    $params['offset'] = ($pagerParams['page'] - 1) * $pagerParams['rp'];
    $params['limit'] = $pagerParams['rp'];

    $params['orderBy'] = CRM_Logapi_Utils_PageAJAX::getOrderByParam($pagerParams['sortBy']);

    $apiRequestTracks = civicrm_api4('ApiRequestTrack', 'get', $params);

    foreach ($apiRequestTracks as $apiRequestTrack) {
      $result['data'][] = [
        'id' => $apiRequestTrack['id'],
        'request' => $apiRequestTrack['request'],
        'response' => $apiRequestTrack['response'],
        'status' => $apiRequestTrack['status'],
        'contact_id' => $apiRequestTrack['contact_id'],
        'DT_RowId' => $apiRequestTrack['id'],
        'DT_RowAttr' => [
          'data-entity' => 'apiRequestTrack',
          'data-id' => $apiRequestTrack['id']
        ]
      ];
    }

    $totalCount = CRM_Logapi_BAO_ApiRequestTrack::getCount($params);

    $result['recordsFiltered'] = $totalCount;
    $result['recordsTotal'] = $totalCount;

    CRM_Utils_JSON::output($result);
  }

}
