<?php
namespace Drupal\swc\Entity;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Check-in entity - athlete engagement and coaching records.
 *
 * @ContentEntityType(
 *   id = "check_in",
 *   label = @Translation("Check-in"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\swc\Entity\CheckInListBuilder",
 *     "form" = {"default" = "Drupal\swc\Form\CheckInForm", "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"},
 *     "access" = "Drupal\swc\Access\CheckInAccessControlHandler",
 *   },
 *   base_table = "check_in",
 *   fieldable = TRUE,
 *   entity_keys = {"id" = "id", "uuid" = "uuid"},
 * )
 */
class CheckIn extends ContentEntityBase {
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields['athlete'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Athlete'))
      ->setSetting('target_type', 'user')
      ->setRequired(TRUE);
    $fields['challenge_enrollment'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Challenge Enrollment'))
      ->setSetting('target_type', 'challenge_enrollment')
      ->setRequired(TRUE);
    $fields['check_in_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Check-in Date'))
      ->setRequired(TRUE);
    $fields['energy'] = BaseFieldDefinition::create('list_integer')
      ->setLabel(t('Energy Level'))
      ->setSettings(['allowed_values' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5']]);
    $fields['recovery'] = BaseFieldDefinition::create('list_integer')
      ->setLabel(t('Recovery Level'))
      ->setSettings(['allowed_values' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5']]);
    $fields['confidence'] = BaseFieldDefinition::create('list_integer')
      ->setLabel(t('Squat Confidence'))
      ->setSettings(['allowed_values' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5']]);
    $fields['athlete_notes'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Athlete Notes'));
    $fields['coach_feedback'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Coach Feedback'));
    $fields['review_status'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Review Status'))
      ->setSettings(['allowed_values' => ['pending' => 'Pending', 'reviewed' => 'Reviewed', 'needs_followup' => 'Needs Follow-up']])
      ->setDefaultValue('pending');
    $fields['reviewed_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Reviewed Date'));
    $fields['created'] = BaseFieldDefinition::create('created');
    $fields['changed'] = BaseFieldDefinition::create('changed');
    return $fields;
  }
  public function getAthlete() { return $this->get('athlete')->entity; }
  public function getEnrollment() { return $this->get('challenge_enrollment')->entity; }
}
