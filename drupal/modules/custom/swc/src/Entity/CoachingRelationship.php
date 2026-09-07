<?php
namespace Drupal\swc\Entity;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the Coaching Relationship entity.
 *
 * Links athlete to assigned coach with status lifecycle.
 *
 * @ContentEntityType(
 *   id = "coaching_relationship",
 *   label = @Translation("Coaching Relationship"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\swc\Entity\CoachingRelationshipListBuilder",
 *     "form" = {
 *       "default" = "Drupal\swc\Form\CoachingRelationshipForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "access" = "Drupal\swc\Access\CoachingRelationshipAccessControlHandler",
 *   },
 *   base_table = "coaching_relationship",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 * )
 */
class CoachingRelationship extends ContentEntityBase {
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['athlete'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Athlete'))
      ->setDescription(t('The athlete in this coaching relationship'))
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

    $fields['coach'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Coach'))
      ->setDescription(t('The coach assigned to this relationship'))
      ->setSetting('target_type', 'user')
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 1,
      ])
      ->setDisplayOptions('view', [
        'type' => 'entity_reference_label',
        'weight' => 1,
      ]);

    $fields['start_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Start Date'))
      ->setDescription(t('When the coaching relationship began'))
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
      ->setDescription(t('Status of coaching relationship'))
      ->setDefaultValue('prospect')
      ->setSettings([
        'allowed_values' => [
          'prospect' => 'Prospect',
          'assessment' => 'Assessment',
          'active' => 'Active',
          'paused' => 'Paused',
          'completed' => 'Completed',
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

    $fields['program'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Program'))
      ->setDescription(t('The coaching program'))
      ->setSetting('target_type', 'node')
      ->setSetting('handler_settings', ['target_bundles' => ['program']])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 4,
      ])
      ->setDisplayOptions('view', [
        'type' => 'entity_reference_label',
        'weight' => 4,
      ]);

    $fields['goals'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Goals'))
      ->setDescription(t('Coaching goals for this relationship'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'rows' => 4,
        'weight' => 5,
      ])
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'weight' => 5,
      ]);

    $fields['notes'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Notes'))
      ->setDescription(t('Internal notes about this relationship'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'rows' => 4,
        'weight' => 6,
      ])
      ->setDisplayOptions('view', [
        'type' => 'text_default',
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

  public function getAthlete(): UserInterface {
    return $this->get('athlete')->entity;
  }

  public function getCoach(): UserInterface {
    return $this->get('coach')->entity;
  }

  public function getProgram() {
    return !$this->get('program')->isEmpty() ? $this->get('program')->entity : NULL;
  }

  public function isActive(): bool {
    return $this->get('status')->value === 'active';
  }
}
