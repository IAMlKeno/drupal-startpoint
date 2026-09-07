<?php
namespace Drupal\swc\Entity;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Workout Session entity - tracks actual athlete performance.
 *
 * @ContentEntityType(
 *   id = "workout_session",
 *   label = @Translation("Workout Session"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\swc\Entity\WorkoutSessionListBuilder",
 *     "form" = {"default" = "Drupal\swc\Form\WorkoutSessionForm", "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"},
 *     "access" = "Drupal\swc\Access\WorkoutSessionAccessControlHandler",
 *   },
 *   base_table = "workout_session",
 *   fieldable = TRUE,
 *   entity_keys = {"id" = "id", "uuid" = "uuid"},
 * )
 */
class WorkoutSession extends ContentEntityBase {
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields['athlete'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Athlete'))
      ->setSetting('target_type', 'user')
      ->setRequired(TRUE);
    $fields['workout'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Workout'))
      ->setSetting('target_type', 'node')
      ->setRequired(TRUE);
    $fields['session_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Session Date'))
      ->setRequired(TRUE);
    $fields['completion_status'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Status'))
      ->setSettings(['allowed_values' => ['in_progress' => 'In Progress', 'completed' => 'Completed', 'abandoned' => 'Abandoned']])
      ->setDefaultValue('in_progress');
    $fields['notes'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Notes'));
    $fields['created'] = BaseFieldDefinition::create('created');
    $fields['changed'] = BaseFieldDefinition::create('changed');
    return $fields;
  }
  public function getAthlete() { return $this->get('athlete')->entity; }
  public function getWorkout() { return $this->get('workout')->entity; }
  public function isCompleted() { return $this->get('completion_status')->value === 'completed'; }
}
