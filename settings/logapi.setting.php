<?php

return [
  'logapi_entity_to_record' => [
    'group' => 'logapi',
    'name' => 'logapi_entity_to_record',
    'type' => 'String',
    'html_type' => 'Select',
    'html_attributes' => [
      'size' => 20,
      'class' => 'crm-select2',
    ],
    'default' => [],
    'multiple' => true,
    'title' => ts('Which Entity you want to record?'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => ts('Automatic failed requests for chosen entities'),
  ],
  'logapi_action_to_record' => [
    'group' => 'logapi',
    'name' => 'logapi_action_to_record',
    'type' => 'String',
    'html_type' => 'Select',
    'html_attributes' => [
      'size' => 20,
      'class' => 'crm-select2',
    ],
    'default' => [],
    'multiple' => true,
    'title' => ts('Which Action you want to record?'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => ts('Automatic failed requests for chosen actions'),
  ],
  'logapi_keyword_to_record' => [
    'group' => 'logapi',
    'name' => 'logapi_keyword_to_record',
    'type' => 'String',
    'html_type' => 'text',
    'default' => [],
    'title' => ts('Which Keywords you want to record?'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => ts('Automatic failed requests for chosen keywords'),
  ],
];
