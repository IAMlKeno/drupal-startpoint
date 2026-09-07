<?php
namespace Drupal\swc\Entity;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Video Submission entity - training videos for coach review.
 *
 * @ContentEntityType(
 *   id = "video_submission",
 *   label = @Translation("Video Submission"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\swc\Entity\VideoSubmissionListBuilder",
 *     "form" = {"default" = "Drupal\swc\Form\VideoSubmissionForm", "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"},
 *     "access" = "Drupal\swc\Access\VideoSubmissionAccessControlHandler",
 *   },
 *   base_table = "video_submission",
 *   fieldable = TRUE,
 *   entity_keys = {"id" = "id", "uuid" = "uuid"},
 * )
 */
class VideoSubmission extends ContentEntityBase {
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields['athlete'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Athlete'))
      ->setSetting('target_type', 'user')
      ->setRequired(TRUE);
    $fields['workout_session'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Workout Session'))
      ->setSetting('target_type', 'workout_session');
    $fields['video'] = BaseFieldDefinition::create('file')
      ->setLabel(t('Video File'))
      ->setRequired(TRUE);
    $fields['submitted_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Submitted Date'))
      ->setRequired(TRUE);
    $fields['review_status'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Review Status'))
      ->setSettings(['allowed_values' => ['pending' => 'Pending', 'reviewed' => 'Reviewed', 'needs_followup' => 'Needs Follow-up']])
      ->setDefaultValue('pending');
    $fields['coach'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Assigned Coach'))
      ->setSetting('target_type', 'user');
    $fields['coach_feedback'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Coach Feedback'));
    $fields['reviewed_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Reviewed Date'));
    $fields['created'] = BaseFieldDefinition::create('created');
    $fields['changed'] = BaseFieldDefinition::create('changed');
    return $fields;
  }
  public function getAthlete() { return $this->get('athlete')->entity; }
  public function getSession() { return $this->get('workout_session')->entity; }
}
