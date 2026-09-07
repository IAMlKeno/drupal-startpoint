<?php

namespace Drupal\swc\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the Challenge Enrollment entity.
 *
 * @ContentEntityType(
 *   id = "challenge_enrollment",
 *   label = @Translation("Challenge Enrollment"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\swc\Entity\ChallengeEnrollmentListBuilder",
 *     "form" = {
 *       "default" = "Drupal\swc\Form\ChallengeEnrollmentForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "access" = "Drupal\swc\Access\ChallengeEnrollmentAccessControlHandler",
 *   },
 *   base_table = "challenge_enrollment",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "canonical" = "/challenge-enrollment/{challenge_enrollment}",
 *     "delete-form" = "/challenge-enrollment/{challenge_enrollment}/delete",
 *   },
 * )
 */
class ChallengeEnrollment extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['athlete'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Athlete'))
      ->setDescription(t('The athlete enrolled in the challenge'))
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

    $fields['challenge'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Challenge'))
      ->setDescription(t('The challenge'))
      ->setSetting('target_type', 'node')
      ->setSetting('handler_settings', ['target_bundles' => ['challenge']])
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 1,
      ])
      ->setDisplayOptions('view', [
        'type' => 'entity_reference_label',
        'weight' => 1,
      ]);

    $fields['joined_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Joined Date'))
      ->setDescription(t('Date athlete joined the challenge'))
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

    $fields['status'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Status'))
      ->setDescription(t('Enrollment status'))
      ->setDefaultValue('registered')
      ->setSettings([
        'allowed_values' => [
          'registered' => 'Registered',
          'active' => 'Active',
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

    $fields['starting_squat_1rm'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Starting Squat 1RM (lbs)'))
      ->setDescription(t('Squat 1RM at enrollment'))
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 4,
      ])
      ->setDisplayOptions('view', [
        'type' => 'number_integer',
        'weight' => 4,
      ]);

    $fields['current_squat_1rm'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Current Squat 1RM (lbs)'))
      ->setDescription(t('Current squat 1RM'))
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 5,
      ])
      ->setDisplayOptions('view', [
        'type' => 'number_integer',
        'weight' => 5,
      ]);

    $fields['completion_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Completion Date'))
      ->setDescription(t('Date challenge was completed'))
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => 6,
      ])
      ->setDisplayOptions('view', [
        'type' => 'datetime_default',
        'weight' => 6,
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
   * Get the enrolled athlete.
   *
   * @return \Drupal\user\UserInterface
   *   The athlete user entity.
   */
  public function getAthlete(): UserInterface {
    return $this->get('athlete')->entity;
  }

  /**
   * Get the challenge.
   *
   * @return \Drupal\node\NodeInterface
   *   The challenge node entity.
   */
  public function getChallenge() {
    return $this->get('challenge')->entity;
  }

}
