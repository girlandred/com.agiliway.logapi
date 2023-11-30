<?php

return [
  'logapi_entity_action_to_record' => [
    'group' => 'logapi',
    'name' => 'logapi_entity_action_to_record',
    'type' => 'String',
    'html_type' => 'text',
    'default' => [],
    'title' => ts('Which Entity and Action you want to record?'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => ts('Automatic failed requests for chosen entities and actions'),
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
