<?php
namespace Drupal\swc\Form;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class CoachingRelationshipForm extends ContentEntityForm {
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage(t('Created coaching relationship for @athlete.', [
          '@athlete' => $entity->getAthlete()->getDisplayName(),
        ]));
        break;
      case SAVED_UPDATED:
        $this->messenger()->addMessage(t('Updated coaching relationship.'));
        break;
    }

    $form_state->setRedirect('entity.coaching_relationship.canonical', ['coaching_relationship' => $entity->id()]);
  }
}
