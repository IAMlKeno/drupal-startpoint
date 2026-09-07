<?php
namespace Drupal\swc\Form;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class CheckInForm extends ContentEntityForm {
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);
    if ($status === SAVED_NEW) {
      $this->messenger()->addMessage(t('Check-in submitted for @athlete.', ['@athlete' => $entity->getAthlete()->getDisplayName()]));
    }
    $form_state->setRedirect('entity.check_in.canonical', ['check_in' => $entity->id()]);
  }
}
