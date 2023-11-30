<div class="crm-block crm-form-block crm-form-logapi-block">
  <div class="crm-submit-buttons">
      {include file="CRM/common/formButtons.tpl" location="top"}
  </div>
  <div>
    <table class="form-layout-compressed" id="logapi-filter-settings">
      <tbody>
      <tr class="logapi-set">
        <td class="crm-inline-edit-field">
            {$form.logapi_entity_action_to_record.label}
          <br>
            {$form.logapi_entity_action_to_record.html}
        </td>
        <td class="crm-inline-edit-field">
            {$form.logapi_keyword_to_record.label}
          <br>
            {$form.logapi_keyword_to_record.html}
        </td>
      </tr>
      </tbody>
    </table>
  </div>

  <div class="crm-submit-buttons">
    <button class="crm-button" type="button" id="addSetButton">
        {ts domain=com.agiliway.logapi}Add Set{/ts}
    </button>
    <button class="crm-button" type="button"
            id="resetFieldsButton">
        {ts domain=com.agiliway.logapi}Reset Fields{/ts}
    </button>
      {include file="CRM/common/formButtons.tpl" location="bottom"}
  </div>
</div>

{literal}
  <script>
      CRM.$(function ($) {
          function resetFields() {
              $('#logapi-filter-settings input[type="text"]').val('');
          }

          $('#addSetButton').on('click', function () {
              const previousSet = $('.logapi-set:last');
              const entityActionInput = previousSet.find('[name^="logapi_entity_action_to_record"]');
              const keywordInput = previousSet.find('[name^="logapi_keyword_to_record"]');

              if (entityActionInput.val().trim() !== '' || keywordInput.val().trim() !== '') {
                  const clonedRow = previousSet.clone();
                  clonedRow.find('input').val('');
                  $('#logapi-filter-settings tbody').append(clonedRow);
              }
          });

          $('#resetFieldsButton').on('click', function () {
              resetFields();
          });

          $('#crm-form-reset').on('click', function () {
              $('#resetFieldsButton').click();
          });
      });
  </script>
{/literal}

