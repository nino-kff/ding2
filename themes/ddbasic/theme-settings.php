<?php
/**
 * @file
 * Handle theme settings form for the theme.
 */

/**
 * Implements form_system_theme_settings_alter().
 */
function ddbasic_form_system_theme_settings_alter(&$form, $form_state) {
  // Disable overlay on Ting object teasers.
  $form['ddbasic_settings']['ting_object_overlay'] = array(
    '#type' => 'fieldset',
    '#title' => t('Ting object overlay'),
  );
  $form['ddbasic_settings']['ting_object_overlay']['ting_object_disable_overlay'] = array(
    '#type' => 'checkbox',
    '#title' => t('Disable overlay'),
    '#description' => t('Disable gradient overlay with text on Ting object teasers'),
    '#default_value' => theme_get_setting('ting_object_disable_overlay'),
  );

  $form['#validate'][] = 'ddbasic_form_system_theme_settings_validate';
  $form['#submit'][] = 'ddbasic_form_system_theme_settings_submit';
}

/**
 * Custom validation for the theme_settings form.
 */
function ddbasic_form_system_theme_settings_validate($form, &$form_state) {
  switch ($form_state['values']['palette']['text']) {
    case 'primary': $form_state['values']['palette']['text'] = $form_state['values']['palette']['primary'];
      break;

    case 'secondary': $form_state['values']['palette']['text'] = $form_state['values']['palette']['secondary'];
      break;
  }
  switch ($form_state['values']['palette']['text_link']) {
    case 'primary': $form_state['values']['palette']['text_link'] = $form_state['values']['palette']['primary'];
      break;

    case 'secondary': $form_state['values']['palette']['text_link'] = $form_state['values']['palette']['secondary'];
      break;
  }
  switch ($form_state['values']['palette']['text_link_on_dark']) {
    case 'primary': $form_state['values']['palette']['text_link_on_dark'] = $form_state['values']['palette']['primary'];
      break;

    case 'secondary': $form_state['values']['palette']['text_link_on_dark'] = $form_state['values']['palette']['secondary'];
      break;
  }
}

/**
 * Custom submit for the theme_settings form.
 */
function ddbasic_form_system_theme_settings_submit($form, &$form_state) {
  $form_state['values']['info']['css'] = ding_base_color_css_files($form_state['build_info']['args'][0]);
}
