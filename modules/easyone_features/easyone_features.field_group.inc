<?php
/**
 * @file
 * easyone_features.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function easyone_features_field_group_info() {
  $export = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_properties|node|segment|form';
  $field_group->group_name = 'group_properties';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'segment';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Image properties',
    'weight' => '3',
    'children' => array(
      0 => 'field_featurette_image',
      1 => 'field_image_position',
      2 => 'field_full_width_image',
      3 => 'field_title_animation',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-properties field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_properties|node|segment|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_testimonials|node|portfolio_item|form';
  $field_group->group_name = 'group_testimonials';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'portfolio_item';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Testimonials',
    'weight' => '5',
    'children' => array(
      0 => 'field_client_testimonials',
      1 => 'field_testimonials_from',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-testimonials field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_testimonials|node|portfolio_item|form'] = $field_group;

  return $export;
}
