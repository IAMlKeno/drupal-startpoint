<?php
namespace Drupal\swc\Form;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class WorkoutSessionForm extends ContentEntityForm {
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);
    if ($status === SAVED_NEW) {
      $this->messenger()->addMessage(t('Logged workout for @athlete.', ['@athlete' => $entity->getAthlete()->getDisplayName()]));
    }
    $form_state->setRedirect('entity.workout_session.canonical', ['workout_session' => $entity->id()]);
  }
}
