<?php

namespace Drupal\swc\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for workout session forms.
 */
class WorkoutSessionForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage(t('Logged workout session for @athlete.', [
          '@athlete' => $entity->getAthlete()->getDisplayName(),
        ]));
        break;

      case SAVED_UPDATED:
        $this->messenger()->addMessage(t('Updated workout session.'));
        break;
    }

    $form_state->setRedirect('entity.workout_session.canonical', ['workout_session' => $entity->id()]);
  }

}
