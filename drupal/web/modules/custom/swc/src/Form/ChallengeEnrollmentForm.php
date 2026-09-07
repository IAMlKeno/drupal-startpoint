<?php

namespace Drupal\swc\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for challenge enrollment forms.
 */
class ChallengeEnrollmentForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function build(array $form, FormStateInterface $form_state) {
    $form = parent::build($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage(t('Created enrollment for @athlete in @challenge.', [
          '@athlete' => $entity->getAthlete()->getDisplayName(),
          '@challenge' => $entity->getChallenge()->label(),
        ]));
        break;

      case SAVED_UPDATED:
        $this->messenger()->addMessage(t('Saved enrollment for @athlete.', [
          '@athlete' => $entity->getAthlete()->getDisplayName(),
        ]));
        break;
    }

    $form_state->setRedirect('entity.challenge_enrollment.canonical', ['challenge_enrollment' => $entity->id()]);
  }

}
