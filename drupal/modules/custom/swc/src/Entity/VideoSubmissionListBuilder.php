<?php
namespace Drupal\swc\Entity;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class VideoSubmissionListBuilder extends EntityListBuilder {
  public function buildHeader() {
    return ['athlete' => t('Athlete'), 'submitted' => t('Submitted'), 'status' => t('Status'), 'coach' => t('Coach')] + parent::buildHeader();
  }
  public function buildRow(EntityInterface $entity) {
    return ['athlete' => $entity->getAthlete()->getDisplayName(), 'submitted' => $entity->get('submitted_date')->value, 'status' => $entity->get('review_status')->value, 'coach' => $entity->get('coach')->entity ? $entity->get('coach')->entity->getDisplayName() : '-'] + parent::buildRow($entity);
  }
}
