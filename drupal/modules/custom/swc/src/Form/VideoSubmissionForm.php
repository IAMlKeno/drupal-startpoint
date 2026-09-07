<?php
namespace Drupal\swc\Form;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class VideoSubmissionForm extends ContentEntityForm {
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);
    if ($status === SAVED_NEW) {
      $this->messenger()->addMessage(t('Video submitted for review.'));
    }
    $form_state->setRedirect('entity.video_submission.canonical', ['video_submission' => $entity->id()]);
  }
}
