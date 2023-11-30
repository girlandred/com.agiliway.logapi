<div id="logapi-api-request-track-block crm-container">
  <div class="crm-block crm-content-block">

    <div id="logapi-api-request-track-block">
      <div style="overflow:auto; width:100%;">
        <div class="crm-accordion-wrapper crm-project-accordion collapsed">
          <div class="crm-accordion-header">{ts domain=com.agiliway.logapi}Filter by Request{/ts}</div>
          <div class="crm-accordion-body" id="apiRequestTrackFilter">
            <table class="no-border form-layout-compressed">
              <tbody>
              <tr id="api-request-track-filter-options">
                <td class="crm-inline-edit-field">{$form.request.label}<br>{$form.request.html}</td>
                <td class="crm-inline-edit-field">{$form.contact_id.label}<br>{$form.contact_id.html}</td>
              </tr>
              <tr>
                <td>
                  <button id="run-filter" class="crm-button" type="button">
                    <span><i class="crm-i fa-filter"></i> {ts domain=com.agiliway.logapi}Apply filter{/ts}</span>
                  </button>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

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
