<div id="logapi-api-request-track-block crm-container">
  <div class="crm-block crm-content-block">
    
    <table id="logapi-api-request-track-table" class="crm-multifield-selector crm-ajax-table"
           data-order='[[1,"asc"]]'>
      <thead>
      <tr>
        <th data-data="id" data-orderable="false"></th>
        <th data-data="request">{ts domain=com.agiliway.logapi}Request{/ts}</th>
        <th data-data="status">{ts domain=com.agiliway.logapi}Status{/ts}</th>
        <th data-data="response">{ts domain=com.agiliway.logapi}Response{/ts}</th>
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
                'data': function (d) {
                    d.request = $('input[name="request"]').val()
                    d.contact_id = $('input[name="contact_id"]').val()
                }
            },
            'columnDefs': [{
                'targets': -1,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
            }],

            'dom': 'iptpl',
        });

        $('#run-filter').on('click', function () {
            logapiApiRequestTrackTable.DataTable().draw();
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
