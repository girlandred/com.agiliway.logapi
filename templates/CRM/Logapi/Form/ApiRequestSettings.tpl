<div class="crm-block crm-form-block crm-form-logapi-block">
  <div class="crm-submit-buttons">
      {include file="CRM/common/formButtons.tpl" location="top"}
  </div>
  <div>
    <table class="form-layout-compressed">
      <tbody>
      <tr id="logapi-filter-settings">
        <td class="crm-inline-edit-field">{$form.logapi_entity_to_record.label}<br>{$form.logapi_entity_to_record.html}
        </td>
        <td class="crm-inline-edit-field">{$form.logapi_action_to_record.label}<br>{$form.logapi_action_to_record.html}
        </td>
        <td class="crm-inline-edit-field">{$form.logapi_keyword_to_record.label}
          <br>{$form.logapi_keyword_to_record.html}</td>
      </tr>
      </tbody>
    </table>
  </div>

  <div class="crm-submit-buttons">
      {include file="CRM/common/formButtons.tpl" location="bottom"}
  </div>
</div>

