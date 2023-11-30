<div id="logapi-api-request-track-block crm-container">
  <div class="crm-block crm-content-block">

    <table id="logapi-api-request-track-table" class="crm-multifield-selector crm-ajax-table"
           data-order='[[1,"asc"]]'>
      <thead>
      <tr>
        <th data-data="id" data-orderable="false"></th>
        <th data-data="entity">{ts domain=com.agiliway.logapi}Entity{/ts}</th>
        <th data-data="action">{ts domain=com.agiliway.logapi}Action{/ts}</th>
        <th data-data="response">{ts domain=com.agiliway.logapi}Response{/ts}</th>
        <th data-data="errorMessage">{ts domain=com.agiliway.logapi}Error Message{/ts}</th>
        <th data-data="errorCode">{ts domain=com.agiliway.logapi}Error Code{/ts}</th>
        <th data-data="created_date">{ts domain=com.agiliway.logapi}Creeated At{/ts}</th>
      </tr>
      </thead>
    </table>

  </div>
</div>

{literal}
<script>

    CRM.$(function ($) {
        const logapiApiRequestTrackTable = $('#logapi-api-request-track-table');

        logapiApiRequestTrackTable.data({
            'ajax': {
                'url': {/literal}'{crmURL p="civicrm/logapi/ajax/api-request-track" h=0}'{literal},
            },
            'columnDefs': [{
                'targets': -1,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
            }],

            'dom': 'iptpl',
        });


        const active = 'a.crm-popup';

        $('#crm-main-content-wrapper')
            .crmSnippet()
            .off('.crmLivePage')
            .on('click.crmLivePage', active, CRM.popup)
            .on('crmPopupFormSuccess.crmLivePage', active, CRM.refreshParent);

    });

</script>
{/literal}
