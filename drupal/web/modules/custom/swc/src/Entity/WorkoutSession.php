<?php

namespace Drupal\swc\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the Workout Session entity.
 *
 * Tracks what an athlete actually performed (distinct from prescribed Workout).
 *
 * @ContentEntityType(
 *   id = "workout_session",
 *   label = @Translation("Workout Session"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\swc\Entity\WorkoutSessionListBuilder",
 *     "form" = {
 *       "default" = "Drupal\swc\Form\WorkoutSessionForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "access" = "Drupal\swc\Access\WorkoutSessionAccessControlHandler",
 *   },
 *   base_table = "workout_session",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 * )
 */
class WorkoutSession extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['athlete'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Athlete'))
      ->setDescription(t('The athlete who performed the workout'))
      ->setSetting('target_type', 'user')
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 0,
      ])
      ->setDisplayOptions('view', [
        'type' => 'entity_reference_label',
        'weight' => 0,
      ]);

    $fields['workout'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Workout'))
      ->setDescription(t('The prescribed workout'))
      ->setSetting('target_type', 'node')
      ->setSetting('handler_settings', ['target_bundles' => ['workout']])
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 1,
      ])
      ->setDisplayOptions('view', [
        'type' => 'entity_reference_label',
        'weight' => 1,
      ]);

    $fields['session_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Session Date'))
      ->setDescription(t('Date/time of workout'))
      ->setRequired(TRUE)
      ->setDefaultValueCallback('Drupal\Component\Datetime\TimeInterface::getCurrentMicroTime')
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => 2,
      ])
      ->setDisplayOptions('view', [
        'type' => 'datetime_default',
        'weight' => 2,
      ]);

    $fields['completion_status'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Completion Status'))
      ->setDescription(t('Whether workout was completed'))
      ->setDefaultValue('in_progress')
      ->setSettings([
        'allowed_values' => [
          'in_progress' => 'In Progress',
          'completed' => 'Completed',
          'abandoned' => 'Abandoned',
        ],
      ])
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => 3,
      ])
      ->setDisplayOptions('view', [
        'type' => 'list_default',
        'weight' => 3,
      ]);

    $fields['notes'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Athlete Notes'))
      ->setDescription(t('Notes about the workout'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'rows' => 4,
        'weight' => 4,
      ])
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'weight' => 4,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited'));

    return $fields;
  }

  /**
   * Get the athlete.
   *
   * @return \Drupal\user\UserInterface
   *   The athlete user entity.
   */
  public function getAthlete(): UserInterface {
    return $this->get('athlete')->entity;
  }

  /**
   * Get the prescribed workout.
   *
   * @return \Drupal\node\NodeInterface
   *   The workout node entity.
   */
  public function getWorkout() {
    return $this->get('workout')->entity;
  }

  /**
   * Check if workout is completed.
   *
   * @return bool
   *   TRUE if completed, FALSE otherwise.
   */
  public function isCompleted(): bool {
    return $this->get('completion_status')->value === 'completed';
  }

}
